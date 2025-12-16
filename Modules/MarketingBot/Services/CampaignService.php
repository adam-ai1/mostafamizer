<?php

/**
 * @package CampaignService
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Md. Khayeruzzaman <[shakib.techvill@gmail.com]>
 *
 * @created 25-02-2025
 * @created 14-10-2025
 */

namespace Modules\MarketingBot\Services;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use App\Facades\AiProviderManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\UploadedFile;
use Modules\OpenAI\Entities\Archive;
use Modules\MarketingBot\Jobs\ProcessCampaignJob;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Template;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Services\v2\FeaturePreferenceService;
use ChannelManager;
use Modules\MarketingBot\Providers\WhatsAppManager;
use Modules\MarketingBot\Providers\TelegramManager;
use Modules\MarketingBot\Responses\ChannelResponse;
use Modules\MarketingBot\Services\RecipientHandlerFactory;
class CampaignService
{
    protected $chatType = 'marketing_bot';

    /**
     * @var int The size of the chunk, default value is 256.
     */
    protected $chunkSize = 256;

    /**
     * @var mixed The ID of the user.
     */
    protected $userId;

    /**
     * Cache for archive table columns to avoid repeated schema queries
     * 
     * @var array|null
     */
    protected static $archiveColumns = null;

    /**
     * Check if a column exists in the archives table (with caching)
     *
     * @param string $column
     * @return bool
     */
    protected function hasArchiveColumn(string $column): bool
    {
        if (self::$archiveColumns === null) {
            self::$archiveColumns = Schema::getColumnListing((new Archive())->getTable());
        }
        
        return in_array($column, self::$archiveColumns);
    }

    /**
     * Dynamically set a field on Archive (column or metadata)
     *
     * @param Archive $archive
     * @param string $field
     * @param mixed $value
     * @return void
     */
    protected function setArchiveField(Archive $archive, string $field, $value): void
    {
        if ($this->hasArchiveColumn($field)) {
            // Field exists as column, set directly
            $archive->$field = $value;
        } else {
            // Field doesn't exist as column, use metadata
            $archive->setMeta($field, $value);
        }
    }

    /**
     * Dynamically get a field from Archive (column or metadata)
     *
     * @param Archive $archive
     * @param string $field
     * @param mixed $default
     * @return mixed
     */
    protected function getArchiveField(Archive $archive, string $field, $default = null)
    {
        if ($this->hasArchiveColumn($field)) {
            return $archive->$field ?? $default;
        }
        
        return $archive->getMeta($field, $default);
    }

    /**
     * Build a query condition for a field (column or metadata)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $field
     * @param mixed $value
     * @param string $operator
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildArchiveQuery($query, string $field, $value, string $operator = '=')
    {
        if ($this->hasArchiveColumn($field)) {
            // Field exists as column, query directly
            return $query->where($field, $operator, $value);
        } else {
            // Field doesn't exist as column, query metadata
            return $query->whereHas('metas', function($q) use ($field, $value, $operator) {
                $q->where('key', $field);
                if ($operator === '=') {
                    $q->where('value', $value);
                } else {
                    $q->where('value', $operator, $value);
                }
            });
        }
    }

    /**
     * Build a query to find archive by contact_id OR segment_id
     * Handles both contact-based and segment-based messages
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $requestArray
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildRecipientQuery($query, array $requestArray)
    {
        // Build conditions for finding the archive
        $conditions = [];
        
        // Check if we have contact_id
        if (isset($requestArray['contact_id'])) {
            $conditions[] = function($q) use ($requestArray) {
                $this->buildArchiveQuery($q, 'contact_id', $requestArray['contact_id']);
            };
        }
        
        // Check if we have segment_id
        if (isset($requestArray['segment_id'])) {
            $conditions[] = function($q) use ($requestArray) {
                $this->buildArchiveQuery($q, 'segment_id', $requestArray['segment_id']);
            };
        }
        
        // Check for channel-specific identifiers (for Telegram groups)
        if (isset($requestArray['telegram_chat_id'])) {
            $conditions[] = function($q) use ($requestArray) {
                $this->buildArchiveQuery($q, 'telegram_chat_id', $requestArray['telegram_chat_id']);
            };
        }
        
        // Apply conditions with OR logic
        if (!empty($conditions)) {
            $query = $query->where(function($q) use ($conditions) {
                foreach ($conditions as $index => $condition) {
                    if ($index === 0) {
                        $condition($q);
                    } else {
                        $q->orWhere(function($subQ) use ($condition) {
                            $condition($subQ);
                        });
                    }
                }
            });
        }
        
        return $query;
    }

    /**
     * @var int The chunk data, default value is 4.
     */
    protected $chunkData = 4;

    /**
     * @var array Temporary data storage for processing operations.
     */
    protected $data;
    
    /**
     * Store a new campaign for the authenticated user.
     * 
     * Creates a campaign with the provided data, handles template processing for WhatsApp,
     * image uploads, and sends campaign messages if the status is 'running'.
     *
     * @param array $data Campaign data including title, content, channel, schedule, etc.
     * @return void
     *
     * @throws Exception If contact is not found or save operation fails
     */
    public function store(array $data)
    {
        DB::beginTransaction();

        try {

            $service = new MarketingCampaign();

            $service->title = $data['title'];
            $service->content = $data['content'] ?? null;
            $service->status = isset($data['schedule']) ? 'scheduled' : 'running';

            $service->channel = $data['channel'];

            $service->starts_at = now();
            $service->ends_at = $data['end_date'] ?? null;

            $service->unique_identifier = Str::uuid();

            $service->user_id = auth()->id();

            $service->schedule = isset($data['schedule']) ? 'on' : 'off';

            if (isset($data['ai_reply'])) {
                $service->ai_reply = $data['ai_reply'] ?? 'off';
                $service->chat_provider = $data['chat_provider'];
                $service->chat_model = $data['chat_model'];
                $service->embedding_provider = $data['embedding_provider'];
                $service->embedding_model = $data['embedding_model'];
            }

            if (isset($data['schedule'])) {
                $timezone = preference('default_timezone') ?? config('app.timezone');
                $scheduleDate = $data['schedule_date'] ?? null;
                $scheduleTime = $data['schedule_time'] ?? null;

                $service->schedule_date = $scheduleDate;
                $service->schedule_time = $scheduleTime;

                if ($scheduleDate && $scheduleTime) {
                    $scheduledAt = Carbon::parse($scheduleDate . ' ' . $scheduleTime, $timezone)
                        ->setTimezone(config('app.timezone'));
                    $service->schedule_at = $scheduledAt;
                }

                $service->timezone = $timezone;
            }

            // Store recipients in unified format (works for all channels)
            $recipients = $this->normalizeRecipients($data);
            
            // Validate that selected segments have contacts (for channels that extract contacts from segments)
            // This ensures users are informed if segments they selected have no contacts
            if (!empty($recipients['segments'])) {
                $this->validateSegmentContacts($recipients['segments'], $data['channel'] ?? 'whatsapp', auth()->id());
            }
            
            $service->setMeta('recipients', json_encode($recipients));

            if ($data['channel'] == 'whatsapp') {
                $template = Template::where('id', $data['template'])->first();
                
                // Process file uploads first and replace UploadedFile objects with file paths
                $processedData = $this->processFileUploads($data, json_decode($template->components, true));
                
                // Store the complete template structure with form data merged for inbox display
                $templateComponents = json_decode($template->components, true);

                // Create a data processor instance to merge form data with template
                $dataProcessor = new \Modules\MarketingBot\Providers\Resources\WhatsAppDataProcessor($data);
                $mergedComponents = $dataProcessor->mergeTemplateValues([
                    'header' => $processedData['header'] ?? null,
                    'body' => $processedData['body'] ?? null,
                    'buttons' => $processedData['buttons'] ?? null,
                ], $templateComponents);

                $templateData = $mergedComponents;
                
                // Ensure no UploadedFile objects remain before JSON encoding
                $templateData = $this->removeUploadedFiles($templateData);

                $service->template_id = $data['template'];
                $service->template_name = $template->name;
                $service->template = json_encode($templateData);
            }

            if ( request()->file('image') ) {
                $uploadedFile = request()->file('image');

                $originalNameWithoutExtension = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

                $imageFileName = date('Ymd') . DIRECTORY_SEPARATOR .md5(uniqid()) . "." . $uploadedFile->extension();
                objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $imageFileName, file_get_contents($uploadedFile));

                $service->original_file_name = $originalNameWithoutExtension;
                $service->image = $imageFileName;
            }

            $service->save();

            DB::commit();
            
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // Remove UploadedFile objects from data before dispatching job
        $cleanData = $this->removeUploadedFiles($data);
        $this->dispatchCampaignProcessingJob($service, $cleanData);
    }

