<?php

namespace Modules\OpenAI\Http\Controllers\Admin\v2;

use Modules\OpenAI\DataTables\AiProductPhotographyDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\OpenAI\Exports\v2\AiProductPhotographyExport;
use Modules\OpenAI\Entities\Archive;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Storage;

class AiProductPhotographyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AiProductPhotographyDataTable $dataTable)
    {
       $sizes = DB::select("
                SELECT DISTINCT JSON_UNQUOTE(JSON_EXTRACT(value, '$.size')) AS size
                FROM archives_meta
                WHERE JSON_VALID(value)
                AND JSON_EXTRACT(value, '$.size') IS NOT NULL
                AND JSON_UNQUOTE(JSON_EXTRACT(value, '$.size')) != 'null'
            ");
            $sizes = array_map(function ($row) {
                return $row->size;
            }, $sizes);

        $data['sizes'] = $sizes;
        $data['users'] = User::get();

        return $dataTable->render('openai::admin.v2.ai-productshot.lists', $data);
    }

    /**
     * Delete image
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory(Request $request)
    {

        $image = Archive::where('id', $request->id)->where('type', 'productshot_variant')->first();

        if ($image) {
            try {
                DB::beginTransaction();
                if (isExistFile('public/uploads/aiImages/' . $image->original_name)) {
                    Storage::disk()->delete('public/uploads/aiImages/' . $image->original_name);
                }
    
                $image->unsetMeta(array_keys($image->getMeta()->toArray()));
                $image->save();
                $image->delete();

                DB::commit();
                return redirect()->back()->withSuccess(__('The :x has been successfully deleted.', ['x' => __('Image')]));
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withFail($e->getMessage());
            }
        }

        return redirect()->back()->withFail(__('Image does not exist.'));
    }

    /**
     * Image list pdf
     *
     * @return mixed
     */
    public function pdf()
    {
        $data['images'] = Archive::with('metas', 'imageCreator')->where('type', 'productshot_variant')->get();


        return printPDF($data, 'ai_product_photography_list_' . time() . '.pdf', 'openai::admin.v2.ai-productshot.pdf', view('openai::admin.v2.ai-productshot.pdf', $data), 'pdf');
    }

    /**
     * Image list csv
     *
     * @return mixed
     */
    public function csv()
    {
        return Excel::download(new AiProductPhotographyExport(), 'ai_product_photography_list_' . time() . '.csv');
    }
}
