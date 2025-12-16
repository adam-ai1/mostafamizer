<?php

namespace Modules\OpenAI\Http\Controllers\Admin\v2;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\Voice;
use Modules\OpenAI\Entities\Avatar;
use Illuminate\Contracts\Support\Renderable;
use Modules\OpenAI\DataTables\AvatarDataTable;
use Modules\OpenAI\DataTables\AvatarVoicesDataTable;
use Modules\OpenAI\Services\v2\FeatureManagerService;
use Modules\OpenAI\Services\v2\AiPersonaService;

class AiCharacterController extends Controller
{
    /**
     * Render the list of chatbots for admin.
     *
     * @param AvatarDataTable $dataTable
     * @return Renderable
     */
    public function avatars(AvatarDataTable $dataTable)
    {
        $data['users'] = User::get();

        $featureNames = apply_filters('sync_avatar_data', ['aipersona']);
        $data['providers'] = [];

        foreach ($featureNames as $featureName) {
            $data['providers'][$featureName] = (new FeatureManagerService())->getActiveProviders($featureName);
        }

        return $dataTable->render('openai::admin.v2.ai-character.index', $data);
    }

    /**
     * Render the list of avatar voices for admin.
     *
     * @param AvatarVoicesDataTable $dataTable
     * @return Renderable
     */
    public function voices(AvatarVoicesDataTable $dataTable)
    {
        $data['users'] = User::get();

        $featureNames = apply_filters('sync_avatar_voices_data', ['aipersona']);
        $data['providers'] = [];

        foreach ($featureNames as $featureName) {
            $data['providers'][$featureName] = (new FeatureManagerService())->getActiveProviders($featureName);
        }

        return $dataTable->render('openai::admin.v2.ai-character.voice', $data);
    }

    /**
     * Render the sync page for admin.
     *
     * @return \Illuminate\View\View
     */
    public function sync(Request $request)
    {
        $service = new AiPersonaService();
        
        try {
            $data = $service->syncData($request->except('_token'));

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
