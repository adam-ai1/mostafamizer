<?php
/**
 * @package ImageController
 * @author TechVillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 06-03-2023
 */
namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\v2\CodeService;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\v2\ArchiveService;
use Illuminate\Http\{
    JsonResponse,
    Response
};

class CodeController extends Controller
{
    /**
     * Code Service
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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['codes'] = (new Archive())
            ->with(['metas', 'user', 'childs', 'codeCreator'])
            ->whereHas('metas', function ($q) {
                $q->where('key', 'code_creator_id')->where('value', auth()->id());
            })
            ->where('type', 'code_chat_reply')->latest()->paginate(preference('row_per_page'));
        return view('openai::blades.codes.list', $data);
    }

    /**
     * code view using slug
     *
     * @param mixed $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function view($slug)
    {
        $response = ['status' => 'error', 'message' => __('The data you are looking for is not found.')];
        $data['code'] = (new Archive)->contentBySlug($slug, 'code')->first();
        
        if (empty($data['code'])) {
            \Session::flash($response['status'], $response['message']);
            return redirect()->route('user.codeList');
        }

        return view('openai::blades.codes.view', $data);
    }

    /**
     * Delete code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete()
    {
        $id = request('id');
        if (!is_numeric($id)) {
            return response()->json(['error' => __('Invalid Request.')], Response::HTTP_FORBIDDEN);
        }

        try {
            ArchiveService::delete($id, 'code');
            return response()->json(['message' => __('The :x has been successfully deleted.', ['x' => __('code')])], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}


