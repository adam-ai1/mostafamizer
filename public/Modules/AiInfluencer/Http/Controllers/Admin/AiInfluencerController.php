<?php

namespace Modules\AiInfluencer\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\Archive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\AiInfluencer\Datatables\AiInfluencerDataTable;

class AiInfluencerController extends Controller
{
    /**
     * Render the list of chatbots for admin.
     *
     * @param AiInfluencerDataTable $dataTable
     * @return Renderable
     */
    public function index(AiInfluencerDataTable $dataTable)
    {
        $data['users'] = User::get();
        $data['features'] = ['aishorts', 'influencer_avatar', 'urltovideo'];
        return $dataTable->render('aiinfluencer::admin.ai-influencer.index', $data);
    }

    /**
     * Remove the specified video archive from storage.
     *
     * @param int|string $id The ID of the video archive to delete.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page with a success or failure message.
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException If the provided ID is not numeric.
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        $video = Archive::where('id', $id)->whereIn('type', ['aishorts', 'influencer_avatar', 'urltovideo'])->first();

        if ($video) {
            try {
                DB::beginTransaction();
                if (isExistFile('public/uploads/aiVideos/' . $video->file_name)) {
                    Storage::disk()->delete('public/uploads/aiVideos/' . $video->file_name);
                }
    
                $video->unsetMeta(array_keys($video->getMeta()->toArray()));
                $video->save();
                $video->delete();

                DB::commit();
                return redirect()->back()->withSuccess(__('The :x has been successfully deleted.', ['x' => __('Video')]));
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withFail($e->getMessage());
            }
        }

        return redirect()->back()->withFail(__('Video does not exist.'));
    }
}
