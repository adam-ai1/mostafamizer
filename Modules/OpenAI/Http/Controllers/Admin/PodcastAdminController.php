<?php

namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\Podcast;
use Modules\OpenAI\DataTables\PodcastDataTable;
use App\Models\User;
use Session;

class PodcastAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PodcastDataTable $dataTable)
    {
        $data['users'] = User::select('id', 'name')->get();
        $data['statuses'] = [
            'pending' => __('Pending'),
            'processing' => __('Processing'),
            'completed' => __('Completed'),
            'failed' => __('Failed'),
        ];
        $data['tiers'] = [
            'free' => __('Free'),
            'premium' => __('Premium'),
        ];
        return $dataTable->render('openai::admin.podcast.index', $data);
    }

    /**
     * Show the specified resource.
     * @param string $id
     * @return Renderable
     */
    public function show($id)
    {
        $value = techDecrypt($id);
        $data['podcast'] = Podcast::with('user')->findOrFail($value);
        return view('openai::admin.podcast.view', $data);
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

        $podcast = Podcast::find($id);
        if ($podcast) {
            // Delete audio files if exists
            if ($podcast->audio_path && file_exists(public_path($podcast->audio_path))) {
                @unlink(public_path($podcast->audio_path));
            }
            if ($podcast->audio_host_a && file_exists(public_path($podcast->audio_host_a))) {
                @unlink(public_path($podcast->audio_host_a));
            }
            if ($podcast->audio_host_b && file_exists(public_path($podcast->audio_host_b))) {
                @unlink(public_path($podcast->audio_host_b));
            }
            
            $podcast->delete();
            $data = [
                'status' => 'success',
                'message' => __('The :x has been deleted successfully.', ['x' => __('Podcast')])
            ];
        }

        Session::flash($data['status'], $data['message']);
        return redirect()->route('admin.features.podcast.lists');
    }

    /**
     * Bulk delete podcasts
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
            $podcast = Podcast::find($id);
            if ($podcast) {
                if ($podcast->audio_path && file_exists(public_path($podcast->audio_path))) {
                    @unlink(public_path($podcast->audio_path));
                }
                if ($podcast->audio_host_a && file_exists(public_path($podcast->audio_host_a))) {
                    @unlink(public_path($podcast->audio_host_a));
                }
                if ($podcast->audio_host_b && file_exists(public_path($podcast->audio_host_b))) {
                    @unlink(public_path($podcast->audio_host_b));
                }
                $podcast->delete();
                $deleted++;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => __(':x items deleted successfully', ['x' => $deleted])
        ]);
    }
}
