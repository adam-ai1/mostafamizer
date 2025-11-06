<?php

/**
 * @package OpenAIController
 * @author TechVillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @contributor Soumik Datta <[soumik.techvill@gmail.com]>
 * @created 06-03-2023
 */

namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\{
    ContentService,
};

use Modules\OpenAI\Services\v2\TemplateService;

class OpenAIController extends Controller
{
    /**
     * Content Service
     *
     * @var object
     */
    protected $contentService;

    /**
     * Content Service
     *
     * @var object
     */
    protected $templateService;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(ContentService $contentService, TemplateService $templateService)
    {
        $this->contentService = $contentService;
        $this->templateService = $templateService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function templates()
    {

        $data['useCaseSearchUrl'] = route('user.use_case.search');
        $data['userUseCaseFavorites'] = auth()->user()->use_case_favorites;
        $data['useCases'] = $this->templateService->useCases($data['userUseCaseFavorites']);
        $data['useCaseCategories'] = $this->templateService->useCaseCategories();

        return view('openai::blades.templates', $data);
    }

    /**
     * Code Template
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function codeTemplate()
    {    
        $data['promtRoute'] = 'api/user/openai/image';
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        $data['promtUrl'] = 'api/v2/code';

        $userId = $this->contentService->getCurrentMemberUserId(null, 'session');
        $data['userId'] = $userId;
        $data['userSubscription'] = subscription('getUserSubscription',$userId);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['aiProviders'] = \AiProviderManager::databaseOptions('code');

        return view('openai::blades.code', $data);
    }
    
    /**
     * Download File
     * 
     * @param Request $request
     */
    public function downloadFile(Request $request)
    {
        $fileUrl = str_replace('\\', '/', $request->input('file_url'));

        $fileName = pathinfo($fileUrl, PATHINFO_BASENAME);

        // Download the file
        $contents = file_get_contents($fileUrl);

        // Set appropriate headers for the response
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return \Response::make($contents, 200, $headers);
    }

}


