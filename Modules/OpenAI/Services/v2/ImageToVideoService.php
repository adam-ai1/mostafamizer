<?php 

namespace Modules\OpenAI\Services\v2;

use Exception, Str, DB;
use Illuminate\Http\Response;
use App\Facades\AiProviderManager;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Entities\VideoJob;
use Modules\OpenAI\Jobs\PollProviderStatus;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Services\v2\TeamMemberService;

class ImageToVideoService
{
    protected $type = 'video_image';

    protected $title = null;

    /**
     * The original API response received during initialization.
     *
     * This protected property stores the original API response received during the initialization
     * of the `CodeResponse` object. It encapsulates the API response data, allowing it to be accessed
     * within the class and its subclasses, but not directly from outside the class.
     *
     * @var mixed $response The original API response object.
     */
    protected $response;

    /**
     * The AI provider used for generating code responses.
     *
     * This private property holds the AI provider used for generating code responses
     * within the `CodeResponse` class. It encapsulates the provider information,
     * allowing it to be accessed and utilized internally within the class only.
     *
     * @var mixed $aiProvider The AI provider used for code generation.
     */
    private $aiProvider;
    public function __construct()
    {
        if (! is_null(request('provider'))) {
            $this->aiProvider = AiProviderManager::isActive(request('provider'), 'videomaker');
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
            throw new Exception(__(':x provider is not available for the :y. Please contact the administration for further assistance.', ['x' => request('provider'), 'y' => __('Video')]));
        }

        $validation = $this->aiProvider->videoValidationRules('VideoDataProcessor');
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
    public function generate(array $requestData)
    {
        if ($this->aiProvider) {
            manageProviderValues(request('provider'), 'model', 'videomaker');
        }
        
        $uploadedFile = request()->file('options.file');

        $originalNameWithoutExtension = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $requestData['prompt'] = isset($requestData['prompt']) ? $requestData['prompt'] : $originalNameWithoutExtension;

        $responseData = $this->aiProvider->generateVideo($requestData);

        $imageFileName = date('Ymd') . DIRECTORY_SEPARATOR .md5(uniqid()) . "." . $uploadedFile->extension();
        objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $imageFileName, file_get_contents($uploadedFile));
        $requestData['imageFileName'] = $imageFileName;

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
                'provider_task_id' => $responseData->videoId,
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
        }
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
        $video->type = $this->type;
        $video->provider = request('provider');
        $video->status = 'Completed';

        $video->task_id = $responseData->videoId;
        $video->generation_options = $requestData['options'];
        $video->video_job_id = $jobId;
        $video->uploaded_file_name = $requestData['imageFileName'];

        $video->save();

        return $video;
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
     * Delete
     *
     * @param mixed $id The identifier of the video to delete.
     * @return bool 
     * @throws \Exception
     */
    public function delete($id) :bool
    {
        DB::beginTransaction();
        try {
            // Find the chat or throw an exception if not found            
            $videoImage = Archive::where(['id' => $id, 'type' => 'video_image'])->first() ?? throw new Exception(__(':x does not exist.', ['x' => __('Ai Video')]), Response::HTTP_NOT_FOUND);
            
            // Remove 'total_words' meta and save the changes
            $videoImage->unsetMeta(['file_name', 'original_name', 'file_id', 'cfg_scale', 'motion_bucket_id', 'seed']);
            $videoImage->save();
            $videoImage->delete();

            $video = Archive::with('metas')->where(['parent_id' => $id, 'type' => 'video'])->get();
            if (! $video->isEmpty()) {
                foreach ($video as $reply) {
                    // Remove specified metas and save changes
                    $reply->unsetMeta(['file_name']);
                    $reply->save();
                    $reply->delete();
                }
            }
            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
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
            ->where('archives.type', 'video')
            ->join('archives_meta', function ($join) use ($slug) {
                $join->on('archives.id', '=', 'archives_meta.owner_id')
                    ->where('archives_meta.key', 'slug')
                    ->where('archives_meta.value', $slug);
            })
            ->exists();

        return $slugExist ? $slug . time() : $slug;
    }

    /**
     * Fetches the status of a video generation task.
     *
     * @param mixed $videoId The identifier of the video task to check.
     * @return mixed The status of the video generation task.
     */
    public function fetchVideoStatus($videoId)
    {
        return $this->aiProvider->checkImageToVideoStatus($videoId);
    }

    /**
     * Fetches a video record by its ID.
     *
     * @param mixed $id The identifier of the video to retrieve.
     * @return void
     */
    public function fetchVideo(Archive $archive): void
    {
        $videoResponse =  $this->aiProvider->getVideo($archive->task_id);

        $videos_url = [];
        foreach($videoResponse->videos as $video) {
            $filename = date('Ymd') . DIRECTORY_SEPARATOR .md5(uniqid()) . ".mp4";
        
            objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $filename, $video);

            $videos_url[] = $filename;
        }

        $videoChat = new Archive();
        $videoChat->type = $this->type;
        $videoChat->parent_id = $archive->id;
        $videoChat->file_name = $archive->uploaded_file_name;
        $videoChat->original_name = $archive->uploaded_file_name;
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
            $video->type = 'video';
            $video->provider = request('provider');
            $video->status = 'Completed';

            $video->generation_options = $archive->generation_options;
            $video->title = $archive->title;
            $video->uploaded_file_name = $archive->uploaded_file_name;
            $video->file_name = $url;
            $video->video_creator_id = $archive->user_id;
            $video->slug = $this->slug($archive->title);
            $video->save();
        }
    }

    /**
     * Retrieves a video record by its ID.
     *
     * @param int|string $id The identifier of the video to retrieve.
     * @return Archive|null The video record with its associated user, children, and metadata, or null if not found.
     * @throws Exception If the video with the given ID is not found.
     */
    public function getVideo($id)
    {
        $video = Archive::with('user', 'childs', 'metas')->where('id', $id)->where('type', $this->type)->first();

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
