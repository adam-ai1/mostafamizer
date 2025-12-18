<?php

namespace Modules\SeoAnalyzer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SeoAnalyzer\Services\SeoAnalyzerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class SeoAnalyzerController extends Controller
{
    protected $seoService;

    public function __construct(SeoAnalyzerService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Display the SEO Analyzer page
     */
    public function index()
    {
        $userId = Auth::id();
        $subscription = subscription('getUserSubscription', $userId);
        $featureLimit = subscription('getActiveFeature', $subscription?->id ?? null);
        
        // Get SEO analysis limits
        $seoLimit = 0;
        $seoUsed = 0;
        $seoRemaining = 0;
        
        if ($subscription && in_array($subscription->status, ['Active', 'Cancel'])) {
            $seoLimit = $featureLimit['seo-analysis']['limit'] ?? 10;
            $seoUsed = $featureLimit['seo-analysis']['used'] ?? 0;
            $seoRemaining = $featureLimit['seo-analysis']['remain'] ?? $seoLimit;
        }
        
        return view('seoanalyzer::index', [
            'subscription' => $subscription,
            'featureLimit' => $featureLimit,
            'seoLimit' => $seoLimit,
            'seoUsed' => $seoUsed,
            'seoRemaining' => $seoRemaining,
        ]);
    }

    /**
     * Analyze URL for SEO
     */
    public function analyze(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'analysis_type' => 'required|in:full,keywords,meta,content,technical',
        ]);

        $userId = Auth::id();

        // Block if subscription/credit is not valid for SEO analysis
        $validation = subscription('isValidSubscription', $userId, 'seo-analysis');
        if ($validation['status'] !== 'success') {
            return response()->json([
                'success' => false,
                'message' => $validation['message'] ?? __('Your SEO analysis quota has been exhausted or expired.')
            ], 403);
        }

        try {
            $result = $this->seoService->analyze(
                $request->url,
                $request->analysis_type
            );

            // Increment SEO analysis usage
            $subscription = subscription('getUserSubscription', $userId);
            $incremented = subscription('usageIncrement', $subscription?->id, 'seo-analysis', 1, $userId);

            if ($incremented === false) {
                return response()->json([
                    'success' => false,
                    'message' => __('You have exceeded your SEO analysis limit. Please upgrade your plan.')
                ], 403);
            }
            
            // Get updated limits
            $featureLimit = subscription('getActiveFeature', $subscription?->id ?? null);
            $seoRemaining = $featureLimit['seo-analysis']['remain'] ?? 0;

            return response()->json([
                'success' => true,
                'data' => $result,
                'seo_remaining' => $seoRemaining,
            ]);
        } catch (Exception $e) {
            Log::error('SEO Analysis Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => __('An error occurred during SEO analysis. Please try again.')
            ], 500);
        }
    }
}
