<?php

namespace Modules\AiInfluencer\Services;

use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\ContentService;
use Illuminate\Http\Response;
use Exception, Str, DB;
use AiProviderManager;
use Modules\OpenAI\Entities\Avatar;
use Modules\OpenAI\Entities\Voice;


class UrlToVideoService
{
    /**
     * The AI provider used for generating video responses.
     *
     * This private property holds the AI provider used for generating code responses
     * within the `CodeResponse` class. It encapsulates the provider information,
     * allowing it to be accessed and utilized internally within the class only.
     *
     * @var mixed $aiProvider The AI provider used for code generation.
     */
    private $aiProvider;

    private $response;

    private $title;

    private $type = 'urltovideo_chat';
    
    /**
     * Constructor method to initialize the AI provider.
     *
     * Checks if a provider is specified in the request and sets the active AI provider
     * for video making if available.
     */

    public function __construct()
    {
        if (! is_null(request('provider'))) {
            $this->aiProvider = AiProviderManager::isActive(request('provider'), 'urltovideo');
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
            throw new Exception(__(':x provider is not available for the :y. Please contact the administration for further assistance.', ['x' => request('provider'), 'y' => __('URL to Video')]));
        }
        
        // manageProviderValues(request('provider'), 'model', 'urltovideo');

        $validation = $this->aiProvider->getCustomerValidationRules('UrlToVideoDataProcessor');
        $rules = $validation[0] ?? []; // Default to an empty array if not set
        $messages = $validation[1] ?? []; // Default to an empty array if not set
        return request()->validate($rules, $messages);
    }

    public function generate(array $requestData)
    {
        if (isset($requestData['options']['file'])) {
            $uploadedFile = $requestData['options']['file'];
            $fileName = date('Ymd') . DIRECTORY_SEPARATOR . md5(uniqid()) . '.' . $uploadedFile->extension();
            $path = $this->uploadPath() . DIRECTORY_SEPARATOR . $fileName;
            
            objectStorage()->put($path, file_get_contents($uploadedFile));
            
            $requestData['uploaded_file_name'] = $path;
        }

        $videoResponse =  $this->aiProvider->generateUrlToVideo($requestData);
        $this->response = $this->aiProvider->retriveUrlToVideo($videoResponse->videoId);
        $this->title = $requestData['title'] ?? (
        isset($requestData['options']['file']) ? pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME) : 'Untitled Video');

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

            $archiveId = $this->storeInArchive($requestData);

            $videos_url = [];
            foreach($this->response->videos as $video) {
                $filename = date('Ymd') . DIRECTORY_SEPARATOR .md5(uniqid()) . ".mp4";
            
                objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $filename, $video);

                $videos_url[] = $filename;
            }

            $videoChat = new Archive();
            $videoChat->type = $this->type;
            $videoChat->parent_id = $archiveId;
            $videoChat->file_id = $videoResponse->videoId;
            $videoChat->videos_url = $videos_url;
            $videoChat->provider = request('provider');
            $videoChat->video_creator_id = auth()->id();
            $videoChat->generation_options = $requestData['options'];
            $videoChat->save();

            foreach($videos_url as $url) {
                // Store Generated Video
                $video =  new Archive();
                $video->parent_id = $videoChat->id;
                $video->user_id = auth()->id();
                $video->unique_identifier = (string) Str::uuid();
                $video->type = 'urltovideo';
                $video->provider = request('provider');
                $video->status = 'Completed';

                $video->generation_options =  $requestData['options'];
                $video->title = $this->title;
                $video->file_name = $url;
                $video->video_creator_id = auth()->id();
                $video->slug = $this->slug($this->title);
                $video->save();
            }

            DB::commit();
            return array_merge($response, ['video_id' => $videoChat->id]);
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
    protected function storeInArchive($requestData)
    {
        if ( isset($requestData['parent_id']) && $requestData['parent_id'] ) {
            return $requestData['parent_id'];
        }

        $video =  new Archive();
        $video->title = $this->title;
        $video->user_id = auth()->id();
        $video->unique_identifier = (string) Str::uuid();
        $video->raw_response = json_encode($this->response);
        $video->type = $this->type;
        $video->provider = request('provider');
        $video->status = 'Completed';
        $video->save();
        return $video->id;
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
     * Generate a URL-friendly slug based on the given prompt.
     *
     * @param string $prompt The input prompt for generating the slug.
     * @return string The generated slug.
     * @throws \Exception If there's an issue with database querying.
     */
    public function slug($prompt): string
    {
        $slug = strlen($prompt) > 120 ? cleanedUrl(substr($prompt, 0, 120)) : cleanedUrl($prompt);

        $slugExist = Archive::query()
            ->select('archives.id')
            ->whereIn('archives.type', ['video', 'aishorts', 'ai_avatar_chats', 'urltovideo', 'urltovideo_chat', 'influencer_avatar', 'influencer_avatar_chat'])
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
     * @return Archive|null The video record with its associated user, children, and metadata, or null if not found.
     */
    public function fetchVideo($id)
    {
       return Archive::with('user', 'childs', 'metas')->where('id', $id)->where('type', $this->type)->first();
    }
}