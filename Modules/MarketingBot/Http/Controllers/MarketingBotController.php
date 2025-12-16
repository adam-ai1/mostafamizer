<?php

namespace Modules\MarketingBot\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MarketingBot\Exports\ContactExport;
use App\Imports\ContactsImport;
use Illuminate\Http\JsonResponse;
use Modules\MarketingBot\Exports\SegmentListExport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;
use Modules\MarketingBot\Http\Requests\ContactImportRequest;
use Modules\OpenAI\Entities\Archive;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;
use Illuminate\Contracts\Support\Renderable;
use Modules\MarketingBot\Exports\GroupExport;
use Modules\MarketingBot\Exports\SubscriberExport;
use Modules\MarketingBot\Services\ChannelService;
use Modules\MarketingBot\Services\CampaignService;
use Modules\MarketingBot\Transformers\UserResource;
use Modules\MarketingBot\Services\ContactsService;
use Modules\MarketingBot\Services\SegmentService;
use Modules\MarketingBot\Services\DashboardService;
use Modules\MarketingBot\Http\Requests\FetchUrlRequest;
use Modules\MarketingBot\Http\Requests\SegmentStoreRequest;
use Modules\MarketingBot\Http\Requests\SegmentUpdateRequest;
use Modules\MarketingBot\Http\Requests\ContactStoreRequest;
use Modules\MarketingBot\Transformers\CampaignTrainingResource;
use Modules\MarketingBot\Http\Requests\ConfigurationSettingsRequest;

class MarketingBotController extends Controller
{

    /**
     * Constructor method.
     *
     * Instantiates the class and sets up the campaign service.
     *
     * @param CampaignService $campaignService
     */
    public function __construct(
        protected CampaignService $campaignService,
        protected ContactsService $contactsService,
        protected SegmentService $segmentService
    ) {}

