<?php

namespace Modules\MarketingBot\Http\Controllers;

use ChannelManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\MarketingBot\Filters\TemplateFilter;
use Modules\MarketingBot\Services\ChannelService;
use Modules\MarketingBot\Services\CampaignService;
use Modules\MarketingBot\Transformers\TemplateResources;

class TemplateController extends Controller
{
    public function __construct(
        protected CampaignService $campaignService,
        protected ChannelService $channelService
    ) {}

    public function index(Request $request)
    {
        $data['templates'] = $this->channelService->getTemplates()->filter(TemplateFilter::class)->paginate(preference('row_per_page'));

        if ($request->ajax()) {
            $data['is_ajax'] = true;
            return response()->json([
                'items' =>  view('marketingbot::template.template-table', $data)->render(),
            ]);
        }
        
        return view('marketingbot::template.index', $data);
    }

    public function sync(Request $request)
    {
        $data = $this->channelService->syncTemplates()->orderBy('id', 'desc')->paginate(preference('row_per_page'));

        // Return the full table structure with pagination
        $tableData = view('marketingbot::template.template-table', ['templates' => $data])->render();

        return response()->json(['data' => $tableData], Response::HTTP_OK);
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->channelService->deleteTemplate($id);
            return response()->json(['message' => __('Template deleted successfully')], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
