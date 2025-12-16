<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $level
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        if (Auth::user()->role()->type == 'admin') {
            return $next($request);
        }

        $featureName =  $level;
        
        // Check subscription feature access
        if (!hasAccess($featureName)) {
            $message = __('To access this feature, please upgrade your subscription plan.');
            
            // Handle API requests
            if ($request->is('api/*') || $request->wantsJson()) {
                return response()->json([
                    'error' => $message,
                ], 403);
            }
            
            Session::flash('info', $message);
            return redirect()->route('frontend.pricing');
        }
        return $next($request);
    }
}
