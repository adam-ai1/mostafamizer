<?php

namespace Modules\Presentation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Presentation\Services\PresentationService;
use Modules\Presentation\Models\Presentation;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class PresentationController extends Controller
{
    protected $presentationService;

    public function __construct(PresentationService $presentationService)
    {
        $this->presentationService = $presentationService;
    }

    /**
     * Display list of presentations
     */
    public function index()
    {
        $presentations = Presentation::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('presentation::index', compact('presentations'));
    }

    /**
     * Show create presentation form
     */
    public function create()
    {
        return view('presentation::create');
    }

    /**
     * Generate presentation
     */
    public function generate(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:500',
            'slides_count' => 'required|integer|min:3|max:20',
            'style' => 'required|in:professional,creative,minimal,corporate,educational',
        ]);

        try {
            $result = $this->presentationService->generate(
                $request->topic,
                $request->slides_count,
                $request->style,
                $request->language
            );

            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (Exception $e) {
            Log::error('Presentation Generation Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => __('An error occurred while generating the presentation. Please try again.')
            ], 500);
        }
    }

    /**
     * Show presentation
     */
    public function show($id)
    {
        $presentation = Presentation::where('user_id', auth()->id())
            ->findOrFail($id);
            
        return view('presentation::show', compact('presentation'));
    }

    /**
     * Download presentation
     */
    public function download($id)
    {
        $presentation = Presentation::where('user_id', auth()->id())
            ->findOrFail($id);

        $format = request('format', 'pdf');

        if ($format === 'json') {
            $filename = 'presentation_' . $id . '.json';
            return response()->json($presentation->slides)
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        }

        // Default: PDF export
        $pdf = Pdf::loadView('presentation::pdf', [
            'presentation' => $presentation,
            'slides' => $presentation->slides ?? [],
        ])->setPaper('a4', 'portrait');

        return $pdf->download('presentation_' . $id . '.pdf');
    }
}
