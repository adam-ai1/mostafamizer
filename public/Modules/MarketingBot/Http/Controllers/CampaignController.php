<?php

namespace Modules\MarketingBot\Http\Controllers;


use Illuminate\Support\Facades\Log;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\MarketingBot\Entities\Segment;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Services\ChannelService;
use Modules\MarketingBot\Services\CampaignService;
use Modules\MarketingBot\Http\Requests\CampaignStoreRequest;
use Modules\MarketingBot\Http\Requests\CampaignUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;
use Modules\MarketingBot\Exports\CampaignExport;
use Modules\MarketingBot\Entities\MarketingCampaign;

class CampaignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param CampaignService $campaignService The campaign service instance.
     */
    public function __construct(
        protected CampaignService $campaignService
    ) {}

    /**
     * Display campaigns with pagination and statistics.
     *
     * Retrieves all campaigns with filtering, pagination, and campaign statistics
     * including active, scheduled, published campaigns and success rate.
     * Handles both AJAX requests for table data and regular page requests.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function campaigns(Request $request)
    {
        $campaignsQuery = $this->campaignService->getAllCampaign()
            ->filter('Modules\MarketingBot\Filters\CampaignFilter');

        $data['campaigns'] = $campaignsQuery->paginate(preference('row_per_page'));
        $data['active'] = $this->campaignService->activeCampaigns();
        $data['scheduled'] = $this->campaignService->scheduledCampaigns();
        $data['published'] = $this->campaignService->publishedCampaigns();
        $data['successRate'] = $this->campaignService->successRate();

        // Calculate WoW growth metrics for Success Rate only
        $data['wowSuccess'] = $this->campaignService->calculateWowGrowth('success_rate');

        $service = new ChannelService();
        $data['chatProviders'] = $service->providers('aichat');
        $data['embeddingProviders'] = $service->providers('aiembedding');

        // Get channel preferences from service
        $channelPreferences = $this->campaignService->getChannelPreferences();
        $data['whatsappEnabled'] = $channelPreferences['whatsapp_enabled'];
        $data['telegramEnabled'] = $channelPreferences['telegram_enabled'];

        if ($request->ajax()) {
            $data['is_ajax'] = true;
            return response()->json([
                'items' => view('marketingbot::campaigns-table', $data)->render(),
            ]);
        }
        return view('marketingbot::campaigns', $data);
    }

    /**
     * Display the form for creating a new Telegram campaign.
     *
     * Retrieves Telegram groups, subscribers, chat providers, and embedding providers
     * required for campaign creation.
     *
     * @return \Illuminate\View\View
     */
    public function createTelegramCampaign()
    {
        $service = new ChannelService();
        $data['groups'] = Segment::with('metas')->where('user_id', auth()->user()->id)
                ->whereHas('metas', function($query) {
                    $query->where('key', 'channel')->where('value', 'telegram');
                })->filter('Modules\\MarketingBot\\Filters\\SegmentFilter')->paginate(preference('row_per_page'));
        $data['subscribers'] = Contact::with('metas')->where('user_id', auth()->user()->id)->where('channel', 'telegram')->filter('Modules\\MarketingBot\\Filters\\ContactFilter')->paginate(preference('row_per_page'));
        
        $data['chatProviders'] = $service->providers('aichat');
        $data['embeddingProviders'] = $service->providers('aiembedding');

        return view('marketingbot::campaigns.telegram', $data);
    }

    /**
     * Get campaign data for editing.
     *
     * Retrieves a specific campaign by ID and returns formatted data
     * for the edit form including basic campaign information.
     *
     * @param int|string $id The campaign ID.
     * @return \Illuminate\Http\JsonResponse
     */
    public function campaignEdit($id)
    {
        try {
            $campaign = MarketingCampaign::where('user_id', auth()->id())->find($id);
            if (! $campaign) {
                return response()->json(['error' => 'Campaign not found'], 404);
            }

            // Simple data without date formatting
            $campaignData = [
                'id' => $campaign->id,
                'title' => $campaign->title ?? '',
                'status' => $campaign->status ?? '',
                'ends_at' => $campaign->ends_at ? \Carbon\Carbon::parse($campaign->ends_at)->format('Y-m-d') : '',
                'ai_reply' => $campaign->ai_reply,
                'schedule' => $campaign->schedule ?? 'off',
                'schedule_at' => $campaign->schedule_at ?? null,
            ];

            return response()->json($campaignData);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * Update an existing campaign.
     *
     * Validates the request data and updates the specified campaign
     * with the provided information.
     *
     * @param CampaignUpdateRequest $request The validated request data.
     * @param int|string $id The campaign ID.
     * @return \Illuminate\Http\JsonResponse
     */
    public function campaignUpdate(CampaignUpdateRequest $request, $id)
    {
        try {
            $this->campaignService->update($request->validated(), $id);

            return response()->json([
                'success' => true,
                'message' => __('Campaign updated successfully'),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Export campaigns to CSV file.
     *
     * Downloads a CSV file containing all campaigns data
     * with a timestamp-based filename.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportCampaigns()
    {
        return Excel::download(new CampaignExport, 'campaigns_'.time().'.csv');
    }

    /**
     * Display the form for creating a new WhatsApp campaign.
     *
     * Retrieves templates, chat providers, and embedding providers
     * required for campaign creation. Handles AJAX requests for template
     * pagination and search when 'only=templates' parameter is present.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function createWhatsappCampaign(Request $request)
    {
        $service = new ChannelService();

        $data['contacts'] = Segment::with('metas')->where('user_id', auth()->user()->id)
            ->whereHas('metas', function($query) {
                $query->where('key', 'channel')->where('value', 'whatsapp');
            })->filter('Modules\\MarketingBot\\Filters\\SegmentFilter')->paginate(preference('row_per_page'));
        $data['segments'] = Contact::with('metas')->where('user_id', auth()->user()->id)->where('channel', 'whatsapp')->paginate(preference('row_per_page'));

        $data['chatProviders'] = $service->providers('aichat');
        $data['embeddingProviders'] = $service->providers('aiembedding');

        $data['templates'] = $service->getTemplates('whatsapp')->where('user_id', auth()->user()->id)
            ->where('status', 'approved')
            ->filter('Modules\\MarketingBot\\Filters\\TemplateFilter')
            ->paginate(preference('row_per_page'));
        $data['variables'] = [];

        // Handle AJAX request for templates only
        if ($request->get('only') === 'templates') {
            return response()->json([
                'items' => view('marketingbot::campaigns.partials.template-items', ['templates' => $data['templates']])->render(),
                'next' => $data['templates']->nextPageUrl(),
            ]);
        }

        return view('marketingbot::campaigns.whatsapp', $data);
    }

    /**
     * Get template data with variables and preview.
     *
     * Retrieves a specific template by ID and returns rendered forms
     * for variables input and message preview.
     *
     * @param int|string $id The template ID.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTemplate($id)
    {
        $template = (new ChannelService())->getTemplateById($id);
        $variables = json_decode($template->components, true);

        $variableForm = view('marketingbot::campaigns.variables', ['variables' => $variables])->render();
        $previewForm = view('marketingbot::campaigns.preview', ['variable' => $variables])->render();

        return response()->json([
            'variableForm' => $variableForm, 
            'previewForm' => $previewForm,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws Exception
     */
    public function whatsappCampaignStore(CampaignStoreRequest $request): JsonResponse
    {
        try {
            $data = $request->except('_token');

            // Process segments and contacts from comma-separated strings to arrays
            if (isset($data['segments']) && $data['segments']) {
                $data['segments'] = array_filter(explode(',', $data['segments']));
            }

            if (isset($data['contacts']) && $data['contacts']) {
                $data['contacts'] = array_filter(explode(',', $data['contacts']));
            }

            // Add uploaded files to the data array
            $uploadedFiles = $request->file();
            if (!empty($uploadedFiles)) {
                foreach ($uploadedFiles as $fieldName => $files) {
                    if (is_array($files)) {
                        // Handle array-style uploads like header[0], header[1]
                        $data[$fieldName] = $files;
                    } else {
                        // Handle single file uploads
                        $data[$fieldName] = $files;
                    }
                }
            }

            // Process uploaded files and replace with URLs
            $data = $this->campaignService->processFileUploads($data, []);

            $this->campaignService->store($data);

            return response()->json(['message' => __('Campaign created successfully')], Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()],
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Store a newly created telegram campaign resource in storage.
     *
     * @param  CampaignStoreRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws Exception
     */
    public function telegramCampaignStore(CampaignStoreRequest $request): JsonResponse
    {
        try {
            $data = $request->except('_token');

            // Process groups and subscribers from comma-separated strings to arrays
            if (isset($data['groups']) && $data['groups']) {
                $data['groups'] = array_filter(explode(',', $data['groups']));
            }

            if (isset($data['subscribers']) && $data['subscribers']) {
                $data['subscribers'] = array_filter(explode(',', $data['subscribers']));
            }

            $this->campaignService->store($data);

            return response()->json(['message' => __('Campaign created successfully')], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Delete a campaign
     *
     * @param int|string $id Campaign ID.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTelegramCampaign($id): JsonResponse
    {
        try {
            $this->campaignService->deleteCampaign($id);
            return response()->json(['message' => __('Campaign deleted successfully')], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Handles incoming WhatsApp webhook requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function whatsappWebhook(Request $request): Response|JsonResponse
    {
        try {
            switch (true) {
                case $request->isMethod('get'):
                    $data = $this->campaignService->whatsappWebhookVerification($request->all());
                    return response($data, 200)->header('Content-Type', 'text/plain');

                case $request->isMethod('post'):
                    // In your controller (keep as is)
                    $payload = json_decode($request->getContent(), true);
                    $this->campaignService->whatsappWebhook(json_encode($payload));
                    return response('EVENT_RECEIVED', Response::HTTP_OK);

                default:
                    return response()->json([
                        'error' => __('Invalid request method'),
                    ], Response::HTTP_METHOD_NOT_ALLOWED);
            }
        } catch (Throwable $e) {
            Log::error('WhatsApp Webhook Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Handles incoming Telegram webhook requests.
     *
     * @param  \Illuminate\Http\Request  $request The request containing Telegram webhook data.
     * @param int|string $id The campaign ID.
     *
     * @return void
     *
     * @throws Throwable
     */
    public function telegramWebhook(Request $request, $id)
    {
        try {
            $id = techDecrypt($id);
            $this->campaignService->telegramWebhook($request->all(), $id);
        } catch (Throwable $e) {
            Log::error('Telegram Webhook Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

        }
    }
}
