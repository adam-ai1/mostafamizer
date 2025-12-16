<?php

namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Support\Facades\{Auth, DB};
use Modules\OpenAI\Entities\UseCase;
use Modules\OpenAI\Http\Requests\ToggleFavoriteUseCaseRequest;
use Modules\OpenAI\Transformers\Api\V1\UseCaseResource;

class UseCasesController extends Controller
{
    /**
     * Use Filtable trait.
     */
    use Filterable;

    /**
     * Toggle favorite use case
     */
    public function useCaseToggleFavorite(ToggleFavoriteUseCaseRequest $request): mixed
    {
        $authUser = auth()->user();
        $favoritesArray = $authUser->use_case_favorites ?? [];

        try {
            if ($request->toggle_state == 'true') {
                $favoritesArray = array_unique(array_merge($favoritesArray, [$request->use_case_id]), SORT_NUMERIC);
                $message = __("Successfully marked favorite!");
            } else {
                $favoritesArray = array_diff($favoritesArray, [$request->use_case_id]);
                $message = __("Successfully removed from favorites!");
            }

            $authUser->use_case_favorites = $favoritesArray;
            $authUser->save();
        } catch (Exception $e) {
            return $this->unprocessableResponse([], __("Failed to update favorites! Please try again later."));
        }

        return $this->okResponse([], $message);
    }
}
