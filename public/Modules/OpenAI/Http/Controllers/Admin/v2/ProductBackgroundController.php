<?php

namespace Modules\OpenAI\Http\Controllers\Admin\v2;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\OpenAI\DataTables\ProductBackgroundDataTable;
use Modules\OpenAI\Services\v2\FeatureManagerService;
use Modules\OpenAI\Services\v2\AiProductShotsService;

class ProductBackgroundController extends Controller
{
    /**
     * Render the list of chatbots for admin.
     *
     * @param ProductBackgroundDataTable $dataTable
     * @return Renderable
     */
    public function index(ProductBackgroundDataTable $dataTable)
    {
        $data['users'] = User::get();
        $data['providers'] = (new FeatureManagerService())->getActiveProviders('aiproductshot');
        return $dataTable->render('openai::admin.v2.ai-productshot.index', $data);
    }

    /**
     * Render the sync page for admin.
     *
     * @return \Illuminate\View\View
     */
    public function sync(Request $request)
    {
        try {
            $data = (new AiProductShotsService())->syncData($request->except('_token'));

            if ($data) {
                \Session::flash('success', __('The data has been successfully updated.'));

                return response()->json([
                    'status' => 'success',
                    'message' => __('The data has been successfully updated.')
                ]);
            }

            return redirect()->back();
        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
