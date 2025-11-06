<?php

namespace Modules\OpenAI\Http\Controllers\Api\v2\User;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\OpenAI\Services\ContentService;

class UserController extends Controller
{
    /**
     * Fetch sidebar data based on the query parameters.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sidebar(Request $request)
    {
        $data = (new ContentService)->allFeatures($request->all());
        return response()->json(['data' => $data], Response::HTTP_OK);
    }
}
