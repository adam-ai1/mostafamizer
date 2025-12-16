<?php

namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\AudioAd;
use Modules\OpenAI\DataTables\AudioAdsDataTable;
use App\Models\User;
use Session;

class AudioAdsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AudioAdsDataTable $dataTable)
    {
        $data['users'] = User::select('id', 'name')->get();
        $data['statuses'] = [
            'pending' => __('Pending'),
            'processing' => __('Processing'),
            'completed' => __('Completed'),
            'failed' => __('Failed'),
        ];
        $data['adStyles'] = [
            'professional' => __('Professional'),
            'casual' => __('Casual'),
            'energetic' => __('Energetic'),
            'calm' => __('Calm'),
            'humorous' => __('Humorous'),
        ];
        $data['platforms'] = [
            'radio' => __('Radio'),
            'podcast' => __('Podcast'),
            'social_media' => __('Social Media'),
            'youtube' => __('YouTube'),
            'general' => __('General'),
        ];
        return $dataTable->render('openai::admin.audio-ads.index', $data);
    }

    /**
     * Show the specified resource.
     * @param string $id
     * @return Renderable
     */
    public function show($id)
    {
        $value = techDecrypt($id);
        $data['audioAd'] = AudioAd::with('user')->findOrFail($value);
        return view('openai::admin.audio-ads.view', $data);
    }

    /**
     * Delete the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $data = [
            'status' => 'failed',
            'message' => __('The data you are looking for is not found')
        ];

        $audioAd = AudioAd::find($id);
        if ($audioAd) {
            // Delete audio files if exists
            if ($audioAd->audio_path && file_exists(public_path($audioAd->audio_path))) {
                @unlink(public_path($audioAd->audio_path));
            }
            if ($audioAd->audio_voice_only && file_exists(public_path($audioAd->audio_voice_only))) {
                @unlink(public_path($audioAd->audio_voice_only));
            }
            
            $audioAd->delete();
            $data = [
                'status' => 'success',
                'message' => __('The :x has been deleted successfully.', ['x' => __('Audio Ad')])
            ];
        }

        Session::flash($data['status'], $data['message']);
        return redirect()->route('admin.features.audio-ads.lists');
    }

    /**
     * Bulk delete audio ads
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return response()->json([
                'status' => 'error',
                'message' => __('No items selected')
            ], 400);
        }

        $deleted = 0;
        foreach ($ids as $id) {
            $audioAd = AudioAd::find($id);
            if ($audioAd) {
                if ($audioAd->audio_path && file_exists(public_path($audioAd->audio_path))) {
                    @unlink(public_path($audioAd->audio_path));
                }
                if ($audioAd->audio_voice_only && file_exists(public_path($audioAd->audio_voice_only))) {
                    @unlink(public_path($audioAd->audio_voice_only));
                }
                $audioAd->delete();
                $deleted++;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => __(':x items deleted successfully', ['x' => $deleted])
        ]);
    }
}
