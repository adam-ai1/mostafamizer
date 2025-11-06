<?php

/**
 * @package UseCaseCategoriesController
 * @author TechVillage <support@techvill.org>
 * @contributor kabir Ahmed <kabir.techvill@gmail.com>
 * @created 05-02-2023
 */

namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ModelTraits\Filterable;
use Modules\OpenAI\Entities\UseCaseCategory;
use Modules\OpenAI\Transformers\Api\V1\UseCaseCategoryResource;

class UseCaseCategoriesController extends Controller
{
    /**
     * Use Filtable trait.
     */

    use Filterable;

    /**
     * Return a listing of the resource.
     */
    public function index(Request $request): mixed
    {
        $configs        = $this->initialize([], $request->all());
        $categories = UseCaseCategory::query()->orderBy('id', 'DESC')->paginate($configs['rows_per_page']);
        $responseData = UseCaseCategoryResource::collection($categories)->response()->getData(true);
        return $this->response($responseData);
    }
}
