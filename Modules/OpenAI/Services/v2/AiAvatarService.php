<?php

namespace Modules\OpenAI\Services\v2;

use Modules\OpenAI\Entities\Archive;
use Illuminate\Http\Response;
use Exception, Str, DB;
use AiProviderManager;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Entities\Avatar;
use Modules\OpenAI\Entities\Voice;

class AiAvatarService
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

    private $type = 'ai_avatar_chat';
    
    /**
     * Constructor method to initialize the AI provider.
     *
     * Checks if a provider is specified in the request and sets the active AI provider
     * for video making if available.
     */

    public function __construct()
    {
        if (! is_null(request('provider'))) {
            $this->aiProvider = AiProviderManager::isActive(request('provider'), 'aiavatar');
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
            throw new Exception(__(':x provider is not available for the :y. Please contact the administration for further assistance.', ['x' => request('provider'), 'y' => __('Ai Avatar')]));
        }
        
        manageProviderValues(request('provider'), 'model', 'aiavatar');

        $validation = $this->aiProvider->getCustomerValidationRules('AiAvatarDataProcessor');
        $rules = $validation[0] ?? []; // Default to an empty array if not set
        $messages = $validation[1] ?? []; // Default to an empty array if not set
        return request()->validate($rules, $messages);
    }

    public function generate(array $requestData)
    {
        $videoResponse =  $this->aiProvider->generateAvatar($requestData);
        $this->response = $this->aiProvider->getVideo($videoResponse->video);
        $this->title = $requestData['prompt'];

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

            $avatar = Avatar::where('avatar_id', $requestData['options']['avatar_id'])->first();

            $requestData['options']['avatar_name'] = $avatar->name;

            unset($requestData['options']['avatar_id']);

            $videoChat = new Archive();
            $videoChat->type = $this->type;
            $videoChat->parent_id = $archiveId;
            $videoChat->file_id = $videoResponse->video;
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
                $video->type = 'ai_avatar';
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

    public function latestAvatars($type = 'ai_avatar', $provider = 'synthesia')
    {
        return Avatar::with(['metas', 'user'])
            ->join('avatar_metas', 'avatars.id', '=', 'avatar_metas.owner_id')
            ->where('avatar_metas.key', 'image_url')
            ->where([
                'avatars.type' => $type,
                'avatars.provider' => $provider,
                'avatars.status' => 'Active'
            ])
           ->select([
                'avatars.id',
                'avatars.avatar_id',
                'avatars.name',
                'avatars.gender',
                'avatars.provider',
                'avatars.type',
                'avatars.user_id',
                'avatar_metas.value as image_url'
            ]);
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
     * Fetches a video record by its ID.
     *
     * @param mixed $id The identifier of the video to retrieve.
     * @return Archive|null The video record with its associated user, children, and metadata, or null if not found.
     */
    public function fetchVideo($id)
    {
       return Archive::with('user', 'childs', 'metas')->where('id', $id)->where('type', 'ai_avatar_chat')->first();
    }

    public function latestVideos()
    {
       return Archive::with('metas', 'user')
            ->whereHas('metas', function ($query) {
                $query->where('key', 'video_creator_id')->where('value', auth()->id());
            })
            ->where('type', 'ai_avatar')
            ->latest()
            ->limit(4)
            ->get();
    }


    /**
     * Syncs the data from the given AI provider.
     *
     * @param array $arrayData The request data containing type and provider information.
     *
     * @throws \Exception If there's an issue with the provider or the request.
     *
     * @return bool Returns true if the sync operation is successful.
     */
    public function syncData(array $arrayData)
    {
        if (! $this->aiProvider) {
            throw new Exception(__(':x provider is not available for the :y. Please contact the administration for further assistance.', ['x' => request('provider'), 'y' => __('Ai Persona')]));
        }

        $type = $arrayData['type'];

        DB::beginTransaction();
        try {
            $response = $this->aiProvider->sync($type);

            if ($response['code'] != 200) {
                $message = is_array($response['body']['error']) ? $response['body']['error']['message'] : $response['body']['error'];
                $message = $message ?? __('Something went wrong, please try again.');
                throw new \Exception($message);
            }

            if (is_null($response['body'])) {
                throw new \Exception(__('Something went wrong, please try again.'));
            }

            if ($type === 'voices') {
                $this->processVoices($arrayData, $response['body']['data']['voices']);
            }
 
            if ($type === 'avatars') {
                $this->processAvatars($arrayData, $response['body']['data']['avatars']);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

    }
}
