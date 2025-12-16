<?php

/**
 * @package CampaignService
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Khayeruzzaman <[shakib.techvill@gmail.com]>
 * @created 02-11-2025
 */
namespace Modules\MarketingBot\Services;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Facades\AiProviderManager;
use Spekulatius\PHPScraper\PHPScraper;
use Illuminate\Database\Eloquent\Builder;
use Modules\OpenAI\Entities\EmbededResource;
use Modules\OpenAI\Services\ContentService;
use Illuminate\Database\Eloquent\Collection;
use Modules\OpenAI\Services\v2\EmbeddedService;
use Modules\OpenAI\Services\v2\FeaturePreferenceService;

class TrainingMaterialService
{

    /**
     * @var int The size of the chunk, default value is 256.
     */
    protected $chunkSize = 256;

    /**
     * Store the content provided in the requestData based on the type (file, url, or text).
     *
     * @param string $code
     * @param array $requestData An array containing the data to be stored.
     *
     * @return Builder[]|Collection The stored EmbededResource objects with their metas, user, and childs.
     *
     * @throws Exception If an error occurs during the storage process.
     */
    public function storeMaterials(string $code, array $requestData)
    {
        $service = new FeaturePreferenceService();
        $data = $service->processData('marketing-bot')['training_options'];

        $newArray = ['file' => 'file_upload', 'url' => 'website_url', 'text' => 'pure_text'];

        $type = $requestData['type'] ?? null;
    
        if (isset($newArray[$type]) && !$data[$newArray[$type]]) {
            throw new Exception(__(':x has been disabled for training. For assistance, please contact the administration.', ['x' => ucfirst(str_replace('_', ' ', $newArray[$type]))]));
        }

        $items = [];

        if ($type === 'file') {
            foreach ($requestData['file'] as $file) {
                $items[] = $this->parseContent($file);
            }
        } elseif ($type === 'url') {
            foreach ($requestData['urls'] as $url) {
                
                $items[] = $this->parseUrl($url);
            }
        } else {
            $items[] = [
                'content' => $requestData['text'],
                'fileInfo' => [
                    'file_path_name' => 'Text',
                    'originalName' => 'Text',
                ]
            ];
        }

        DB::beginTransaction();

        try {

            $ids = [];
            foreach ($items as $item) {

                $content = $item['content'];
                $word_count = str_word_count($content);

                $embed = null;
                $serviceData = [
                    'state' => 'Untrained',
                    'words' => $word_count,
                    'last_trained' => 'N\A'
                ];
            
                if ($type === 'url') {
                    $embed = EmbededResource::where(['original_name' => $url, 'category' => 'campaign', 'user_id' => auth()->user()->id])
                            ->whereHas('metas', function($query) use($code) {
                                $query->where(['key' => 'campaign_id', 'value' => $code]);
                            })->first();
                    if ($embed) {
                        $embed->content = $content;
                        $embed->updated_at = now();
                    }
                }

                if (is_null($embed)) {
                    $embed = new EmbededResource();
                    $embed->user_id = auth()->user()->id;
                    $embed->name = $item['fileInfo']['file_path_name'];
                    $embed->original_name = $item['fileInfo']['originalName'];
                    $embed->type = $type;
                    $embed->content = $content;
                    $embed->category = 'campaign';
                    
                    $serviceData['campaign_id'] = $code;
            
                    if ($type === 'file') {
                        $serviceData['size'] = $item['fileInfo']['fileSize'];
                        $serviceData['file_name'] = $item['fileInfo']['file_path_name'];
                        $serviceData['extension'] = $item['fileInfo']['extension'];
                    }
                }

                $embed->setMeta($serviceData);
                $embed->save();

                $ids[] = $embed->id;
            }

            DB::commit();

            return $this->model()->whereIn('id', $ids)->get();

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Extract text from various file formats.
     *
     * @param mixed $file
     *
     * @return mixed The result of extracting text from the file.
     */
    public function parseContent(mixed $file): mixed
    {
        $fileInfo = $this->storeFile($file);
        $path = $fileInfo['destinationPath'];
        $ext = $fileInfo['extension'];

        // Map file extensions to their respective content extraction methods
        $methodMap = [
            'pdf' => 'pdfToText',
            'doc' => 'docToText',
            'xlsx' => 'xlsxToText',
            'csv' => 'csvToText',
            'docx' => 'docxToText',
            'txt' => 'readText',
            'pptx' => 'extractTextFromPptx',
            'ppt' => 'extractTextFromPptx'
        ];

        // Extract content if the file extension is supported
        if (!isset($methodMap[$ext])) {
            throw new Exception(__('Unsupported file extension: :x', ['x' => $ext]));
        }

        // Call the corresponding method to extract text content
        $response = (new EmbeddedService())->{$methodMap[$ext]}($path);

        // Clean up the extracted text
        $response = trim(preg_replace('/[\t\n\s]+/', ' ', (string) $response));

        return [
            'content' => $response,
            'fileInfo' => $fileInfo,
        ];
    }

    /**
     * Parse the content and file information from a given URL.
     *
     * @param string $url The URL to parse.
     *
     * @return array An array containing the parsed content and file information.
     */
    public function parseUrl(string $url): array
    {
        $web = new PHPScraper();
        $web->go($url);

        $fileInfo = [
            'file_path_name' => $this->getDomainName($url),
            'originalName' => $url,
        ];

        return [
            'content' => $this->urlContent($web->paragraphs),
            'fileInfo' => $fileInfo,
        ];
    }

    /**
     * Domain name parser.
     *
     * @param string $url The URL to parse.
     *
     * @return string The extracted domain name.
     */
    public function getDomainName(string $url): string
    {
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'];

        // Remove 'www.' if it exists
        $host = preg_replace('/^www\./', '', (string) $host);

        return explode('.', $host)[0];
    }

    /**
     * Store file.
     *
     * @param mixed $file The file to be stored.
     *
     * @return array Information about the stored file.
     */
    public function storeFile(mixed $file): array
    {
        $this->uploadPath();
        $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
        $destinationFolder = public_path('uploads') . DIRECTORY_SEPARATOR . 'aiWidgetChatbotFiles' . DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR;
        $fileSize = $file->getSize();
        $file->move($destinationFolder, $fileName);

        $path = date('Ymd') . DIRECTORY_SEPARATOR . $fileName;

        return [
            'path' => $path,
            'destinationPath' => $destinationFolder . $fileName,
            'extension' => $file->getClientOriginalExtension(),
            'name' => $fileName,
            'file_path_name' => date('Ymd') . DIRECTORY_SEPARATOR . $fileName,
            'originalName' => $file->getClientOriginalName(),
            'fileSize' => $fileSize,
        ];
    }

    /**
     * Get the model instance with eager loading of metas, user, and childs relationships.
     *
     * @return Builder The model instance with eager loaded relationships.
     */
    public function model(): Builder
    {
        return EmbededResource::with(['metas', 'user', 'childs'])->whereCategory('campaign');
    }

    public function allMaterials($code)
    {
        return $this->model()->whereHas('metas', function($query) use($code) {
            $query->where(['key' => 'campaign_id', 'value' => $code]);
        })->where('user_id', auth()->user()->id);
    }

    /**
     * Retrieve content from URL.
     *
     * @param array $contents The contents retrieved from the URL.
     *
     * @return string The concatenated text content.
     */
    public function urlContent(array $contents): string
    {
        $text = '';
        foreach ($contents as $content) {
            $text .= trim($content) . ' ';
        }

        return $text;
    }

    /**
     * Create upload path.
     *
     * @return string The generated upload path.
     */
    protected function uploadPath()
    {
        return createDirectory(implode(DIRECTORY_SEPARATOR, ['public', 'uploads', 'aiFiles']));
    }

    /**
     * Fetches and validates unique URLs from a given URL using PHPScraper.
     *
     * @param array $requestData An associative array containing the URL to fetch. Example: ['url' => 'http://example.com']
     *
     * @return array An array of validated URLs, excluding URLs with fragments.
     */
    public function fetchUrls(array $requestData)
    {
        $url = $requestData['url'];

        $validUrls = [];

        $web = new PHPScraper();
        $web->go( $url);

        $uniqueUrls = $web->links;
        $uniqueUrls[] = $url;

        foreach (array_unique($uniqueUrls) as $url) {
            // Check if the URL is valid and ignore URLs with fragments
            if (filter_var($url, FILTER_VALIDATE_URL) !== false && strpos($url, '#') === false) {
                $validUrls[] = $url;
            }
        }

        return $validUrls;
    }

    /**
     * Train the chatbot resources based on the provided embeded IDs.
     *
     * @param array $requestData An array containing the embeded IDs to train.
     *
     * @return Builder[]|Collection The trained EmbededResource objects with eager loaded relationships.
     */
    public function train(array $requestData): Builder|Collection
    {

        $aiEmbeddingProvider = AiProviderManager::isActive(request('provider'), 'aiembedding');
        if (! $aiEmbeddingProvider) {
            throw new Exception(__(':x provider is not available for the :y. Please contact the administration for further assistance.', ['x' => request('provider'), 'y' => __('Ai Embedding')]));
        }

        $resources = $this->model()->whereIn('id', [$requestData['id']])->whereNull('parent_id')->get();
        $userId = (new ContentService())->getCurrentMemberUserId('meta', null);

        foreach ($resources as $resource) {

            if ($resource->type === 'url' && $resource->state === 'Trained') {

                $this->model()->where('parent_id', $resource->id)->delete();

                // Parse URL and update content if type is 'url'
                $content = $this->parseUrl($resource->original_name);
                $resource->content = $content['content'];
            }

            if ($resource->state === 'Untrained' || $resource->type === 'url') {
                // Normalize text, tokenize, and create embeddings
                $normalizedText = preg_replace("/\n+/", "\n", (string) $resource->content);
                $words = explode(' ', $normalizedText);
                $words = array_filter($words);
                $tokens = array_chunk($words, $this->chunkSize);

                $usages = 0;

                foreach ($tokens as $token) {
                    $text = implode(' ', $token);

                    $options['text'] = $text;
                    $options['model'] = request('embedding_model');

                    $vector = $aiEmbeddingProvider->createEmbeddings($options);
                    $usages += $vector->expense();

                    $embed = new EmbededResource();

                    $embed->user_id = $resource->user_id;
                    $embed->parent_id = $resource->id;
                    $embed->name = $resource->name;
                    $embed->original_name = $resource->original_name;
                    $embed->type =  $resource->type;
                    $embed->content = $text;
                    $embed->vector = json_encode($vector->content());
                    $embed->category = 'campaign';

                    $embed->save();

                }

                // Update resource state and last_trained timestamp
                $resource->state = 'Trained';
                $resource->last_trained = now();
                $resource->usages += $usages;

                $resource->embedding_provider = request('provider');
                $resource->embedding_model = request('model');

                handleSubscriptionAndCredit(subscription('getUserSubscription', $userId), 'word', subscription('tokenToWord', $usages), $userId);
            }

            // Save the updated resource
            $resource->save();
        }

        return $resources;
    }

    public function deleteMaterial(array $requestData): void
    {
        DB::beginTransaction();
        try {

            $materials = $this->model()->whereIn('id', [$requestData['id']])->where('user_id', auth()->user()->id)->get();

            // Check if materials are found
            if ($materials->isEmpty()) {
                throw new Exception(__('No :x found.', ['x' => count($requestData['id']) == 1 ? __('Material') : __('Materials')]), Response::HTTP_NOT_FOUND);
            }

            $foundMaterialIds = $materials->pluck('id')->toArray();

            // Identify IDs that are missing
            $missingMaterialIds = array_diff([$requestData['id']], $foundMaterialIds);

            // Check if there are missing materials
            if (!empty($missingMaterialIds)) {
                throw new Exception(__('The selected :x does not belong to the current user. Please kindly check your selection.', ['x' => count($missingMaterialIds) == 1 ? __('Material') : __('Materials')] ), Response::HTTP_NOT_FOUND);
            }

            $this->deleteMeta($materials);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete meta data for each item in the provided array of items.
     *
     * @param array|object $items An array of items for which to delete meta data.
     *
     * @return void
     */
    private function deleteMeta(array|object $items): void
    {
        // Iterate through each chatBot to unset meta data and save
        foreach ($items as $item) {

            if ($item->childs && !$item->childs->isEmpty()) {
                $this->deleteMeta($item->childs);
            }

            $item->save();
            $item->delete();
            $item->unsetMeta(array_keys($item->getMeta()->toArray()));
        }
    }
}