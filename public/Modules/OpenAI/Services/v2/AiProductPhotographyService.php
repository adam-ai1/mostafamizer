<?php

namespace Modules\OpenAI\Services\v2;

use Modules\OpenAI\Entities\Archive;
use App\Models\TeamMemberMeta;
use App\Models\Team;
use Illuminate\Http\Response;
use Storage, Exception, Str, DB, AiProviderManager;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Entities\ProductBackground;

class AiProductPhotographyService
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

    /**
     * Constructor method to initialize the AI provider.
     *
     * Checks if a provider is specified in the request and sets the active AI provider
     * for video making if available.
     */

    public function __construct()
    {
        if (! is_null(request('provider'))) {
            $this->aiProvider = AiProviderManager::isActive(request('provider'), 'aiproductphotography');
        }
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
            $response = $this->aiProvider->sync();

            if ($response['code'] != 200) {
                $message = is_array($response['body']['error']) ? $response['body']['error']['message'] : $response['body']['error'];
                $message = $message ?? __('Something went wrong, please try again.');
                throw new \Exception($message);
            }

            if (is_null($response['body'])) {
                throw new \Exception(__('Something went wrong, please try again.'));
            }
        
            $data = $this->aiProvider->processSyncData($response);
            $this->processData($data);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * Processes and updates the voice data in the database.
     *
     * @param array $request The request data containing provider information.
     * @param array $allData An array of voice data to process.
     * @return bool Returns false if no new voices to process, otherwise void.
     */
    private function processData($allData)
    {
        if (empty($allData['data'])) {
            return false;
        }

        ProductBackground::where('type', 'ai_product_photography')
            ->whereNotIn('background_id', $allData['background_id'])
            ->delete();
        
        $existingBackground = ProductBackground::where('type', 'ai_product_photography')->pluck('background_id')->toArray();

        $newData = array_filter($allData['data'], function ($data) use ($existingBackground) {
            return !in_array($data['background_id'], $existingBackground);
        });

        ProductBackground::insert($newData);
    }

    /**
     * Retrieves a list of ProductBackgrounds based on the given type and provider.
     *
     * @param string $type The type of the product background. Example: 'ai_product_photography'
     * @param string $provider The provider of the product background. Example: 'pebblely'
     * @return \Illuminate\Database\Eloquent\Collection
     */ 
    public function getBackgrounds($type, $provider = null)
    {
        $query = ProductBackground::where('type', $type);

        if ($provider) {
            $query->where('provider', $provider);
        }

        return $query;
    }

    /**
     * Validate the request data with the validation rules from the AI provider.
     * 
     * @return array The validated request data.
     */
    public function validation()
    {
        if (! $this->aiProvider) {
            throw new Exception(__(':x provider is not available for the :y. Please contact the administration for further assistance.', ['x' => request('provider'), 'y' => __('Ai Product Photography')]));
        }

        $validation = $this->aiProvider->getCustomerValidationRules('AiProductShotDataProcessor');
        $rules = $validation[0] ?? []; // Default to an empty array if not set
        $messages = $validation[1] ?? []; // Default to an empty array if not set
        return request()->validate($rules, $messages);
    }


    public function store(array $requestData)
    {
        $this->checkUserImageSubscription($requestData);

        if ($this->aiProvider) {
            manageProviderValues(request('provider'), 'model', 'aiproductshot');
        }

        $file = $requestData['options']['file'] ?? null;
        
        if (! $file) {
            throw new Exception(
                __('An error occurred. Please verify your file and try again.'),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $sanitizedFilename = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $filename));
        $requestData['prompt'] = $sanitizedFilename;

        $imageFileName = date('Ymd') . DIRECTORY_SEPARATOR . md5(uniqid()) . '.' . $file->extension();
        $path = $this->uploadPath() . DIRECTORY_SEPARATOR . $imageFileName;

        objectStorage()->put($path, file_get_contents($file));

        $requestData['uploaded_file_name'] = $path;
        
        if (isset($requestData['options']['background_id'])) {
            $requestData['options']['original_background'] = ProductBackground::where('background_id', $requestData['options']['background_id'])->value('name');
        }

        $response = $this->aiProvider->generateProductShot($requestData);
 
        // Checked Image is return in correct format
        $images = $response->images();
        foreach ($images as $image) {
            if (! ($image instanceof \Intervention\Image\Image)) {
                throw new Exception(__('Invalid image type.'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
        
        // Saving image to Disk
        $imageUrls = $this->saveImages($images);

        // Storing in Database
        DB::beginTransaction();

        try {

            $image = '';
            if (! isset($requestData['parent_id'])) {
                $image = ArchiveService::create([
                    'user_id' => auth()->id(),
                    'title' => $requestData['prompt'],
                    'unique_identifier' => (string) Str::uuid(),
                    'type' => 'productshot',
                    'images' => $imageUrls,
                    'generation_options' => $requestData['options']
                ]);
            }

            $reply = [
                'parent_id' => $requestData['parent_id'] ?? $image->id,
                'user_id' => auth()->id(),
                'title' => $requestData['prompt'],
                'unique_identifier' => (string) Str::uuid(),
                'type' => 'productshot_chat',
                'user_reply' => $requestData['prompt']
            ];

            if ( isset($requestData['uploaded_file_name']) && $requestData['uploaded_file_name'] ) {
                $reply['uploaded_file_name'] = $requestData['uploaded_file_name'];
            }
            $userReply = ArchiveService::create($reply);
            
            $imageReply = ArchiveService::create([
                'parent_id' => $requestData['parent_id'] ?? $image->id,
                'title' => $requestData['prompt'],
                'unique_identifier' => (string) Str::uuid(),
                'provider' => $requestData['provider'],
                'type' => 'productshot_chat',
                'images_urls' => $imageUrls,
                'generation_options' => $requestData['options'],
            ]);

            foreach ($imageUrls as $url) {

                $imageVariant = ArchiveService::create([
                    'parent_id' => $imageReply->id,
                    'unique_identifier' => (string) Str::uuid(),
                    'provider' => $requestData['provider'],
                    'type' => 'productshot_variant',
                    'title' => $requestData['prompt'],
                    'url' => $url,
                    'original_name' => basename(str_replace('\\', '/', $url)),
                    'slug' => $this->slug($requestData['prompt']),
                    'image_creator_id' => auth()->id(),
                    'generation_options' => $requestData['options'],
                ]);
            }
   
            // Update User balance
            $balanceReduceType = $this->updateUserBalance($requestData);

            // Return new Image Reply
            $reply = ArchiveService::show($imageReply->id); 
            if ($balanceReduceType) {
                $reply->balance_reduce_type = $balanceReduceType;
            }

            DB::commit();

            return $reply;
           
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Create and return the path for uploading AI images.
     *
     * @return string The generated upload path.
     */

    private function uploadPath(): string
    {
        return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads', 'aiProductshot']));
    }

    /**
     * Check if the user has a valid subscription for image services.
     *
     * @param array $requestData The request data containing options.
     * @throws Exception If the user's subscription is invalid or lacks necessary credits.
     * @return void
     */
    public function checkUserImageSubscription(array $requestData): void
    {
        $userId = (new ContentService())->getCurrentMemberUserId('meta', null);

        if (subscription('isAdminSubscribed')) {
            return ;
        }

        // User status Actice/Inactive user
        $userStatus = (new ContentService())->checkUserStatus($userId, 'meta');
        if ($userStatus['status'] == 'fail') {
            throw new Exception($userStatus['message']);
        }

        // User Subscribed to a plan or not
        $validation = subscription('isValidSubscription', $userId, 'image');
        if ($validation['status'] == 'fail' && ! auth()->user()->hasCredit('image')) {
            throw new Exception($validation['message']);
        }

        if (isset($requestData['options']['aspect_ratio'])) {
            return ;
        }

        if (!isset($requestData['options']['size'])) {
            throw new Exception(__('Resolution is required for generate image. Please contact with the administration.'));
        }

        // Check Resolution is supported to user Subscribed Plan
        if (
            is_null($requestData['options']['size']) ||
            (filled($requestData['options']['size']) // Exist size data
            && !subscription('isValidResolution', $userId, $requestData['options']['size']) // Check resolution availability in subscription plan
            && !auth()->user()->hasCredit('image')) // Has Image credit
        ) {
            throw new Exception(__('This resolution is not available in your plan.'));
        }
    }

    /**
     * Save uploaded images and their thumbnails.
     *
     * @param array $images Array of uploaded images.
     * @return array Array of URLs for the saved images.
     * @throws Exception If there are errors during image processing or storage.
     */
    public function saveImages(array $images): array
    {
        $imageUrls = [];
        foreach ($images as $image) {

            $fileExtension = str_replace('image/', '', $image->mime);
            $fileName = md5(uniqid()) . "." . $fileExtension;

            // Save Main Image
            Storage::disk()->put(
                createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads','aiImages'])) . 
                DIRECTORY_SEPARATOR . 
                $fileName, 
                $image->encode()
            );

             // Resize and save thumbnails
            foreach (['small' => 150, 'medium' => 512] as $key => $ratio) {
                try {
                    // Resizing Image
                    $thumbnailImage = clone $image;
                    $thumbnailImage->resize($image->height(), $ratio, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // Save as thumbnail
                    Storage::disk()->put(
                        createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads', 'sizes', $key])) . DIRECTORY_SEPARATOR .  
                        $fileName, 
                        $thumbnailImage->encode()
                    );
                 
                } catch (\Intervention\Image\Exception\NotReadableException $e) {
                    throw new Exception($e->getMessage());
                }
            }

            // Store URL for main image
            $imageUrls[] = join(DIRECTORY_SEPARATOR, ['public', 'uploads','aiImages']) . 
            DIRECTORY_SEPARATOR . 
            $fileName;
        }

        return $imageUrls;
    }

    public function updateUserBalance($requestData)
    {
        $userId = (new ContentService())->getCurrentMemberUserId('meta', null);
        $subscription = subscription('getUserSubscription', $userId);

        if (! subscription('isAdminSubscribed') || auth()->user()->hasCredit('image')) {
            
            $variant = $requestData['options']['variant'] ?? 1;
            $increment = subscription('usageIncrement', $subscription?->id, 'image', $variant, $userId);
            
            if ($increment && $userId != auth()->user()->id) {
                $this->storeTeamMeta($variant);
            }

            return app('user_balance_reduce');
        }
    }

    public function storeTeamMeta($words)
    {
        $memberData = Team::getMember(auth()->user()->id);

        if (!empty($memberData)) {
            $usage = TeamMemberMeta::getMemberMeta($memberData->id, 'image_used');
            if (!empty($usage)) {
                $usage->increment('value', $words); 
            }
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
            ->where('archives.type', 'productshot_variant')
            ->join('archives_meta', function ($join) use ($slug) {
                $join->on('archives.id', '=', 'archives_meta.owner_id')
                    ->where('archives_meta.key', 'slug')
                    ->where('archives_meta.value', $slug);
            })
            ->exists();

        return $slugExist ? $slug . time() : $slug;
    }
}
