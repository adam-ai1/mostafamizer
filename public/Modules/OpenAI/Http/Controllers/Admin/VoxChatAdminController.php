<?php

namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\VoxChat\Entities\VoxConversation;
use Modules\VoxChat\Entities\VoxMessage;
use Modules\OpenAI\DataTables\VoxChatDataTable;
use App\Models\User;
use Session;

class VoxChatAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(VoxChatDataTable $dataTable)
    {
        $data['users'] = User::select('id', 'name')->get();
        $data['aiModels'] = [
            'gpt-4o' => 'GPT-4o',
            'gpt-4-turbo' => 'GPT-4 Turbo',
            'gpt-4' => 'GPT-4',
            'gpt-3.5-turbo' => 'GPT-3.5 Turbo',
        ];
        return $dataTable->render('openai::admin.voxchat.index', $data);
    }

    /**
     * Show the specified resource.
     * @param string $id
     * @return Renderable
     */
    public function show($id)
    {
        $value = techDecrypt($id);
        $data['conversation'] = VoxConversation::with(['user', 'messages' => function($query) {
            $query->orderBy('created_at', 'asc');
        }])->findOrFail($value);
        return view('openai::admin.voxchat.view', $data);
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

        $conversation = VoxConversation::find($id);
        if ($conversation) {
            // Delete associated messages first
            $messages = $conversation->messages;
            foreach ($messages as $message) {
                // Delete audio files if exists
                if ($message->media_path && file_exists(public_path($message->media_path))) {
                    @unlink(public_path($message->media_path));
                }
                if ($message->audio_response_path && file_exists(public_path($message->audio_response_path))) {
                    @unlink(public_path($message->audio_response_path));
                }
            }
            
            $conversation->messages()->delete();
            $conversation->delete();
            
            $data = [
                'status' => 'success',
                'message' => __('The :x has been deleted successfully.', ['x' => __('Conversation')])
            ];
        }

        Session::flash($data['status'], $data['message']);
        return redirect()->route('admin.features.voxchat.lists');
    }

    /**
     * Bulk delete conversations
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
            $conversation = VoxConversation::find($id);
            if ($conversation) {
                $messages = $conversation->messages;
                foreach ($messages as $message) {
                    if ($message->media_path && file_exists(public_path($message->media_path))) {
                        @unlink(public_path($message->media_path));
                    }
                    if ($message->audio_response_path && file_exists(public_path($message->audio_response_path))) {
                        @unlink(public_path($message->audio_response_path));
                    }
                }
                $conversation->messages()->delete();
                $conversation->delete();
                $deleted++;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => __(':x items deleted successfully', ['x' => $deleted])
        ]);
    }
}
