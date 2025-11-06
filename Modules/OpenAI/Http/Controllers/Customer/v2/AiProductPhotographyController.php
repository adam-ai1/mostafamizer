<?php

namespace Modules\OpenAI\Http\Controllers\Customer\v2;

use Illuminate\Contracts\Support\Renderable;
use Modules\OpenAI\Services\ContentService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\OpenAI\Transformers\Api\v2\Image\{
    SingleImageResources,
    ImageReplyResources
};

use Modules\OpenAI\Services\v2\AiProductPhotographyService;

class AiProductPhotographyController extends Controller
{
    /**
     * Template method to render the ai productshot page.
     *
     * Renders the ai productshot page with the latest avatars, voices, and videos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function template(Request $request)
    {
        $data['aiProviders'] = \AiProviderManager::databaseOptions('aiproductphotography');
        $provider = count($data['aiProviders']) > 0 ? str_replace('aiproductphotography_', '', array_keys($data['aiProviders'])[0]) : '';
        $data['userId'] = (new ContentService())->getCurrentMemberUserId(null, 'session');

        $data['backgrounds'] = (new AiProductPhotographyService())->getBackgrounds('ai_product_photography', $provider)->filter('Modules\\OpenAI\\Filters\\ProductBackgroundFilter')->paginate(preference('row_per_page'));
        $data['userSubscription'] = subscription('getUserSubscription',auth()->user()->id);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['featureLimit'] = $data['featureLimit'] ?? 0;

        $data['promptUrl'] = route('user.ai-product-photography.store');
        $data['rules'] = \AiProviderManager::rules('aiproductphotography');

        if ($request->ajax()) {
            return response()->json([
                'items' =>  $data['backgrounds'],
                'nextPageUrl' => $data['backgrounds']->nextPageUrl()
            ]);
        }

        return view('openai::blades.ai_productshot.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $checkSubscription = checkUserSubscription('image');

        if ($checkSubscription['status'] != 'success') {
            return response()->json(['error' => $checkSubscription['response']], Response::HTTP_FORBIDDEN);
        }
        
        try {
            request()->merge([...$request['options']]);
            $service = new AiProductPhotographyService();
            $service->validation();
            $images = new ImageReplyResources($service->store($request->except('_token')));

            return response()->json(['data' => $images], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
