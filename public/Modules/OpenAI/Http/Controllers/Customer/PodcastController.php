<?php

/**
 * @package PodcastController
 * @author VoxCraft
 * @created 2024-12-14
 */

namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\OpenAI\Services\PodcastService;
use Modules\OpenAI\Entities\Podcast;

class PodcastController extends Controller
{
    /**
     * Podcast Service
     *
     * @var PodcastService
     */
    protected PodcastService $podcastService;

    /**
     * Constructor
     *
     * @param PodcastService $podcastService
     */
    public function __construct(PodcastService $podcastService)
    {
        $this->podcastService = $podcastService;
    }

    /**
     * Display the podcast generation page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        
        $data = [
            'podcasts' => $this->podcastService->getUserPodcasts($userId, preference('row_per_page', 10)),
            'availability' => $this->podcastService->checkAvailability($userId),
        ];

        return view('openai::blades.podcast.index', $data);
    }

    /**
     * Display the podcast creation page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $userId = Auth::id();
        $availability = $this->podcastService->checkAvailability($userId);

        if (!$availability['available']) {
            return redirect()->route('user.podcast.index')
                ->with('error', $availability['error']);
        }

        return view('openai::blades.podcast.create', [
            'availability' => $availability,
        ]);
    }

    /**
     * Store a new podcast generation request
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Increase timeout for podcast generation
        set_time_limit(300); // 5 minutes
        ini_set('max_execution_time', 300);
        
        $request->validate([
            'topic' => 'required|string|max:2000',
            'source_material' => 'nullable|string|max:10000',
            'host_a_name' => 'nullable|string|max:20',
            'host_b_name' => 'nullable|string|max:20',
        ]);

        $result = $this->podcastService->createPodcast([
            'user_id' => Auth::id(),
            'topic' => $request->input('topic'),
            'source_material' => $request->input('source_material'),
            'host_a_name' => $request->input('host_a_name', 'أليكس'),
            'host_b_name' => $request->input('host_b_name', 'سارة'),
        ]);

        if ($result['success']) {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'podcast' => $result['podcast'],
                'redirect' => route('user.podcast.show', ['id' => techEncrypt($result['podcast']->id)]),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $result['error'],
        ], 400);
    }

    /**
     * Display a specific podcast
     *
     * @param string $id Encrypted podcast ID
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $podcastId = techDecrypt($id);
        $podcast = $this->podcastService->getPodcast($podcastId, Auth::id());

        if (!$podcast) {
            return redirect()->route('user.podcast.index')
                ->with('error', __('Podcast not found'));
        }

        return view('openai::blades.podcast.show', [
            'podcast' => $podcast,
        ]);
    }

    /**
     * Get podcast status (for AJAX polling)
     *
     * @param string $id Encrypted podcast ID
     * @return JsonResponse
     */
    public function status(string $id): JsonResponse
    {
        $podcastId = techDecrypt($id);
        $podcast = $this->podcastService->getPodcast($podcastId, Auth::id());

        if (!$podcast) {
            return response()->json([
                'status' => 'error',
                'message' => __('Podcast not found'),
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'podcast' => [
                'id' => techEncrypt($podcast->id),
                'status' => $podcast->status,
                'title' => $podcast->title,
                'topic' => $podcast->topic,
                'script' => $podcast->script,
                'word_count' => $podcast->word_count,
                'estimated_duration' => $podcast->estimated_duration,
                'formatted_duration' => $podcast->formatted_duration,
                'error_message' => $podcast->error_message,
                'created_at' => $podcast->created_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /**
     * Delete a podcast
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $podcastId = techDecrypt($request->input('id'));
        $result = $this->podcastService->deletePodcast($podcastId, Auth::id());

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => __('Podcast deleted successfully'),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('Failed to delete podcast'),
        ], 400);
    }

    /**
     * Regenerate a podcast
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function regenerate(Request $request): JsonResponse
    {
        $podcastId = techDecrypt($request->input('id'));
        $result = $this->podcastService->regeneratePodcast($podcastId, Auth::id());

        if ($result['success']) {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $result['error'],
        ], 400);
    }

    /**
     * Get parsed script for TTS preparation
     *
     * @param string $id Encrypted podcast ID
     * @return JsonResponse
     */
    public function getScript(string $id): JsonResponse
    {
        $podcastId = techDecrypt($id);
        $podcast = $this->podcastService->getPodcast($podcastId, Auth::id());

        if (!$podcast) {
            return response()->json([
                'status' => 'error',
                'message' => __('Podcast not found'),
            ], 404);
        }

        if (!$podcast->isCompleted()) {
            return response()->json([
                'status' => 'error',
                'message' => __('Podcast is not ready yet'),
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'script' => $podcast->script,
            'parsed' => $podcast->parsed_script,
            'word_count' => $podcast->word_count,
            'estimated_duration' => $podcast->estimated_duration,
        ]);
    }
}
