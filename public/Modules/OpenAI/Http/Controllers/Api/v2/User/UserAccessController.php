<?php
/**
 * @package UserAccessController for User
 * @author TechVillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 10-06-2024
 */

namespace Modules\OpenAI\Http\Controllers\Api\v2\User;

use App\Http\Controllers\Controller;
use Modules\OpenAI\Transformers\Api\v2\UserAccessResource;
use Illuminate\Http\{
    JsonResponse,
    Response
};
use Illuminate\Support\Facades\Cookie;

class UserAccessController extends Controller
{
    /**
     * Retrieves the user access permissions and returns them as a UserAccessResource.
     *
     * @return UserAccessResource|JsonResponse The user access permissions as a UserAccessResource or a JSON response.
     */
    public function index():JsonResponse|UserAccessResource
    {
        return new UserAccessResource(json_decode(preference('user_permission')));
    }

    /**
     * Get user theme preference.
     *
     * @return JsonResponse
     */
    public function getTheme(): JsonResponse
    {
        try {
            $user = auth()->user();
            $theme = $user->theme_preference ?? 'light';

            return response()->json([
                'data' => [
                    'theme' => $theme
                ]
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Toggle user theme preference between light and dark.
     *
     * @return JsonResponse
     */
    public function toggle(): JsonResponse
    {
        try {
            $user = auth()->user();
            $currentTheme = $user->theme_preference ?? 'light';
            if (!in_array($currentTheme, ['light', 'dark'], true)) {
                $currentTheme = 'light';
            }


            // Update user theme preference
            $user->theme_preference = $currentTheme;
            $user->save();

            return response()
                ->json([
                    'data' => [
                        'theme' => $currentTheme
                    ]
                ], Response::HTTP_OK)
                ->withCookie(Cookie::forever('theme_preference', $currentTheme));

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
