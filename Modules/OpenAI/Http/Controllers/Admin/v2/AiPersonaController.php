<?php

namespace Modules\OpenAI\Http\Controllers\Admin\V2;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\OpenAI\Entities\Archive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\OpenAI\DataTables\AiPersonaDataTable;

class AiPersonaController extends Controller
{
    /**
     * Render the list of chatbots for admin.
     *
     * @param AiPersonaDataTable $dataTable
     * @return Renderable
     */
    public function index(AiPersonaDataTable $dataTable)
    {
        $data['users'] = User::get();
        return $dataTable->render('openai::admin.v2.ai-persona.index', $data);
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

        $video = Archive::where('id', $id)->where('type', 'ai_persona')->first();

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