    /**
     * Dispatch the queued job that will process the campaign.
     */
    protected function dispatchCampaignProcessingJob(MarketingCampaign $campaign, array $data): void
    {
        $payload = $this->prepareJobPayload($data, $campaign);

        $job = new ProcessCampaignJob($campaign->id, $campaign->user_id, $payload);

        if ($delay = $this->resolveScheduleDelay($campaign)) {
            Bus::dispatch($job->delay($delay));
            return;
        }

        Bus::dispatch($job);
    }

    /**
     * Prepare job payload by removing non-serializable data and ensuring required keys.
     */
    protected function prepareJobPayload(array $data, MarketingCampaign $campaign): array
    {
        $payload = [];

        foreach ($data as $key => $value) {
            if ($value instanceof UploadedFile) {
                continue;
            }

            if ($value instanceof \DateTimeInterface) {
                $payload[$key] = $value->format('Y-m-d H:i:s');
                continue;
            }

            if (is_object($value)) {
                if (method_exists($value, '__toString')) {
                    $payload[$key] = (string) $value;
                }
                continue;
            }

            $payload[$key] = $value;
        }

        $payload['campaign'] = $campaign->id;
        $payload['channel'] = $campaign->channel;

        return $payload;
    }

    /**
     * Resolve when the campaign job should run.
     */
    protected function resolveScheduleDelay(MarketingCampaign $campaign): ?Carbon
    {
        if ($campaign->status !== 'scheduled' || empty($campaign->schedule_at)) {
            return null;
        }

        $scheduleAt = $campaign->schedule_at instanceof Carbon
            ? $campaign->schedule_at->copy()
            : Carbon::parse($campaign->schedule_at, config('app.timezone'));

        return $scheduleAt->isPast() ? null : $scheduleAt;
    }

    /**
     * Process file uploads and replace UploadedFile objects with file paths
     * Recursively processes all UploadedFile instances in the data array
     * Also processes template components for external image URLs
     *
     * @param array $data
     * @param array $component
     * @return array
     */
    public function processFileUploads($data, $component)
    {
        // Process campaign data first
        $processedData = $this->recursiveProcessFiles($data, $component);

        return $processedData;
    }

    /**
     * Process template components for external image URLs
     *
     * @param array $components
     * @return array
     */
    public function processTemplateComponents($components)
    {
        return $this->recursiveProcessFiles($components, $components);
    }

    /**
     * Recursively process UploadedFile objects and external URLs, replace with local file URLs
     *
     * @param mixed $data
     * @param array $component
     * @return mixed
     */
    public function recursiveProcessFiles($data, $component)
    {
        if ($data instanceof UploadedFile) {
            // Upload the file and return the file URL
            return $this->uploadTemplateFile($data);
        }

        if (is_string($data) && $this->isValidImageUrl($data)) {
            // Download external image URL and return local URL
            try {
                return $this->downloadAndStoreImage($data);
            } catch (Exception $e) {
                Log::warning('Failed to download external image, using original URL', [
                    'url' => $data,
                    'error' => $e->getMessage()
                ]);
                // Return original URL as fallback
                return $data;
            }
        }

        if (is_array($data)) {
            $processed = [];
            foreach ($data as $key => $value) {
                if ($value instanceof UploadedFile) {
                    // Upload the file and replace with URL
                    $processed[$key] = $this->uploadTemplateFile($value);
                } elseif (is_string($value) && $this->isValidImageUrl($value)) {
                    // Download external image URL and replace with local URL
                    try {
                        $processed[$key] = $this->downloadAndStoreImage($value);
                    } catch (Exception $e) {
                        Log::warning('Failed to download external image, using original URL', [
                            'url' => $value,
                            'error' => $e->getMessage()
                        ]);
                        // Return original URL as fallback
                        $processed[$key] = $value;
                    }
                } elseif (is_array($value)) {
                    // Recursively process nested arrays
                    $processed[$key] = $this->recursiveProcessFiles($value, $component);
                } else {
                    $processed[$key] = $value;
                }
            }
            return $processed;
        }

        return $data;
    }

    /**
     * Check if a string is a valid image URL
     *
     * @param string $url
     * @return bool
     */
    private function isValidImageUrl(string $url): bool
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        // Check for common image extensions in URL
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
        $path = parse_url($url, PHP_URL_PATH);

        if (!$path) {
            return false;
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Also check for image hosting domains
        $imageDomains = ['scontent.whatsapp.net', 'cdn.', 'img.', 'image.', 'media.', 'static.'];

        return in_array($extension, $imageExtensions) ||
               str_contains($url, 'scontent.whatsapp.net') ||
               $this->containsImageDomain($url, $imageDomains);
    }

    /**
     * Check if URL contains known image domains
     *
     * @param string $url
     * @param array $domains
     * @return bool
     */
    private function containsImageDomain(string $url, array $domains): bool
    {
        foreach ($domains as $domain) {
            if (str_contains($url, $domain)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Upload a template file and return the file path/URL
     *
     * @param UploadedFile $file
     * @return string
     */
    public function uploadTemplateFile(UploadedFile $file): string
    {
        $originalNameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $imageFileName = date('Ymd') . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . $file->extension();

        objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $imageFileName, file_get_contents($file));

        // Return the file URL using objectStorage()->url()
        $filePath = 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'campaigns' . DIRECTORY_SEPARATOR . $imageFileName;
        return objectStorage()->url($filePath);
    }

    /**
     * Download and store external image URL locally
     *
     * @param string $imageUrl The external image URL
     * @return string The local file URL
     * @throws Exception If download fails
     */
    public function downloadAndStoreImage(string $imageUrl): string
    {
        try {
            // Validate URL
            if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                throw new Exception("Invalid image URL: {$imageUrl}");
            }

            // First, check if URL is accessible with a HEAD request
            if (!$this->isImageUrlAccessible($imageUrl)) {
                throw new Exception("Image URL is not accessible: {$imageUrl}");
            }

            // Get image content with proper headers to avoid 403 errors
            $context = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                        'Accept: image/webp,image/apng,image/*,*/*;q=0.8',
                        'Accept-Language: en-US,en;q=0.9',
                        'Accept-Encoding: gzip, deflate, br',
                        'DNT: 1',
                        'Connection: keep-alive',
                        'Upgrade-Insecure-Requests: 1',
                    ],
                    'timeout' => 30,
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);

            $imageContent = file_get_contents($imageUrl, false, $context);

            if ($imageContent === false) {
                throw new Exception("Failed to download image from: {$imageUrl}");
            }

            // Detect image type
            $imageInfo = getimagesizefromstring($imageContent);
            if (!$imageInfo) {
                throw new Exception("Invalid image content from: {$imageUrl}");
            }

            // Get extension from MIME type
            $mimeToExt = [
                'image/jpeg' => 'jpg',
                'image/jpg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
            ];

            $extension = $mimeToExt[$imageInfo['mime']] ?? 'jpg';

            // Generate unique filename
            $imageFileName = date('Ymd') . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . $extension;

            // Store the image
            objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $imageFileName, $imageContent);