    /**
     * Display the marketing bot dashboard template.
     *
     * This method renders the main dashboard view for the marketing bot module,
     * providing comprehensive analytics and performance data including:
     * - Overall dashboard metrics and statistics
     * - Campaign performance analytics
     * - Visual charts and graphs for data visualization
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\View\View
     *
     * @throws Exception When dashboard data cannot be retrieved
     */
    public function template()
    {
        try {
            $service = new DashboardService();

            // Fetch dashboard data and campaign performance metrics
            $data = $service->dashboardData();
            $data['active'] = $this->campaignService->activeCampaigns();
            $campaignPerformance = $service->campaignPerformance();

            return view('marketingbot::dashboard', compact('data', 'campaignPerformance'));
        } catch (Exception $e) {
            // Log the error for debugging purposes
            Log::error('Marketing Bot Dashboard Error: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return dashboard with empty data to prevent complete failure
            return view('marketingbot::dashboard', [
                'data' => [],
                'campaignPerformance' => []
            ])->with('error', __('Unable to load dashboard data. Please try again later.'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function inbox()
    {
        $data = $this->campaignService->getInboxData();

        $data['messages'] = [];
        $data['contact'] = [];
        $data['chatDetails'] = [];

        if (request()->ajax()) {
            $inboxes = $data['inboxes'];
            return response()->json([
                'html' => view('marketingbot::inbox.conversation-lists', $data)->render(),
                'hasMorePages' => $inboxes->hasMorePages(),
                'nextPage' => $inboxes->hasMorePages() ? $inboxes->currentPage() + 1 : null,
            ]);
        }

        return view('marketingbot::inbox.index', $data);
    }

    /**
     * Send a reply message via the marketing bot's API.
     *
     * @param Request $request The request containing the reply message payload.
     * @param int $id The ID of the conversation to reply to.
     *
     * @return JsonResponse The JSON response containing a success message or error message.
     *
     * @throws \Throwable If an error occurs during message sending.
     */
    public function sendMessage(Request $request, $id)
    {
        try {
            $service = new ChannelService();
            $response = $service->replyMessage($request->except('_token'));
            $this->campaignService->sendReplyMessage($request->except('_token'), $response);

            return response()->json(['message' => __('Message sent successfully')], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json(['error' =>  $e->getMessage()], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Retrieve all messages for the given conversation ID.
     *
     * @param int $id The conversation ID to retrieve messages for.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the messages.
     */
    public function getAllMessages($id)
    {

        $userId = auth()->id();
        $data['chatDetails'] = Archive::with('metas')->where('id', $id)->where(['type' => 'marketing_bot', 'user_id' => $userId])->first();
        $data['chatDetails']->has_unread_message = true;
        $data['chatDetails']->has_unread_message_count = 0;
        $data['chatDetails']->save();
        $data['contact'] = Contact::with('metas')->where('user_id',$userId)->where('id',  $data['chatDetails']->contact_id)->first();
        if(empty($data['contact'])) {
            $data['contact'] = Segment::with('metas')->where('user_id', $userId)->where('id',  $data['chatDetails']->segment_id)->first();
        }

        // Provide fallback contact data if no contact or segment is found
        if(empty($data['contact'])) {
            $data['contact'] = (object) [
                'name' => __('Unknown Contact'),
                'phone' => null,
                'email' => null,
                'channel' => $data['chatDetails']->channel ?? 'unknown',
                'country_code' => null,
            ];
        }

        $data['messages'] = Archive::with('metas')->where(['parent_id' => $id])->orderBy('id', 'desc')->paginate(preference('row_per_page'));
        $data['messages']->setCollection($data['messages']->getCollection()->reverse());
        $messages = view('marketingbot::inbox.messages', $data)->render();
        $details = view('marketingbot::inbox.header', $data)->render();

        return response()->json([
            'messages' => $messages,
            'header' => $details,
            'currentPage' => $data['messages']->currentPage(),
            'hasMorePages' => $data['messages']->hasMorePages(),
            'hasPreviousPage' => $data['messages']->currentPage() > 1
        ]);
    }

    /**
     * Display the settings page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function settings()
    {
        $data['settings'] = $this->campaignService->getSettings();
        $user = User::where('id', auth()->user()->id)->first();
        $data['user'] = $user;
        
        // Get connection status from whatsapp/telegram meta JSON
        $whatsappMeta = json_decode($user->getMeta('whatsapp') ?? '{}', true);
        $telegramMeta = json_decode($user->getMeta('telegram') ?? '{}', true);
        
        $data['whatsapp_connected'] = isset($whatsappMeta['webhook_connected']) && $whatsappMeta['webhook_connected'] === true;
        $data['telegram_connected'] = isset($telegramMeta['webhook_connected']) && $telegramMeta['webhook_connected'] === true;

        return view('marketingbot::settings', $data);
    }

    /**
     * Store the settings for the marketing bot.
     *
     * @param ConfigurationSettingsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function storeSettings(ConfigurationSettingsRequest $request)
    {
        try {
            $type = $request->get('type') ?? 'whatsapp';
            
            // Store settings (this will check connection and add webhook_connected to data)
            $data = $this->campaignService->storeSettings($type, $request->except(['_token', 'type']));
            
            // Get webhook_connected status and connection message from the stored meta
            $meta = json_decode($data->getMeta($type), true);
            $isConnected = isset($meta['webhook_connected']) && $meta['webhook_connected'] === true;
            $connectionMessage = $meta['connection_message'] ?? '';
            
            return response()->json([
                'data' => new UserResource($data),
                'connected' => $isConnected,
                'connection_message' => $connectionMessage
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function telegramCampaignStore(Request $request): JsonResponse
    {
        try {
            $this->campaignService->store($request->except('_token'));

            return response()->json(['message' => __('Campaign created successfully')], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Delete a campaign
     *
     * @param  int|string  $id  Campaign ID.
     */
    public function deleteTelegramCampaign($id): JsonResponse
    {
        try {
            $this->campaignService->deleteCampaign($id);

            return response()->json(['message' => __('Campaign deleted successfully')], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function contacts(Request $request)
    {
        $data['segments'] = Segment::with('metas')->where(['user_id' => Auth::id(), 'status' => 'active'])
            ->whereHas('metas', function($query) {
                $query->where('key', 'channel')->where('value', 'whatsapp');
            })->paginate(preference('row_per_page'));

        $data['contacts'] = $this->contactsService->getAllContacts()->filter('Modules\\MarketingBot\\Filters\\ContactFilter')->paginate(preference('row_per_page'));

        if ($request->ajax()) {
            return response()->json([
                'items' => view('marketingbot::contacts', $data)->render(),
            ]);
        }

        return view('marketingbot::contacts', $data);
    }

    /**
     * Store a new contact for the authenticated user.
     *
     * Creates a new contact with the provided information. The request is validated
     * to ensure the phone number is unique for the user.
     *
     * @param ContactStoreRequest $request The validated request containing contact data
     * @return JsonResponse JSON response with success status and contact data or error message
     */
    public function storeContact(ContactStoreRequest $request): JsonResponse
    {
        try {
            $contact = $this->contactsService->contactStore($request);

            return response()->json([
                'success' => true,
                'contact' => $contact,
                'message' => __('Contact created successfully'),
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], $e->getCode() && is_int($e->getCode()) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update an existing contact for the authenticated user.
     *
     * Updates the contact with the provided information. The request is validated
     * to ensure the phone number is unique for the user (excluding current contact).
     *
     * @param ContactStoreRequest $request The validated request containing contact data
     * @param int|string $id The ID of the contact to update
     * @return JsonResponse JSON response with success status and contact data or error message
     */
    public function updateContact(ContactStoreRequest $request, $id): JsonResponse
    {
        try {
            $contact = $this->contactsService->contactUpdate($request, $id);

            return response()->json([
                'success' => true,
                'contact' => $contact,
                'message' => __('Contact updated successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], $e->getCode() && is_int($e->getCode()) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a contact for the authenticated user.
     *
     * Deletes the contact if it belongs to the authenticated user.
     *
     * @param int|string $id The ID of the contact to delete
     * @return JsonResponse JSON response with success status or error message
     */
    public function deleteContact($id): JsonResponse
    {
        try {
            $this->contactsService->deleteContact($id);

            return response()->json([
                'success' => true,
                'message' => __('Contact deleted successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], $e->getCode() && is_int($e->getCode()) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show a single contact for the authenticated user.
     *
     * Retrieves a contact by ID if it belongs to the authenticated user.
     *
     * @param int|string $id The ID of the contact to retrieve
     * @return JsonResponse JSON response with contact data or error message
     */
    public function showContact($id): JsonResponse
    {
        try {
            $contact = $this->contactsService->showContact($id);

            // Ensure segment_ids is included in the response
            $contactData = $contact->toArray();
            $contactData['segment_ids'] = $contact->segment_ids ?? null;

            return response()->json([
                'success' => true,
                'contact' => $contactData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('Failed to fetch contact'),
            ], $e->getCode() && is_int($e->getCode()) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function exportContact()
    {
        return Excel::download(new ContactExport, 'contacts_' . time() . '.csv');
    }

    public function importContact(ContactImportRequest $request)
    {
        try {
            Excel::import(new ContactsImport(Auth::id()), $request->file('file'));

            return back()->with('success', __('Contacts imported successfully!'));
        } catch (\Exception $e) {
            return back()->with('error', __('Import failed: :x', ['x' => $e->getMessage()]));
        }
    }

    

    public function segments(Request $request)
    {
        $segmentQuery = $this->segmentService->allSegments()->filter('Modules\\MarketingBot\\Filters\\SegmentFilter');

        $data['segments'] = $segmentQuery->paginate(preference('row_per_page'));

        if ($request->ajax()) {
            return response()->json([
                'items' => view('marketingbot::segments-table', $data)->render(),
            ]);
        }

        return view('marketingbot::segments', $data);
    }


    /**
     * Store a new segment for the authenticated user.
     *
     * Creates a new segment with the provided name. The request is validated
     * to ensure the segment name is unique for the user.
     *
     * @param SegmentStoreRequest $request The validated request containing segment data
     * @return JsonResponse JSON response with success status and segment data or error message
     */
    public function storeSegment(SegmentStoreRequest $request): JsonResponse
    {
        try {
            $segment = $this->segmentService->saveSegment($request);

            return response()->json([
                'success' => true,
                'segment' => $segment,
                'message' => __('Segment created successfully'),
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], $e->getCode() && is_int($e->getCode()) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update an existing segment for the authenticated user.
     *
     * Updates the segment name if it belongs to the authenticated user.
     * The request is validated to ensure the segment name is unique for the user.
     *
     * @param SegmentUpdateRequest $request The validated request containing segment data
     * @param int|string $id The ID of the segment to update
     * @return JsonResponse JSON response with success status and segment data or error message
     */
    public function updateSegment(SegmentUpdateRequest $request, $id): JsonResponse
    {
        try {
            $segment = $this->segmentService->updateSegment($request, $id);

            return response()->json([
                'success' => true,
                'segment' => $segment,
                'message' => __('Segment updated successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], $e->getCode() && is_int($e->getCode()) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a segment for the authenticated user.
     *
     * @param int|string $id The ID of the segment to delete
     * @return JsonResponse JSON response with success status or error message
     */
    public function deleteSegment($id): JsonResponse
    {
        try {
            $this->segmentService->deleteSegment($id);

            return response()->json([
                'success' => true,
                'message' => __('Segment deleted successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], $e->getCode() && is_int($e->getCode()) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get segments for dropdown with pagination and search
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getSegmentsForDropdown(Request $request): JsonResponse
    {
        try {
            // Get base query and apply filter class for search
            $segmentQuery = $this->segmentService->allSegments()->filter('Modules\\MarketingBot\\Filters\\SegmentFilter');
            
            $segments = $segmentQuery->orderBy('id', 'desc')->paginate(preference('row_per_page'));

            return response()->json([
                'success' => true,
                'segments' => $segments->items(),
                'current_page' => $segments->currentPage(),
                'last_page' => $segments->lastPage(),
                'has_more_pages' => $segments->hasMorePages(),
                'total' => $segments->total(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getSegmentsForDropdown: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get contacts for dropdown with pagination and search
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getContactsForDropdown(Request $request): JsonResponse
    {
        try {
            // Get base query and apply filter class for search
            $contactQuery = $this->contactsService->model()->filter('Modules\\MarketingBot\\Filters\\ContactFilter');

            $contacts = $contactQuery->orderBy('id', 'desc')->paginate(preference('row_per_page'));

            return response()->json([
                'success' => true,
                'contacts' => $contacts->items(),
                'current_page' => $contacts->currentPage(),
                'last_page' => $contacts->lastPage(),
                'has_more_pages' => $contacts->hasMorePages(),
                'total' => $contacts->total(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getContactsForDropdown: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function subscribers(Request $request)
    {
        $data['subscribers'] = Contact::with('metas')->where('user_id', auth()->user()->id)->where('channel', 'telegram')
            ->filter('Modules\\MarketingBot\\Filters\\ContactFilter')->paginate(preference('row_per_page'));

        if ($request->ajax()) {
            $data['is_ajax'] = true;
            return response()->json([
                'items' =>  view('marketingbot::telegram.subscriber-table', $data)->render(),
            ]);
        }
        return view('marketingbot::telegram.subscribers', $data);
    }

    public function groups(Request $request)
    {
        $data['groups'] = Segment::with('metas')->where('user_id', auth()->user()->id)
            ->whereHas('metas', function ($query) {
                $query->where('key', 'channel')->where('value', 'telegram');
            })->filter('Modules\\MarketingBot\\Filters\\SegmentFilter')->paginate(preference('row_per_page'));

        if ($request->ajax()) {
            $data['is_ajax'] = true;
            return response()->json([
                'items' =>  view('marketingbot::telegram.group-table', $data)->render(),
            ]);
        }
        return view('marketingbot::telegram.groups', $data);
    }

    /**
     * Deletes a subscriber from the authenticated user's list of subscribers.
     *
     * @param Request $request The request containing the subscriber ID to be deleted.
     *
     * @return JsonResponse The JSON response containing a success message or error message.
     *
     * @throws Exception If an error occurs during deletion.
     */
    public function deleteSubscriber(Request $request): JsonResponse
    {
        try {
            $this->campaignService->deleteSubscriber(($request->except('_token')));
            return response()->json(['message' => __('Subscriber deleted successfully')], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Deletes a group from the authenticated user's list of groups.
     *
     * @param Request $request The request containing the group ID to be deleted.
     *
     * @return JsonResponse The JSON response containing a success message or error message.
     *
     * @throws Exception If an error occurs during deletion.
     */
    public function deleteGroup(Request $request): JsonResponse
    {
        try {
            $this->campaignService->deleteGroup(($request->except('_token')));
            return response()->json(['message' => __('Group deleted successfully')], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function subscriberExport()
    {
        return Excel::download(new SubscriberExport, 'subscriber_' . time() . '.csv');
    }

    public function groupExport()
    {
        return Excel::download(new GroupExport, 'group_' . time() . '.csv');
    }

    public function updateAutoReply(Request $request, $id)
    {
        try {
            $this->campaignService->updateAutoReply($id, $request->except('_token'));
            return response()->json(['message' => __('Auto reply updated successfully')], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a chat conversation and all related messages.
     *
     * @param int $id The conversation ID to delete.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing success message or error message.
     *
     * @throws \Throwable If an error occurs during deletion.
     */
    public function deleteChat($id)
    {
        try {
            $this->campaignService->deleteChat($id);
            return response()->json(['message' => __('Chat deleted successfully')], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get campaign performance data for the specified number of days
     *
     * @param  int  $days  Number of days to get data for
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCampaignPerformance($days)
    {
        try {
            $service = new DashboardService;
            $performanceData = $service->campaignPerformance($days);

            return response()->json($performanceData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get conversion data for the current month
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversions()
    {
        try {
            $service = new DashboardService;
            $conversionData = $service->campaignsByChannel();

            return response()->json($conversionData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get channel distribution data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChannelDistribution()
    {
        try {
            $service = new DashboardService;
            $distributionData = $service->channelDistribution();

            return response()->json($distributionData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get contact growth data for the last 12 months
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getContactGrowth()
    {
        try {
            $service = new DashboardService;
            $growthData = $service->contactGrowth();

            return response()->json($growthData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function segmentExport()
    {
        return Excel::download(new SegmentListExport, 'segment_list_' . time() . '.csv');
    }

    /**
     * Run the queue worker to process all pending jobs in the queue for Marketing Bot.
     * This will stop when the queue is empty.
     */
    public function queueWorker()
    {
        Artisan::call('queue:work --queue=campaigns --stop-when-empty');
    }
}
