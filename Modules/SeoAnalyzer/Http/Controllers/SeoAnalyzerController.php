<?php

namespace Modules\SeoAnalyzer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SeoAnalyzer\Services\SeoAnalyzerService;
use Illuminate\Support\Facades\Log;
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
        return view('seoanalyzer::index');
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

        try {
            $result = $this->seoService->analyze(
                $request->url,
                $request->analysis_type
            );

            return response()->json([
                'success' => true,
                'data' => $result
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