            // Return the file URL
            $filePath = 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'campaigns' . DIRECTORY_SEPARATOR . $imageFileName;
            return objectStorage()->url($filePath);

        } catch (Exception $e) {
            Log::error('Image download failed', [
                'url' => $imageUrl,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Check if an image URL is accessible
     *
     * @param string $url
     * @return bool
     */
    private function isImageUrlAccessible(string $url): bool
    {
        try {
            $context = stream_context_create([
                'http' => [
                    'method' => 'HEAD',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                        'Accept: image/webp,image/apng,image/*,*/*;q=0.8',
                    ],
                    'timeout' => 10,
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);

            $headers = get_headers($url, 1, $context);

            if (!$headers) {
                return false;
            }

            // Check for successful response codes
            $statusCode = null;
            if (isset($headers[0]) && preg_match('/HTTP\/\d+\.\d+\s+(\d+)/', $headers[0], $matches)) {
                $statusCode = (int)$matches[1];
            }

            // Accept 200-299 status codes
            return $statusCode >= 200 && $statusCode < 300;

        } catch (Exception $e) {
            Log::warning('URL accessibility check failed', [
                'url' => $url,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Remove all UploadedFile objects from an array recursively
     *
     * @param mixed $data
     * @return mixed
     */
    public function removeUploadedFiles($data)
    {
        if ($data instanceof UploadedFile) {
            return null; // Remove UploadedFile objects
        }
        
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                if ($value instanceof UploadedFile) {
                    continue; // Skip UploadedFile objects
                }
                $cleaned[$key] = $this->removeUploadedFiles($value);
            }
            return $cleaned;
        }
        
        return $data;
    }


    /**
     * Store data and create records in database
     *
     * @param \Modules\MarketingBot\Responses\ChannelResponse|array $result The response from channel API
     * @param Campaign $service The campaign instance
     * @param array $requestArray The request data array containing contact_id and other information
     * @return Archive|string The created Archive instance or error message string
     */
    public function storeInfo($result, $service, $requestArray): array|string
    {
        DB::beginTransaction();
        
        try {
            // Build query to find existing archive
            $query = Archive::with('metas')
                ->where('user_id', auth()->id())
                ->where('type', $this->chatType);
            
            // Add channel filter if provided
            if (isset($requestArray['channel'])) {
                $query = $this->buildArchiveQuery($query, 'channel', $requestArray['channel']);
            }
            
            // Build recipient query (handles both contact_id and segment_id)
            $query = $this->buildRecipientQuery($query, $requestArray);
            
            $parentId = $query->first()->id ?? null;
            
            if (!$parentId) {
                $chat = $this->createNewChat($requestArray);
                $userReply = $this->createCampaignReply($chat->id, $service, $result, $requestArray);
                $parent = $chat;
            } else {
                $userReply = $this->createCampaignReply($parentId, $service, $result, $requestArray);
                $parent = Archive::find($parentId);
            }

            // Update parent conversation timestamp
            if ($parent) {
                $parent->setMeta('last_interaction_at', now());
                $parent->setMeta('ai_reply', $requestArray['ai_reply'] ?? 'off');
                $parent->save();
            }

            DB::commit();

            return $userReply;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('CampaignService::storeInfo failed', [
                'error' => $e->getMessage(),
                'request_array' => $requestArray,
                'trace' => $e->getTraceAsString()
            ]);
            return $e->getMessage();
        }
    }

    /**
     * Creates a new chat archive record.
     * 
     * Initializes a new Archive record for a marketing bot conversation with
     * the provided contact and channel information.
     *
     * @param array $requestArray Array containing contact_number, channel, contact_id, segment_id, etc.
     * @return Archive The newly created chat Archive instance
     */
    protected function createNewChat(array $requestArray)
    {
        $chat = new Archive();
        
        // Set basic fields (these are always columns)
        $chat->title = $requestArray['contact_number'] ?? $requestArray['title'] ?? 'Untitled';
        $chat->unique_identifier = Str::uuid();
        $chat->user_id = auth()->id();
        $chat->type = $this->chatType;
        
        // Set dynamic fields (column or metadata)
        if (isset($requestArray['channel'])) {
            $this->setArchiveField($chat, 'channel', $requestArray['channel']);
        }
        
        if (isset($requestArray['contact_id'])) {
            $this->setArchiveField($chat, 'contact_id', $requestArray['contact_id']);
        }
        
        if (isset($requestArray['segment_id'])) {
            $this->setArchiveField($chat, 'segment_id', $requestArray['segment_id']);
        }
        
        if (isset($requestArray['telegram_chat_id'])) {
            $this->setArchiveField($chat, 'telegram_chat_id', $requestArray['telegram_chat_id']);
        }
        
        if (isset($requestArray['chat_type'])) {
            $this->setArchiveField($chat, 'chat_type', $requestArray['chat_type']);
        }
        
        if (isset($requestArray['ai_reply'])) {
            $this->setArchiveField($chat, 'ai_reply', $requestArray['ai_reply'] ?? 'off');
        }
        
        // Set metadata fields (these are always metadata)
        $chat->setMeta('last_interaction_at', now());
        $chat->setMeta('has_unread_message', true);
        $chat->setMeta('has_unread_message_count', 0);
        
        $chat->save();

        return $chat;
    }

    /**
     * Creates a user reply record for the specified parent chat.
     *
     * @param  int  $parentId  The ID of the parent chat.
     * @param  mixed  $service  The campaign service instance.
     * @param  \Modules\MarketingBot\Responses\ChannelResponse|array  $result  The response from channel API.
     * @param  array  $requestArray  The request data array.
     * @return Archive The newly created user reply instance.
     */
    protected function createCampaignReply($parentId, $service, $result, $requestArray)
    {
        $channel = strtolower($service->channel ?? '');
        
        $userReply = new Archive();
        $userReply->parent_id = $parentId;
        $userReply->user_id = auth()->id();
        $userReply->type = $this->chatType. "_chat_reply";
        $userReply->reply_by = 'user';
        
        // Set channel-specific fields dynamically
        $this->setChannelSpecificFields($userReply, $channel, $service, $requestArray);
        
        // Extract and set response data dynamically
        $this->setResponseData($userReply, $result, $channel);

        $userReply->save();
        return $userReply;
    }

    /**
     * Set channel-specific fields for the archive record.
     *
     * @param  Archive  $archive  The archive instance.
     * @param  string  $channel  The channel name.
     * @param  mixed  $service  The campaign service instance.
     * @param  array  $requestArray  The request data array.
     * @return void
     */
    protected function setChannelSpecificFields($archive, string $channel, $service, array $requestArray = []): void
    {
        switch ($channel) {
            case 'whatsapp':
                $archive->message_type = 'template';
                if (isset($service->template)) {
                    $archive->bot_reply = $service->template;
                }
                break;

            case 'telegram':
                $archive->message_type = 'text';
                // Telegram uses campaign content or message as bot_reply
                if (isset($service->content)) {
                    $archive->bot_reply = $service->content;
                } elseif (isset($requestArray['message'])) {
                    $archive->bot_reply = $requestArray['message'];
                }
                // Store image URL if campaign has an image
                if (isset($service->image) && !empty($service->image)) {
                    $imageUrl = objectStorage()->url('public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'campaigns' . DIRECTORY_SEPARATOR . $service->image);
                    $this->setArchiveField($archive, 'image_url', $imageUrl);
                }
                break;

            default:
                // For other channels, set defaults
                $archive->message_type = 'text';
                if (isset($service->content)) {
                    $archive->bot_reply = $service->content;
                } elseif (isset($service->template)) {
                    $archive->bot_reply = $service->template;
                } elseif (isset($requestArray['message'])) {
                    $archive->bot_reply = $requestArray['message'];
                }
                break;
        }
    }

    /**
     * Extract and set response data from channel API response.
     *
     * @param  Archive  $archive  The archive instance.
     * @param  \Modules\MarketingBot\Responses\ChannelResponse|array  $result  The response from channel.
     * @param  string  $channel  The channel name.
     * @return void
     */
    protected function setResponseData($archive, $result, string $channel): void
    {
        // Handle ChannelResponse format
        if ($result instanceof \Modules\MarketingBot\Responses\ChannelResponse) {
            $responseData = $result->getData();
            $archive->message_response_raw = json_encode($responseData);
            $archive->message_id = $this->extractMessageId($responseData, $channel);
        } else {
            // Legacy format support
            $archive->message_response_raw = json_encode($result);
            $archive->message_id = $this->extractMessageId($result, $channel, true);
        }
    }

    /**
     * Extract message ID from response data based on channel type.
     *
     * @param  array  $responseData  The response data.
     * @param  string  $channel  The channel name.
     * @param  bool  $legacyFormat  Whether using legacy format (with 'body' key).
     * @return string|null The message ID or null if not found.
     */
    protected function extractMessageId(array $responseData, string $channel, bool $legacyFormat = false): ?string
    {
        $data = $legacyFormat ? ($responseData['body'] ?? []) : $responseData;

        switch ($channel) {
            case 'whatsapp':
                // WhatsApp response structure: messages[0]['id'] or body.messages[0]['id']
                return $data['messages'][0]['id'] 
                    ?? $data['body']['messages'][0]['id'] 
                    ?? null;

            case 'telegram':
                // Telegram response structure: result.message_id or result['message_id']
                return $data['result']['message_id'] 
                    ?? $data['message_id'] 
                    ?? ($data['result']['message']['message_id'] ?? null);

            default:
                // Generic extraction - try common patterns for other channels
                return $data['messages'][0]['id'] 
                    ?? $data['message_id'] 
                    ?? $data['result']['message_id'] 
                    ?? $data['id'] 
                    ?? ($data['result']['id'] ?? null);
        }
    }

    /**
     * Retrieves all campaigns owned by the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllCampaign()
    {
        return MarketingCampaign::with('metas')->where('user_id', auth()->id())->withCount(['trainedMaterials as trained_materials_count']);
    }

    /**
     * Update an existing campaign for the authenticated user.
     * 
     * Updates campaign details including title, end date, status, schedule settings,
     * and AI reply configuration.
     *
     * @param array $data The updated campaign data
     * @param int|string $id The campaign ID to update
     * @return MarketingCampaign The updated campaign instance
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If campaign is not found
     */
    public function update(array $data, $id)
    {
        $campaign = MarketingCampaign::where('user_id', auth()->id())->findOrFail($id);

        $campaign->title = $data['title'];

        if (isset($data['ends_at'])) {
            $campaign->ends_at = $data['ends_at'];
        }

        $campaign->ai_reply = isset($data['ai_reply']) ? 'on' : 'off';
        $campaign->schedule = isset($data['schedule']) ? 'on' : 'off';

        if (isset($data['ai_reply'])) {
            $campaign->chat_provider = $data['chat_provider'];
            $campaign->chat_model = $data['chat_model'];
            $campaign->embedding_provider = $data['embedding_provider'];
            $campaign->embedding_model = $data['embedding_model'];
        }
        

        if (isset($data['schedule'])) {
            $campaign->schedule_date = $data['schedule_date'] ?? null;
            $campaign->schedule_time = $data['schedule_time'] ?? null;

            if (! empty($data['schedule_date']) && ! empty($data['schedule_time'])) {
                $campaign->schedule_at = \Carbon\Carbon::parse($data['schedule_date'].' '.$data['schedule_time']);
            }
        }

        $campaign->save();

        return $campaign;
    }

    /**
     * Get the count of active (running) campaigns for the authenticated user.
     *
     * @return int The number of active campaigns
     */
    public function activeCampaigns(): int
    {
        return MarketingCampaign::where(['user_id' => Auth::id(), 'status' => 'published'])->where('ends_at', '>', Carbon::now())->count();
    }

    /**
     * Get the count of scheduled campaigns for the authenticated user.
     *
     * @return int The number of scheduled campaigns
     */
    public function scheduledCampaigns()
    {
        return MarketingCampaign::where([
            ['user_id', Auth::id()],
            ['status', 'scheduled'],
        ])->count();
    }

    /**
     * Get the count of published (completed) campaigns for the authenticated user.
     *
     * @return int The number of published campaigns
     */
    public function publishedCampaigns()
    {
        return MarketingCampaign::where([
            ['user_id', Auth::id()],
            ['status', 'published'],
        ])->count();
    }

    /**
     * Calculate the success rate of campaigns for the authenticated user.
     * 
     * Success rate is calculated as the percentage of completed campaigns
     * out of the total campaigns.
     *
     * @return float The success rate percentage (0.0 to 100.0), rounded to 2 decimal places
     */
    public function successRate(): float
    {
        $userId = Auth::id();

        $total = MarketingCampaign::where('user_id', $userId)->count();

        if ($total === 0) {
            return 0.0;
        }

        $completed = MarketingCampaign::where([
            ['user_id', $userId],
            ['status', 'published'],
        ])->count();

        $rate = ($completed / $total) * 100;

        return round($rate, 2);
    }

    /**
     * Delete a campaign owned by the authenticated user.
     *
     * @param int|string $id Campaign ID
     * @return void
     *
     * @throws Exception If campaign is not found
     */
    public function deleteCampaign($id)
    {
        $campaign = MarketingCampaign::where('user_id', auth()->id())->where('id', $id)->first();

        if (! $campaign) {
            throw new Exception(__('Campaign not found'), Response::HTTP_NOT_FOUND);
        }

        $campaign->delete();
    }

    /**
     * Retrieves a campaign by ID.
     *
     * @param int|string $id The campaign ID.
     *
     * @return \Modules\MarketingBot\Entities\MarketingCampaign|null The campaign object if found, null otherwise.
     */
    public function getCampaignById($id)
    {
        return MarketingCampaign::where('user_id', auth()->id())->where('id', $id)->first();
    }

    /**
     * Retrieves the preference data for the marketing-bot feature.
     *
     * @return array The processed preference data.
     *
     * @throws \Exception If the feature is not found.
     */
    public function getSettings()
    {   
        try {
            return (new FeaturePreferenceService())->processData('marketing-bot');
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Stores the user's settings for the marketing-bot feature.
     *
     * @param string $type The type/category of settings to store
     * @param array $data The settings data to store
     *
     * @return \App\Models\User The updated user model instance
     */
    public function storeSettings(string $type,array $data)
    {
        $id = auth()->user()->id;

        $user = \App\Models\User::where('id', $id)->first();

        // Store settings first
        $user->setMeta($type, json_encode($data));
        $user->save();

        // Check connection status after saving
        $webhookUrl = null;
        $connectionResult = $this->checkConnection($type, $id, $webhookUrl);
        
        // Update stored settings with connection status
        $storedData = json_decode($user->getMeta($type), true);
        $storedData['webhook_connected'] = $connectionResult['success'] ?? false;
        $storedData['connection_message'] = $connectionResult['message'] ?? '';
        
        // Update the stored meta with connection status
        $user->setMeta($type, json_encode($storedData));
        $user->save();

        return $user;
    }

    /**
     * Check connection status for a given channel type using ChannelManager.
     *
     * @param string $type The channel type ('whatsapp' or 'telegram').
     * @param int $userId The user ID.
     * @param string|null $webhookUrl Optional webhook URL for Telegram.
     * @return array ['success' => bool, 'message' => string]
     */
    public function checkConnection(string $type, int $userId, ?string $webhookUrl = null): array
    {
        try {
            Log::info("Starting connection check", [
                'channel_type' => $type,
                'user_id' => $userId,
                'webhook_url_provided' => !empty($webhookUrl)
            ]);
            
            $manager = ChannelManager::find($type);
            
            if (!$manager || !method_exists($manager, 'checkConnection')) {
                Log::warning("Manager not found or checkConnection method missing", [
                    'channel_type' => $type,
                    'user_id' => $userId,
                    'manager_exists' => !is_null($manager),
                    'method_exists' => $manager ? method_exists($manager, 'checkConnection') : false
                ]);
                return [
                    'success' => false,
                    'message' => __('Channel manager not found or connection check method unavailable.')
                ];
            }
            
            // Call manager's checkConnection method dynamically - each manager handles its own logic
            $result = $manager->checkConnection($userId, $webhookUrl);
            
            Log::info("Connection check completed", [
                'channel_type' => $type,
                'user_id' => $userId,
                'is_connected' => $result['success'] ?? false,
                'message' => $result['message'] ?? ''
            ]);
            
            return $result;
        } catch (Exception $e) {
            Log::error("Connection check failed for {$type}", [
                'channel_type' => $type,
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'message' => __('Connection check failed: ') . $e->getMessage()
            ];
        }
    }

    /**
     * Verify WhatsApp webhook subscription request.
     * 
     * Validates the webhook verification token and returns the challenge
     * if verification is successful.
     *
     * @param array $data Webhook verification data containing hub_mode, hub_verify_token, and hub_challenge
     * @return string|null The challenge string if verification succeeds
     * @throws \Exception If verification token is invalid
     */
    public function whatsappWebhookVerification(array $data)
    {
        $mode = data_get($data, 'hub_mode');
        $token = data_get($data, 'hub_verify_token');
        $challenge = data_get($data, 'hub_challenge');

        $user = User::whereHas('metas', function($query) use ($token) {
                $query->where('key', 'whatsapp')
                    ->whereJsonContains('value->whatsapp_token', $token);
            })->with('metas')->first();
            
        if ($mode === 'subscribe') {
            Log::info('WhatsApp Webhook verified successfully.');
            return $challenge;
        } else {
            throw new \Exception(__('Invalid verification token.'));
        }
    }

    /**
     * Process incoming WhatsApp webhook messages.
     * 
     * Handles incoming WhatsApp messages, creates or finds contacts,
     * stores user replies, and triggers auto-reply if configured.
     *
     * @param string $data JSON string containing the webhook payload
     * @return void
     */
    public function whatsappWebhook($data)
    {
        // $data is a JSON string, so concatenate it
        Log::info('Incoming WhatsApp Webhook: ' . $data);

        $result = json_decode($data, true);

        if (isset($result['entry'][0]['changes'][0]['value']['messages'][0])) {
            $message = $result['entry'][0]['changes'][0]['value']['messages'][0];
            $newData = [];

            // Handle text messages
            if (isset($message['text']['body']) && !empty($message['text']['body'])) {
                $newData['from'] = $message['from'];
                $newData['text'] = $message['text']['body'];
                $newData['messageId'] = $message['id'];
                $newData['message_type'] = 'text';
            }
            // Handle button responses
            elseif (isset($message['button'])) {
                $newData['from'] = $message['from'];
                $newData['text'] = $message['button']['text'] ?? '';
                $newData['button_payload'] = $message['button']['payload'] ?? '';
                $newData['messageId'] = $message['id'];
                $newData['message_type'] = 'button';
            }
            else {
                // Skip other message types (images, documents, etc.)
                return;
            }
            $businessId = $result['entry'][0]['id'];

            $userDetails = User::whereHas('metas', function($query) use ($businessId) {
                $query->where('key', 'whatsapp')
                    ->whereJsonContains('value->whatsapp_sid', $businessId);
            })->with('metas')->first();


            $contact = Contact::where('phone', $message['from'])->where('user_id', $userDetails->id)->where('channel', 'whatsapp')->first();

            if (!$contact) {
                $contactData['name'] = $result['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'];
                $contactData['phone'] = $message['from'];
                $contactData['user_id'] = $userDetails->id;
                $contactData['channel'] = 'whatsapp';
                $contact = $this->createNewContact($contactData);
            }

            $newData['contactId'] = $contact->id;
            $newData['contact_number'] = $contact->phone;

            $this->createUserChannelReply($result, $userDetails, $newData, 'whatsapp');
            $this->autoReply($userDetails, $newData, 'whatsapp');
        }
    }

    /**
     * Creates a new contact record.
     *
     * @param array $data The contact data to store.
     * @return Contact The newly created contact instance.
     */
    protected function createNewContact(array $data)
    {
        $contact = new Contact();
        foreach ($data as $key => $value) {
            $contact->{$key} = $value;
        }
        $contact->save();

        return $contact;
    }

    /**
     * Process incoming Telegram webhook messages.
     * 
     * Handles incoming Telegram messages for both private chats and groups/channels.
     * Creates or finds contacts/segments, stores user replies, and triggers auto-reply.
     *
     * @param array $data The Telegram webhook payload data
     * @param int $id The user ID associated with the Telegram bot
     * @return void
     */
    public function telegramWebhook($data, $id)
    {
        Log::info('Incoming Telegram Webhook: ' . json_encode($data));
        $type = 'telegram';
        if (isset($data['message'])) {
            $message = $data['message'];
            $userId = $message['from']['id'];
            $chatId = $message['chat']['id'];
            $chatType = $message['chat']['type'] ?? null;
            
            $newData = [
                'text' => $message['text'] ?? null,
                'messageId' => $message['message_id']
            ];

            // Store in contacts only for private chats
            if ($chatType === 'private') {
                $firstName = $message['from']['first_name'] ?? '';
                $lastName = $message['from']['last_name'] ?? '';
                $contactName = trim($firstName . ' ' . $lastName);
                $newData['title'] = $contactName;
                $newData['telegramChatId'] = (string) $chatId;
                $newData['chat_type'] = $chatType;

                // Find or create contact
                $contact = Contact::with('metas')->where('channel', $type)
                    ->whereHas('metas', function($query) use($userId){
                        $query->where('key', 'telegram_contact_id')->where('value', $userId);
                    })->first();
                    
                if (!$contact) {
                    $contactData['name'] = $contactName;
                    $contactData['telegram_contact_id'] = $userId;
                    $contactData['user_id'] = $id;
                    $contactData['channel'] = $type;

                    $contact = $this->createNewContact($contactData);
                }
                
                $newData['contactId'] = $contact->id;
            } elseif (in_array($chatType, ['group', 'supergroup', 'channel'])) {
                // Create or find segment for group/supergroup/channel
                $segmentName = $message['chat']['title'] ?? ('Telegram ' . ucfirst((string) $chatType) . ' ' . $chatId);
                $segment = Segment::where(['user_id' => $id, 'name' => $segmentName])->first();
                if (!$segment) {
                    $segment = new Segment();
                    $segment->user_id = $id;
                    $segment->name = $segmentName;
                    $segment->description = 'telegram:' . $chatId;
                    $segment->status = 'active';
                    $segment->channel = $type;
                    $segment->save();
                }

                // Set segment metas for channel-agnostic access
                $segment->setMeta('telegram_chat_id', (string) $chatId);
                $segment->setMeta('channel', $type);
                $segment->save();

                $newData['title'] = $segmentName;
                $newData['segmentId'] = $segment->id;
                $newData['telegramChatId'] = (string) $chatId;
            } else {
                // For groups/supergroups/channels, set a meaningful title and skip creating contact
                $newData['title'] = $message['chat']['title'] ?? ('Telegram ' . ucfirst((string) $chatType));
            }
            
            $userDetails = User::with('metas')->where('id', $id)->first();

            $this->createUserChannelReply($data, $userDetails, $newData, $type);
            $this->autoReply($userDetails, $newData, $type);
        }
    }

    
    /**
     * Creates a user reply record for the specified parent chat.
     *
     * @param array $result The result object containing bot response data.
     * @param User $userDetails The user details object.
     * @param array $data The data object containing the user reply data.
     * @param string $type The type of the channel (whatsapp or telegram).
     * @return void
     */
    protected function createUserChannelReply(array $result, User $userDetails, array $data, string $type): void
    {
        $contactId = data_get($data, 'contactId');
        $telegramChatId = (string) data_get($data, 'telegramChatId', '');
        $segmentId = (string) data_get($data, 'segmentId', '');
        $title = (string) data_get($data, 'title', 'Conversation');
        $text = (string) data_get($data, 'text', '');
        $messageId = (string) data_get($data, 'messageId', '');
        $chatType = (string) data_get($data, 'chat_type', '');
        $messageType = (string) data_get($data, 'message_type', 'text');
        $buttonPayload = (string) data_get($data, 'button_payload', '');

        // Try to find an existing parent chat
        $query = Archive::with('metas')
            ->where(['user_id' => $userDetails->id, 'type' => $this->chatType]);
        
        if ($contactId) {
            $query = $this->buildArchiveQuery($query, 'contact_id', $contactId);
        } elseif ($telegramChatId && $type === 'telegram') {
            $query = $this->buildArchiveQuery($query, 'telegram_chat_id', $telegramChatId);
        }
        
        $parent = $query->first();

        // No parent found for non-Telegram → stop early
        if (!$parent && $type !== 'telegram') {
            $chat = new Archive();
            $chat->title = $data['contact_number'];
            $chat->unique_identifier = Str::uuid();
            $chat->user_id = $userDetails->id;
            $chat->type = $this->chatType;
            
            $this->setArchiveField($chat, 'channel', $type);
            if ($contactId) {
                $this->setArchiveField($chat, 'contact_id', $contactId);
            }
            
            $chat->setMeta('last_interaction_at', now());
            $chat->save();
            $parent = $chat;
        }

        // Create a new parent conversation for Telegram if needed
        if (!$parent && $type === 'telegram') {
            $chat = new Archive();
            $chat->title = $title;
            $chat->unique_identifier = Str::uuid();
            $chat->user_id = $userDetails->id;
            $chat->type = $this->chatType;
            
            $this->setArchiveField($chat, 'channel', $type);
            if ($contactId) {
                $this->setArchiveField($chat, 'contact_id', $contactId);
            }
            if ($telegramChatId) {
                $this->setArchiveField($chat, 'telegram_chat_id', $telegramChatId);
            }
            if ($segmentId) {
                $this->setArchiveField($chat, 'segment_id', $segmentId);
            }
            if ($chatType) {
                $this->setArchiveField($chat, 'chat_type', $chatType);
            }
            
            $chat->setMeta('last_interaction_at', now());
            $chat->save();
            $parent = $chat;
        }

        // Create user reply (child message)
        $botReply = new Archive();
        $botReply->parent_id = $parent->id;
        $botReply->raw_response = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $botReply->type = $this->chatType . '_chat_reply';

        // Store message content based on type
        if ($messageType === 'button' && !empty($buttonPayload)) {
            $botReply->user_reply = $text;
        } else {
            $botReply->user_reply = $text;
        }

        $botReply->message_id = $messageId;

        $this->setArchiveField($botReply, 'channel', $type);
        $this->setArchiveField($botReply, 'message_type', $messageType);

        if ($messageType === 'button' && !empty($buttonPayload)) {
            $this->setArchiveField($botReply, 'button_payload', $buttonPayload);
            $this->setArchiveField($botReply, 'button_text', $text);
        }

        $botReply->save();

        // Update last communication timestamp
        $this->setArchiveField($parent, 'last_interaction_at', now());
        $this->setArchiveField($parent, 'has_unread_message', false);
        $currentCount = $this->getArchiveField($parent, 'has_unread_message_count', 0);
        $this->setArchiveField($parent, 'has_unread_message_count', $currentCount + 1);
        $parent->save();

        $this->data['parent_id'] = $parent->id;
    }


    /**
     * Store reply message response in database.
     * 
     * Creates an archive record for a reply message sent through a channel,
     * supporting both ChannelResponse format and legacy array format.
     *
     * @param array $data Reply message data containing conversation_id and message
     * @param \Modules\MarketingBot\Responses\ChannelResponse|array $result Response from channel API
     * @param bool $isAiAgent Whether the reply was sent by an AI agent (default: false)
     * @return Archive The created Archive instance for the reply message
     */
    public function sendReplyMessage(array $data, $result, $isAiAgent = false)
    {
        $conversationId = $data['conversation_id'];
        $parent = Archive::with('metas')->where('id', $conversationId)->first();
        $message = $data['message'];

        $userReply = new Archive();
        $userReply->parent_id = $conversationId;
        $userReply->user_id = auth()->id();
        $userReply->type = $this->chatType. "_chat_reply";
        
        $userReply->bot_reply = $message;
        Log::info('Message: ' . json_encode($message));
        // Handle ChannelResponse format
        if ($result instanceof \Modules\MarketingBot\Responses\ChannelResponse) {
            $responseData = $result->getData();
            $userReply->message_response_raw = json_encode($responseData);
            // Extract message ID from response data
            $messageId = $responseData['messages'][0]['id'] ?? ($responseData['body']['messages'][0]['id'] ?? null);
            $userReply->message_id = $messageId;
        } else {
            // Legacy format support
            $userReply->message_response_raw = json_encode($result);
            $userReply->message_id = $result['body']['messages'][0]['id'] ?? null;
        }

        $userReply->reply_by = $isAiAgent ? 'ai_agent' : 'user';
        $userReply->save();

        // Update last communication timestamp
        $this->setArchiveField($parent, 'last_interaction_at', now());
        $parent->save();
        
        return $userReply;
    }

    /**
     * Delete a subscriber owned by the authenticated user.
     *
     * @param array $requestData An array containing the ID of the subscriber to be deleted.
     *
     * @throws Exception If no subscriber is found or an error occurs during deletion.
     * @return void
     */
    public function deleteSubscriber(array $requestData): void
    {
        DB::beginTransaction();
        try {

            $subscriber = Contact::where('id', $requestData['id'])->where('user_id', auth()->user()->id)->first();
            
            if (!$subscriber) {
                throw new Exception(__('No :x found.', ['x' =>  __('Subscriber')]), Response::HTTP_NOT_FOUND);
            }

            $subscriber->unsetMeta(array_keys($subscriber->getMeta()->toArray()));
            $subscriber->save();

            $subscriber->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a group owned by the authenticated user.
     *
     * @param array $requestData An array containing the ID of the group to be deleted.
     *
     * @throws Exception If no group is found or an error occurs during deletion.
     * @return void
     */
    public function deleteGroup(array $requestData): void
    {
        DB::beginTransaction();
        try {

            $group = Segment::where('id', $requestData['id'])->where('user_id', auth()->user()->id)->first();
            
            if (!$group) {
                throw new Exception(__('No :x found.', ['x' =>  __('Group')]), Response::HTTP_NOT_FOUND);
            }

            $group->unsetMeta(array_keys($group->getMeta()->toArray()));
            $group->save();

            $group->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a chat conversation and all related messages and metadata.
     *
     * @param int $id The conversation ID to delete.
     *
     * @throws Exception If no conversation is found or an error occurs during deletion.
     * @return void
     */
    public function deleteChat($id): void
    {
        DB::beginTransaction();
        try {
            // Find the conversation and verify ownership
            $conversation = Archive::with('metas')->where('id', $id)
                ->where('type', 'marketing_bot')
                ->where('user_id', auth()->user()->id)
                ->first();
            
            if (!$conversation) {
                throw new Exception(__('No :x found.', ['x' => __('Chat')]), Response::HTTP_NOT_FOUND);
            }

            // Delete all child messages (messages with parent_id = conversation id)
            $childMessages = Archive::with('metas')->where('parent_id', $id)->get();
            foreach ($childMessages as $message) {
                // Delete metadata for each message
                $message->unsetMeta(array_keys($message->getMeta()->toArray()));
                $message->save();
            }
            // Delete all child messages
            Archive::where('parent_id', $id)->delete();

            // Delete conversation metadata
            $conversation->unsetMeta(array_keys($conversation->getMeta()->toArray()));
            $conversation->save();

            // Delete the conversation
            $conversation->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Check if auto-reply should proceed for the given parent conversation
     *
     * @param int $parentId The parent conversation ID
     * @return bool Whether auto-reply should proceed
     */
    protected function shouldAutoReply(int $parentId): bool
    {
        $parent = Archive::with('metas')->where('id', $parentId)->first();

        if (!$parent) {
            return false;
        }

        return $parent->ai_reply == 'on';
    }

    /**
     * Process automatic reply for incoming messages using AI.
     *
     * Finds an active campaign with AI reply enabled, creates embeddings for the user's message,
     * finds similar vectors from training materials, generates an AI response, and sends it.
     *
     * @param User $userDetails The user details object
     * @param array $data Message data containing text, contactId, and contact_number
     * @param string $type The channel type (whatsapp, telegram, etc.)
     * @return Archive|null The Archive instance of the sent reply, or null if no campaign found
     */
    public function autoReply(User $userDetails, array $data, string $type)
    {
        $userId = $userDetails->id;

        // Check if parent ai_reply is enabled before processing auto-reply
        if (isset($this->data['parent_id']) && !$this->shouldAutoReply($this->data['parent_id'])) {
            Log::info('Auto-reply skipped: Agent reply is not enabled', [
                'user_id' => $userId,
                'contact_id' => data_get($data, 'contactId'),
                'parent_id' => $this->data['parent_id']
            ]);
            return;
        }

        // Check if user has a valid subscription and if it has active limits before processing auto-reply
        if (!subscription('isAdminSubscribed', $userId)) {
            $subscription = subscription('getUserSubscription', $userId);
            if (!$subscription) {
                Log::info('Auto-reply skipped: User does not have a subscription', [
                    'user_id' => $userId,
                    'contact_id' => data_get($data, 'contactId')
                ]);

                if (isset($this->data['parent_id'])) {
                    $this->createSystemMessage($this->data['parent_id'], __('Auto-reply paused: Active subscription required.'), $userId, 'subscription_error');
                }

                return;
            }

            // Check if subscription limit has been reached
            $validation = subscription('isValidSubscription', $userId, 'word');
            if ($validation['status'] !== 'success') {
                Log::info('Auto-reply skipped: Subscription limit reached or invalid', [
                    'user_id' => $userId,
                    'contact_id' => data_get($data, 'contactId'),
                    'message' => 'Subscription limit reached'
                ]);

                if (isset($this->data['parent_id'])) {
                    $this->createSystemMessage($this->data['parent_id'], __('Auto-reply paused: Subscription limit reached.'), $userId, 'subscription_error');
                }

                return;
            }
        }
        

        $contactId = data_get($data, 'contactId');

        Log::info('contactIds : ' . $contactId);
        
        $campaign = MarketingCampaign::query()
            ->with('metas')
            ->where('user_id', $userId)
            ->whereIn('status', ['published', 'running'])
            ->where('ends_at', '>', Carbon::now())
            ->withCount('trainedMaterials as trained_materials_count')
            ->latest()
            ->first();
        
        if (! $campaign || $campaign->trained_materials_count === 0) {
            $this->createSystemMessage($this->data['parent_id'], __('Auto-reply skipped: No trained materials found.'), $userId, 'system_error');
            return;
        }
        
        // Check if ai_reply is enabled after fetching the latest campaign
        $aiReplyMeta = $campaign->metas->where('key', 'ai_reply')->first();
        if (! $aiReplyMeta || $aiReplyMeta->value !== 'on') {
            return;
        }
        
        Log::info('Campaign: ' . json_encode($campaign));

        $this->data['text'] = $data['text'];
        $this->data['model'] = $campaign->chat_model;
        $this->data['provider'] = $campaign->chat_provider;
        $this->data['channel'] = $type;
        $this->data['contact_number'] = $data['contact_number'] ?? null;
        $campaignId = $campaign->id;

        $options['model'] = $campaign->embedding_model;
        $options['text'] = $data['text'];

        $aiEmbeddingProvider = AiProviderManager::isActive($campaign->embedding_provider, 'aiembedding');
        
        if (! $aiEmbeddingProvider) {
            Log::info('AI Embedding Provider not found.');
            return;
        }
        
        $this->userId = $campaign->user_id;
        $vector =  $aiEmbeddingProvider->createEmbeddings($options);
        $userId = (new ContentService())->getCurrentMemberUserId('meta', null, ['user_id' => $this->userId]);
        
        if (!subscription('isAdminSubscribed', $userId)) {
            try {
                handleSubscriptionAndCredit(
                    subscription('getUserSubscription', $userId), 
                    'word', 
                    subscription('tokenToWord', $vector->expense()), 
                    $userId, 
                    ['owner_id' => $this->userId]
                );
            } catch (\Exception $e) {
                Log::warning('Auto-reply: Failed to handle subscription and credit', [
                    'user_id' => $userId,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                // Continue processing even if subscription handling fails
            }
        }

        
        Log::info('Subscription and Credit: ' . json_encode($vector->expense()));

        if (filled($vector->content())) {
            $embeddedFiles = (new TrainingMaterialService())->model()->whereNull('vector')
            ->whereHas('metas', function ($query) use ($campaignId) {
                $query->where(function ($subQuery) use ($campaignId) {
                    $subQuery->where('key', 'campaign_id')
                             ->where('value', $campaignId);
                });
            })->pluck('id')->toArray();
            
            return $this->getMostSimilarVectors($vector->content(), $embeddedFiles, $this->chunkSize);
        }
    }

    /**
     * Create a system message in the chat archive.
     *
     * @param int $parentId
     * @param string $message
     * @param int $userId
     * @return void
     */
    protected function createSystemMessage($parentId, $message, $userId, $errorType = 'system_error')
    {
        $systemMsg = new Archive();
        $systemMsg->parent_id = $parentId;
        $systemMsg->user_id = $userId;
        $systemMsg->type = $this->chatType . '_chat_reply';
        $systemMsg->bot_reply = $message;
        $systemMsg->reply_by = 'system';
        $this->setArchiveField($systemMsg, 'error_type', $errorType);
        $systemMsg->save();
        
        // Update parent timestamp
        $parent = Archive::find($parentId);
        if ($parent) {
            $this->setArchiveField($parent, 'last_interaction_at', now());
            $parent->save();
        }
    }

    /**
     * Retrieve the most similar vectors for a given vector.
     *
     * @param array $vector The vector for which to find similar vectors.
     * @param array|null $file_id The file ID to filter the vectors.
     * @param int $limit The maximum number of similar vectors to retrieve.
     * 
     * @return array An array containing the most similar vectors.
     */
    public function getMostSimilarVectors(array $vector, $file_id = null, int $limit = 10)
    {
        $embeddedFiles = (new TrainingMaterialService())->model()->whereNotNull('vector');
        $vectors = $embeddedFiles->whereIn('parent_id', $file_id)->get()
            ->map(function ($vector) {
                return [
                    'id' => $vector->id,
                    'vector' => json_decode($vector->vector, true),
                ];
            })
            ->toArray();

        $similarVectors = [];
        foreach ($vectors as $v) {
            $cosineSimilarity = $this->calculateCosineSimilarity($vector, $v['vector']);
            $similarVectors[] = [
                'id' => $v['id'],
                'similarity' => $cosineSimilarity,
            ];
        }

        usort($similarVectors, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        return $this->getTextsFromIds(array_column(array_slice($similarVectors, 0, $limit), 'id'));
    }

    /**
     * Retrieve text content from training material IDs and generate AI response.
     * 
     * Fetches training material texts by their IDs, merges them, generates an AI response
     * using the chat provider, and sends the reply message.
     *
     * @param array $ids Array of training material IDs
     * @return Archive|null The Archive instance of the sent reply, or null if chat provider not found
     */
    public function getTextsFromIds(array $ids)
    {
        $texts = (new TrainingMaterialService())->model()->whereIn('id', $ids)->get()->toArray();
    
        $textsById = [];

        foreach ($texts as $text) {
            $textsById[$text['id']] = $text['content'];
        }

        $textsOrderedByIds = [];

        foreach ($ids as $id) {
            if (isset($textsById[$id])) {
                $textsOrderedByIds[] = $textsById[$id];
            }
        }

        $mergedArray = implode(' ', $textsOrderedByIds);
        $options['content'] = $mergedArray;
        $options['model'] = $this->data['model'];
        $options['prompt'] = $this->data['text'];

        $chatProvider = AiProviderManager::isActive( $this->data['provider'], 'aiembedding');
        
        if (! $chatProvider) {
            Log::info('Chat Provider not found.');
            return ;
        }
        Log::info('Chat Provider');
        $result = $chatProvider->askQuestionToContent($options);

        $userId = (new ContentService())->getCurrentMemberUserId('meta', null, ['user_id' => $this->userId]);
        
        try {
            handleSubscriptionAndCredit(
                subscription('getUserSubscription', $userId), 
                'word', 
                $result->words(), 
                $userId, 
                ['owner_id' => $this->userId]
            );
        } catch (\Exception $e) {
            Log::warning('Auto-reply: Failed to handle subscription and credit in getTextsFromIds', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // Continue processing even if subscription handling fails
        }
        
        $options = [
            'conversation_id' => $this->data['parent_id'],
            'contact_number' => $this->data['contact_number'],
            'message' => $result->content,
            'channel' =>  $this->data['channel'],
            'user_id' => $this->userId
        ];

        request()->merge([
            'channel' =>  $this->data['channel'],
            'user_id' => $this->userId
        ]);
        
        $reply = (new ChannelService())->replyMessage($options);
        return $this->sendReplyMessage($options, $reply, true);
    }

    /**
     * Calculate the cosine similarity between two vectors.
     * 
     * Computes the cosine similarity score (ranging from -1 to 1) between two vectors
     * using the dot product and vector magnitudes.
     *
     * @param array $vector1 The first vector
     * @param array $vector2 The second vector
     * @return float The cosine similarity score between the two vectors
     */
    private function calculateCosineSimilarity(array $vector1, array $vector2): float
    {
        $dotProduct = 0;
        $vector1Normalization = 0;
        $vector2Normalization = 0;
    
        foreach ($vector1 as $i => $value) {
            $dotProduct += $value * $vector2[$i];
            $vector1Normalization += $value * $value;
            $vector2Normalization += $vector2[$i] * $vector2[$i];
        }
    
        $vector1Normalization = sqrt($vector1Normalization);
        $vector2Normalization = sqrt($vector2Normalization);
    
        return $dotProduct / ($vector1Normalization * $vector2Normalization);
    }

    /**
     * Normalize recipients data from various input formats to unified structure.
     * Handles segments/contacts (WhatsApp) and groups/subscribers (Telegram).
     *
     * @param array $data
     * @return array ['segments' => [...], 'contacts' => [...]]
     */
    protected function normalizeRecipients(array $data): array
    {
        $segments = [];
        $contacts = [];

        // Handle segments (WhatsApp) or groups (Telegram)
        if (!empty($data['segments'])) {
            $segments = $this->normalizeArray($data['segments']);
        } elseif (!empty($data['groups'])) {
            $segments = $this->normalizeArray($data['groups']);
        }

        // Handle contacts (WhatsApp) or subscribers (Telegram)
        if (!empty($data['contacts'])) {
            $contacts = $this->normalizeArray($data['contacts']);
        } elseif (!empty($data['subscribers'])) {
            $contacts = $this->normalizeArray($data['subscribers']);
        }

        return [
            'segments' => $segments,
            'contacts' => $contacts,
        ];
    }

    /**
     * Normalize input to array (handles comma-separated strings, arrays, JSON strings, etc.).
     *
     * @param mixed $value
     * @return array
     */
    protected function normalizeArray($value): array
    {
        if (empty($value)) {
            return [];
        }

        if (is_array($value)) {
            return array_filter(array_map('intval', $value));
        }

        if (is_string($value)) {
            // Try JSON first
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return array_filter(array_map('intval', $decoded));
            }
            
            // Try comma-separated
            $exploded = array_filter(array_map('trim', explode(',', $value)));
            return array_filter(array_map('intval', $exploded));
        }

        // Try to cast to int if single value
        if (is_numeric($value)) {
            return [(int) $value];
        }

        return [];
    }

    /**
     * Validate that selected segments have contacts.
     * 
     * For channels that extract contacts from segments (like WhatsApp), this ensures
     * that all selected segments contain at least one contact before creating the campaign.
     *
     * @param array $segmentIds Array of segment IDs to validate
     * @param string $channel The channel type (whatsapp, telegram, etc.)
     * @param int $userId The user ID
     * @return void
     * @throws Exception If any segment has no contacts
     */
    protected function validateSegmentContacts(array $segmentIds, string $channel, int $userId): void
    {
        // Skip validation if no segments are selected
        if (empty($segmentIds)) {
            return;
        }

        // Get the handler for the channel
        $handler = RecipientHandlerFactory::getHandler($channel);

        // Only validate for channels that extract contacts from segments
        // (e.g., WhatsApp extracts contacts, Telegram processes segments as groups)
        if ($handler->shouldProcessSegmentsAsGroups($channel)) {
            // For channels that process segments as groups (like Telegram), 
            // we don't need to validate contacts in segments
            return;
        }

        // Get contacts from segments using the handler
        $contactIds = $handler->getContactsFromSegments($segmentIds, $userId, $channel);

        // If we have contacts from segments, validation passes
        if (!empty($contactIds)) {
            return;
        }

        // No contacts found in any of the selected segments
        // Get segment names for better error message
        $segments = Segment::whereIn('id', $segmentIds)
            ->where('user_id', $userId)
            ->pluck('name', 'id')
            ->toArray();

        $segmentNames = [];
        foreach ($segmentIds as $segmentId) {
            $segmentNames[] = $segments[$segmentId] ?? __('Segment') . ' #' . $segmentId;
        }

        $segmentList = implode(', ', $segmentNames);
        
        throw new Exception(
            __('No contacts found under the selected segment(s): :segments. Please add contacts to the segment(s) before creating a campaign.', [
                'segments' => $segmentList
            ]),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    /**
     * Creates and returns the upload path for storing videos.
     * 
     * @return string The path to the upload directory for AI-generated videos.
     */
    public function uploadPath()
	{
		return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads','campaigns']));
	}

    /**
     * Update the auto reply status for a given archive conversation.
     *
     * @param int|string $id The ID of the archive conversation
     * @param array $request The request data containing ai_reply status
     * @return Archive The updated archive instance
     * @throws Exception If archive is not found or update fails
     */
    public function updateAutoReply($id, $request)
    {
        DB::beginTransaction();
        try {
            $archive = Archive::with('metas')->where('id', $id)->where('user_id', auth()->id())->where('type', 'marketing_bot')->first();

            if (!$archive) {
                throw new Exception(__('No :x found.', ['x' =>  __('Archive')]), Response::HTTP_NOT_FOUND);
            }
            
            $archive->ai_reply = $request['ai_reply'];
            $archive->save();
            DB::commit();
            
            return $archive;


        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Calculate Week-over-Week (WoW) growth for campaign metrics.
     *
     * Compares the current week with the previous week for various campaign metrics
     * and calculates the percentage growth. WoW growth is calculated as:
     * ((Current Week - Previous Week) / Previous Week) * 100
     *
     * @param string $metric The metric to calculate WoW for ('created', 'published', 'success_rate')
     * @return array Returns array with:
     *               - current_week: Current week's metric value
     *               - previous_week: Previous week's metric value
     *               - wow_growth: Week-over-week growth percentage
     *               - trend: 'up', 'down', or 'stable'
     *
     * @throws Exception When metric parameter is invalid
     */
    public function calculateWowGrowth(string $metric = 'created'): array
    {
        $userId = Auth::id();

        // Define metric queries
        $metrics = [
            'created' => function($query) {
                return $query->count();
            },
            'published' => function($query) {
                return $query->where('status', 'published')->count();
            },
            'success_rate' => function($query) {
                $total = $query->count();

                if ($total === 0) return 0.0;

                $completed = $query->where('status', 'published')->count();

                return ($completed / $total) * 100;
            }
        ];

        if (!isset($metrics[$metric])) {
            throw new Exception("Invalid metric. Supported metrics: 'created', 'published', 'success_rate'");
        }

        // Calculate current week (this week)
        $currentWeekStart = now()->startOfWeek();
        $currentWeekEnd = now()->endOfWeek();

        $currentWeekQuery = MarketingCampaign::where('user_id', $userId)
            ->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd]);

        $currentWeekValue = $metrics[$metric]($currentWeekQuery);

        // Calculate previous week
        $previousWeekStart = now()->startOfWeek()->subWeek();
        $previousWeekEnd = now()->endOfWeek()->subWeek();

        $previousWeekQuery = MarketingCampaign::where('user_id', $userId)
            ->whereBetween('created_at', [$previousWeekStart, $previousWeekEnd]);

        $previousWeekValue = $metrics[$metric]($previousWeekQuery);

        // Calculate WoW growth
        $wowGrowth = 0.0;
        $trend = 'stable';

        if ($previousWeekValue > 0) {
            $wowGrowth = (($currentWeekValue - $previousWeekValue) / $previousWeekValue) * 100;
            $trend = $wowGrowth > 0 ? 'up' : ($wowGrowth < 0 ? 'down' : 'stable');
        } elseif ($currentWeekValue > 0) {
            // If previous week was 0 but current week has value, it's infinite growth
            $wowGrowth = 100.0; // Represent as 100% growth
            $trend = 'up';
        }

        return [
            'current_week' => $currentWeekValue,
            'previous_week' => $previousWeekValue,
            'wow_growth' => round($wowGrowth, 2),
            'trend' => $trend,
            'metric' => $metric
        ];
    }

    /**
     * Get inbox data including conversations and total unread messages count.
     *
     * This method retrieves inbox conversations with metadata like last interaction time,
     * channel information, chat type, and unread message counts. It also calculates
     * the total number of unread messages across all conversations.
     *
     * @return array Returns an array containing:
     *               - inboxes: Paginated collection of inbox conversations
     *               - total_unread_messages: Total count of unread messages
     *
     * @throws Exception When database query fails
     */
    public function getInboxData(): array
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                throw new Exception("User must be authenticated");
            }

            // Get inbox conversations with metadata
            $inboxes = Archive::query()
                ->with('metas')
                ->leftJoin('archives_meta as m', function ($join) {
                    $join->on('m.owner_id', '=', 'archives.id')
                        ->where('m.key', 'last_interaction_at');
                })
                ->leftJoin('archives_meta as c', function ($join) {
                    $join->on('c.owner_id', '=', 'archives.id')
                        ->where('c.key', 'channel');
                })
                ->leftJoin('archives_meta as d', function ($join) {
                    $join->on('d.owner_id', '=', 'archives.id')
                        ->where('d.key', 'chat_type');
                })
                ->leftJoin('archives_meta as h', function ($join) {
                    $join->on('h.owner_id', '=', 'archives.id')
                        ->where('h.key', 'has_unread_message');
                })
                ->leftJoin('archives_meta as hc', function ($join) {
                    $join->on('hc.owner_id', '=', 'archives.id')
                        ->where('hc.key', 'has_unread_message_count');
                })
                ->where('archives.type', 'marketing_bot')
                ->where('archives.user_id', $userId)
                ->whereNotNull('m.value')
                ->select([
                    'archives.id',
                    'archives.title',
                    'archives.created_at',
                    'm.value as last_interaction_at',
                    'c.value as channel',
                    'd.value as chat_type',
                    'h.value as has_unread_message',
                    'hc.value as has_unread_message_count',
                ])
                ->filter('Modules\\MarketingBot\\Filters\\InboxFilter')
                ->orderByDesc('m.value')
                ->paginate(preference('row_per_page'));

            // Calculate total unread messages
            $totalUnreadMessages = Archive::query()
                ->with('metas')
                ->leftJoin('archives_meta as h', function ($join) {
                    $join->on('h.owner_id', '=', 'archives.id')
                        ->where('h.key', 'has_unread_message')
                        ->where('h.value', 0);
                })
                ->leftJoin('archives_meta as hc', function ($join) {
                    $join->on('hc.owner_id', '=', 'archives.id')
                        ->where('hc.key', 'has_unread_message_count')
                        ->where('hc.value', '>', 0);
                })
                ->where('archives.type', 'marketing_bot')
                ->where('archives.user_id', $userId)
                ->whereNotNull('h.value')
                ->sum('hc.value');

            return [
                'inboxes' => $inboxes,
                'total_unread_messages' => $totalUnreadMessages,
            ];

        } catch (Exception $e) {
            throw new Exception("Failed to retrieve inbox data: " . $e->getMessage());
        }
    }

    /**
     * Get marketing bot channel preferences
     *
     * @return array
     */
    public function getChannelPreferences(): array
    {
        $marketingBotPreference = \Modules\OpenAI\Entities\FeaturePreference::where('slug', 'marketing-bot')
            ->with('metas')
            ->first();

        $whatsappEnabled = false;
        $telegramEnabled = false;

        if ($marketingBotPreference) {
            $generalOptionsMeta = $marketingBotPreference->metas->where('key', 'general_options')->first();
            if ($generalOptionsMeta) {
                $generalOptions = json_decode($generalOptionsMeta->value, true);
                $whatsappEnabled = isset($generalOptions['whatsapp']) && $generalOptions['whatsapp'] === 'on';
                $telegramEnabled = isset($generalOptions['telegram']) && $generalOptions['telegram'] === 'on';
            }
        }

        return [
            'whatsapp_enabled' => $whatsappEnabled,
            'telegram_enabled' => $telegramEnabled,
        ];
    }
}
