<?php

/**
 * @package TextToVideoService
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Khayeruzzaman <[shakib.techvill@gmail.com]>
 * @created 25-02-2025
 */
namespace Modules\OpenAI\Services\v2;

use Illuminate\Http\Response;
use Modules\OpenAI\Entities\Archive;
use Exception, Str, DB, AiProviderManager;
use Modules\OpenAI\Services\ContentService;

use Modules\OpenAI\Entities\VideoJob;
use Modules\OpenAI\Jobs\PollProviderStatus;

class TextToVideoService
{
    private $aiProvider;

    private $response;

    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct() 
    {
        if(! is_null(request('provider'))) {
            $this->aiProvider = AiProviderManager::isActive(request('provider'), 'texttovideo');
        }
    }

    /**
     * Validate the request data with the validation rules from the AI provider.
     * 
     * @return array The validated request data.
     */
    public function validation()
    {
        if (! $this->aiProvider) {
            throw new Exception(__('Provider not found.'));
        }

        manageProviderValues(request('provider'), 'model', 'texttovideo');

        $validation = $this->aiProvider->getCustomerValidationRules('TextToVideoDataProcessor');
        $rules = $validation[0] ?? []; // Default to an empty array if not set
        $messages = $validation[1] ?? []; // Default to an empty array if not set
        return request()->validate($rules, $messages);
    }

    /**
     * Create a new chat conversation.
     *
     * @param  array  $requestData  The data for the chat conversation.
     * @throws \Exception
     */
    public function store(array $requestData)
    {
        if (! $this->aiProvider) {
            throw new Exception(__(':x provider is not available for the :y. Please contact the administration for further assistance.', ['x' => request('provider'), 'y' => __('Text To Video')]));
        }

        $prompt = $requestData['prompt'];
        $responseData = $this->aiProvider->generateTextToVideo($requestData);

        DB::beginTransaction();
        try {

            $userId = (new ContentService())->getCurrentMemberUserId('meta', null);
            $response = [
                'balanceReduce' => 'onetime',
            ];
            $subscription = subscription('getUserSubscription', $userId);

            if (!subscription('isAdminSubscribed') || auth()->user()?->hasCredit('video')) {
                $increment = subscription('usageIncrement', $subscription?->id, 'video', 1, $userId);
                if ($increment && $userId != auth()->user()?->id) {
                    (new TeamMemberService())->updateTeamMeta('video', 1);
                }
                $response['balanceReduce'] = app('user_balance_reduce');
            }

            $job = VideoJob::create([
                'user_id'          => $userId,
                'unique_identifier' => (string) Str::uuid(),
                'provider'         => request('provider'),
                'provider_task_id' => $responseData->video,
                'status'           => 'queued',
                'progress'         => 0,
                'next_check_at'    => now()->addSeconds(5),
                'raw_response'     => json_encode($responseData),
            ]);
        
            $archive = $this->storeInArchive($requestData, $responseData, $job->id);

            PollProviderStatus::dispatch($job->id, request('provider'));

            DB::commit();
            return array_merge($response, ['video' => $archive]);

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        };

    }

    /**
     * Retrieves the status of a text-to-video request.
     *
     * @param string $videoId The ID of the text-to-video request.
     *
     * @return CheckVideoResponseContact The response of the API request, which will contain the status of the request.
     */
    public function fetchVideoStatus($videoId)
    {
        return $this->aiProvider->checkTextToVideoStatus($videoId);
    }

    /**
     * Creates a new video record.
     *
     * @return Archive The newly created chat instance.
     */
    protected function storeInArchive($requestData, $responseData, $jobId)
    {
        if ( isset($requestData['parent_id']) && $requestData['parent_id'] ) {
            return $requestData['parent_id'];
        }
        
        $video =  new Archive();
        $video->title = $requestData['prompt'];
        $video->user_id = auth()->id();
        $video->unique_identifier = (string) Str::uuid();
        $video->raw_response = json_encode($responseData);
        $video->type = 'text_to_video_chat';
        $video->provider = request('provider');
        $video->status = 'Completed';

        $video->task_id = $responseData->video;
        $video->generation_options = $requestData['options'];
        $video->video_job_id = $jobId;

        $video->save();

        return $video;
    }

