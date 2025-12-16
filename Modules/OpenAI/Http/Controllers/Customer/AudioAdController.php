<?php

/**
 * @package AudioAdController
 * @author VoxCraft
 * @created 2024-12-15
 */

namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\OpenAI\Services\AudioAdService;
use Modules\OpenAI\Entities\AudioAd;

class AudioAdController extends Controller
{
    /**
     * Audio Ad Service
     *
     * @var AudioAdService
     */
    protected AudioAdService $audioAdService;

    /**
     * Constructor
     *
     * @param AudioAdService $audioAdService
     */
    public function __construct(AudioAdService $audioAdService)
    {
        $this->audioAdService = $audioAdService;
    }

    /**
     * Display the audio ads list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        
        $data = [
            'audioAds' => $this->audioAdService->getUserAudioAds($userId, preference('row_per_page', 12)),
            'availability' => $this->audioAdService->checkAvailability($userId),
        ];

        return view('openai::blades.audio_ads.index', $data);
    }

    /**
     * Display the audio ad creation page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $userId = Auth::id();
        $availability = $this->audioAdService->checkAvailability($userId);

        if (!$availability['available']) {
            return redirect()->route('user.audio-ads.index')
                ->with('error', $availability['error']);
        }

        return view('openai::blades.audio_ads.create', [
            'availability' => $availability,
            'voices' => AudioAd::getAvailableVoices(),
            'styles' => AudioAd::getStyleOptions(),
            'platforms' => AudioAd::getPlatformOptions(),
            'durations' => AudioAd::getDurationOptions(),
            'musicOptions' => AudioAd::getMusicOptions(),
            'productTypes' => AudioAd::getProductTypes(),
        ]);
    }

    /**
     * Store a new audio ad
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Increase timeout for audio generation
        set_time_limit(180); // 3 minutes
        ini_set('max_execution_time', 180);
        
        $request->validate([
            'ad_text' => 'required|string|min:10|max:5000',
            'title' => 'nullable|string|max:200',
            'product_type' => 'nullable|string|max:50',
            'ad_style' => 'nullable|string|in:professional,casual,energetic,emotional',
            'target_platform' => 'nullable|string|in:radio,youtube,social_media,podcast',
            'target_duration' => 'nullable|integer|in:15,30,60',
            'voice_id' => 'nullable|string|max:100',
            'background_music' => 'nullable|string|max:50',
            'music_volume' => 'nullable|numeric|min:0|max:1',
        ]);

        // Get voice name from voice ID
        $voiceId = $request->input('voice_id', 'EXAVITQu4vr4xnSDxMaL');
        $voices = AudioAd::getAvailableVoices();
        $voiceName = $voices[$voiceId]['name'] ?? 'سارة';

        $result = $this->audioAdService->createAudioAd([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'ad_text' => $request->input('ad_text'),
            'product_type' => $request->input('product_type'),
            'ad_style' => $request->input('ad_style', AudioAd::STYLE_PROFESSIONAL),
            'target_platform' => $request->input('target_platform', AudioAd::PLATFORM_RADIO),
            'target_duration' => $request->input('target_duration', AudioAd::DURATION_MEDIUM),
            'voice_id' => $voiceId,
            'voice_name' => $voiceName,
            'background_music' => $request->input('background_music', AudioAd::MUSIC_NONE),
            'music_volume' => $request->input('music_volume', 0.2),
        ]);

        if ($result['success']) {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'audio_ad' => $result['audio_ad'],
                'redirect' => route('user.audio-ads.show', ['id' => techEncrypt($result['audio_ad']->id)]),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $result['error'] ?? $result['message'],
        ], 400);
    }

    /**
     * Display a specific audio ad
     *
     * @param string $id Encrypted audio ad ID
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $audioAdId = techDecrypt($id);
        $audioAd = $this->audioAdService->getAudioAd($audioAdId, Auth::id());

        if (!$audioAd) {
            return redirect()->route('user.audio-ads.index')
                ->with('error', __('Audio ad not found'));
        }

        return view('openai::blades.audio_ads.show', [
            'audioAd' => $audioAd,
            'voices' => AudioAd::getAvailableVoices(),
            'styles' => AudioAd::getStyleOptions(),
            'platforms' => AudioAd::getPlatformOptions(),
            'musicOptions' => AudioAd::getMusicOptions(),
        ]);
    }

    /**
     * Get audio ad status (for AJAX polling)
     *
     * @param string $id Encrypted audio ad ID
     * @return JsonResponse
     */
    public function status(string $id): JsonResponse
    {
        $audioAdId = techDecrypt($id);
        $audioAd = $this->audioAdService->getAudioAd($audioAdId, Auth::id());

        if (!$audioAd) {
            return response()->json([
                'status' => 'error',
                'message' => __('Audio ad not found'),
            ], 404);
        }

        return response()->json([
            'status' => $audioAd->status,
            'status_label' => $audioAd->getStatusLabel(),
            'audio_path' => $audioAd->isReady() ? asset($audioAd->audio_path) : null,
            'duration' => $audioAd->getFormattedDuration(),
            'error_message' => $audioAd->error_message,
        ]);
    }

    /**
     * Delete an audio ad
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|string',
        ]);

        $audioAdId = techDecrypt($request->input('id'));
        $deleted = $this->audioAdService->deleteAudioAd($audioAdId, Auth::id());

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => __('Audio ad deleted successfully'),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('Failed to delete audio ad'),
        ], 400);
    }

    /**
     * Download audio ad file
     *
     * @param string $id Encrypted audio ad ID
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function download(string $id)
    {
        $audioAdId = techDecrypt($id);
        $audioAd = $this->audioAdService->getAudioAd($audioAdId, Auth::id());

        if (!$audioAd || !$audioAd->isReady()) {
            return redirect()->route('user.audio-ads.index')
                ->with('error', __('Audio file not available'));
        }

        $filePath = base_path($audioAd->audio_path);
        
        if (!file_exists($filePath)) {
            return redirect()->route('user.audio-ads.index')
                ->with('error', __('Audio file not found'));
        }

        $fileName = 'audio_ad_' . $audioAd->id . '_' . time() . '.mp3';

        return response()->download($filePath, $fileName);
    }

    /**
     * Stream audio ad file for playback
     *
     * @param string $id Encrypted audio ad ID
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\Response
     */
    public function stream(string $id)
    {
        $audioAdId = techDecrypt($id);
        $audioAd = $this->audioAdService->getAudioAd($audioAdId, Auth::id());

        if (!$audioAd || !$audioAd->isReady()) {
            abort(404, 'Audio not found');
        }

        $filePath = base_path($audioAd->audio_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'Audio file not found');
        }

        $fileSize = filesize($filePath);
        $mimeType = 'audio/mpeg';

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Length' => $fileSize,
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
