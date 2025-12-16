<?php
/**
 * @package ImageController
 * @author TechVillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 06-03-2023
 */
namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\v2\CodeService;
use Modules\OpenAI\DataTables\{
    CodeDataTable
};
use Maatwebsite\Excel\Facades\Excel;
use Modules\OpenAI\Exports\CodeExport;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\v2\ArchiveService;
use Illuminate\Http\Response;

class CodeController extends Controller
{

    /**
     * Service
     *
     * @var object
     */
    protected $codeService;

    /**
     * @param codeService $codeService
     */
    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

     /**
     * List view of code
     *
     * @param CodeDataTable $codeDataTable
     * @return mixed
     */
    public function index(CodeDataTable $codeDataTable)
    {
        $data['users'] = $this->codeService->users();
        return $codeDataTable->render('openai::admin.code.index', $data);
    }

    /**
     * View code
     * @param mixed $slug
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view($slug)
    {
        $data['code'] = (new Archive)->contentBySlug($slug, 'code')->first();

        return view('openai::admin.code.view', $data);
    }

    /**
     * Delete
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $id = request('codeId');

        try {
            ArchiveService::delete($id, 'code');
            return redirect()->back()->with('success', __('The :x has been successfully deleted.', ['x' => __('Code')]));
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', __('Failed to delete code. Please try again.'));
        }
    }

    /**
     * Code To Text list csv
     *
     * @return void
     */
    public function csv()
    {
        return Excel::download(new CodeExport(), 'code_list_' . time() . '.csv');
    }
    
    /**
     * Code To Text list pdf
     *
     * @return void
     */
    public function pdf()
    {
        $data['codes'] = (new Archive)->codes('code')->get();

        return printPDF($data, 'code_list_' . time() . '.pdf', 'openai::admin.code.code_list_pdf', view('openai::admin.code.code_list_pdf', $data), 'pdf');
    }
}