    /**
     * Generate a URL-friendly slug based on the given prompt.
     *
     * @param string $prompt The input prompt for generating the slug.
     * @return string The generated slug.
     * @throws \Exception If there's an issue with database querying.
     */
    public function slug($prompt): string
    {
        sleep(1);

        $slug = strlen($prompt) > 120 ? cleanedUrl(substr($prompt, 0, 120)) : cleanedUrl($prompt);

        $slugExist = Archive::query()
            ->select('archives.id')
            ->where('archives.type', 'text_to_video')
            ->join('archives_meta', function ($join) use ($slug) {
                $join->on('archives.id', '=', 'archives_meta.owner_id')
                    ->where('archives_meta.key', 'slug')
                    ->where('archives_meta.value', $slug);
            })
            ->exists();

        return $slugExist ? $slug . time() : $slug;
    }

    /**
     * Fetches a video record by its ID.
     *
     * @param mixed $id The identifier of the video to retrieve.
     * @return void
     */
    public function fetchVideo(Archive $archive): void
    {
        
        $this->response = $this->aiProvider->getTextToVideo($archive->task_id);

        $videos_url = [];
        foreach($this->response->urls as $video) {
            $filename = date('Ymd') . DIRECTORY_SEPARATOR .md5(uniqid()) . ".mp4";
        
            objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $filename, $video);

            $videos_url[] = $filename;
        }

        $videoChat = new Archive();
        $videoChat->type = 'text_to_video_chat';
        $videoChat->parent_id = $archive->id;
        $videoChat->file_name = $archive->title;
        $videoChat->original_name = $archive->title;
        $videoChat->task_id = $archive->task_id;
        $videoChat->videos_url = $videos_url;
        $videoChat->generation_options = $archive->generation_options;
        $videoChat->save();

        foreach($videos_url as $key => $url) {

            // Store Generated Video
            $video =  new Archive();
            $video->parent_id = $videoChat->id;
            $video->user_id = $archive->user_id;
            $video->unique_identifier = (string) Str::uuid();
            $video->type = 'text_to_video';
            $video->provider = request('provider');
            $video->status = 'Completed';

            $video->generation_options = $archive->generation_options;
            $video->title = $archive->title;
            $video->task_id = $archive->task_id;
            $video->file_name = $url;
            $video->video_creator_id = $archive->user_id;
            $video->slug = $this->slug($archive->title);
            $video->save();
        }
    }

    /**
     * Creates and returns the upload path for storing videos.
     * 
     * @return string The path to the upload directory for AI-generated videos.
     */
    public function uploadPath()
	{
		return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads','aiVideos']));
	}

    /**
     * Deletes a video archive based on the provided ID.
     * 
     * @param  mixed  $id  The ID of the video archive to delete.
     * 
     * @throws \Exception
     */
    public function delete($id)
    {

        if (!is_numeric($id)) {
            throw new Exception(__('Invalid Request.'), Response::HTTP_FORBIDDEN);
        }

        try {
            $view = ArchiveService::show($id);

            if (! $view) {
                throw new Exception(__(':x does not exist.', ['x' => __('The record')]), Response::HTTP_NOT_FOUND);
            }

            $this->unlinkFile($view->file_name);

            if ($view->type == 'video') {
                $this->unlinkFile($view->uploaded_file_name);
            }

            ArchiveService::delete(
                (int) $id,
                null,
                null,
                ['key' => 'video_creator_id', 'value' => auth('api')->id()]
            );
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Unlink Video File
     * @param mixed $name
     * 
     * @return bool
     */
    protected function unlinkFile($name): bool
    {
        $path = $this->uploadPath() . DIRECTORY_SEPARATOR . $name;

        if (isExistFile($path)) {
            objectStorage()->delete($path);
        }
        return true;
    }

    /**
     * Retrieves a video record by its ID.
     *
     * @param int|string $id The identifier of the video to retrieve.
     * @return Archive|null The video record with its associated user, children, and metadata, or null if not found.
     * @throws Exception If the video with the given ID is not found.
     */
    public function getVideo($id): ?Archive
    {
        $video = Archive::with('user', 'childs', 'metas')->where('id', $id)->where('type', 'text_to_video_chat')->first();

        if (! $video) {
            throw new Exception( __('Item not found') , Response::HTTP_NOT_FOUND);
        }
        
        $job = VideoJob::where('id', $video->video_job_id)->first();

        if ($job->status == 'failed') {
            throw new Exception($job->error , Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($job->status == 'succeeded') {
            return Archive::with('user', 'childs', 'metas')->where('parent_id', $video->id)->first();
        }

        return null;
    }

}
