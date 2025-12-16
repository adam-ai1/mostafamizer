<?php

/**
 * @package OpenAIController for Admin
 * @author TechVillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 26-03-2023
 */

namespace Modules\OpenAI\Http\Controllers\Api\V1\Admin;

use Exception;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\OpenAI\Http\Controllers\Admin\{
    ImageController,
    CodeController
};

use Modules\OpenAI\Http\Resources\ContentResource;
use Modules\OpenAI\Services\{
    UseCaseTemplateService,
    ContentService,
    ImageService
};
use Modules\OpenAI\Entities\{
    OpenAI
};

class OpenAIController extends Controller
{
    /**
     * Use Filtable trait.
     */
    use Filterable;

    /**
     * Content Service
     *
     * @var object
     */
    protected $contentService;

    /**
     * Constructor
     *
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * Image creation from promt
     *
     * @param Request $request
     * @param ImageService $imageService
     * @return JsonResponse
     */
    public function image(Request $request, ImageService $imageService)
    {
        try {
            $imageUrls = $imageService->createImage($request->all());
            if (isset($imageUrls['status']) && $imageUrls['status'] == 'error') {
                return $this->unprocessableResponse($imageUrls);
            } else {
                return $imageUrls;
            }
        } catch(Exception $e) {
            $response = $e->getMessage();
            $data = [
                'response' => $response,
                'status' => 'failed',
            ];
            return $this->unprocessableResponse($data);
        }
    }

}


