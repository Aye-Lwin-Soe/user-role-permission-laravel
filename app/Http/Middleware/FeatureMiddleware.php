<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class FeatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $feature)
    {
        $user = Auth::user();
        if ($user->role) {
            $hasPermission = $user->role->permissions()->whereHas('feature', function ($query) use ($feature) {
                $query->where('name', $feature);
            })->exists();
            if (!$hasPermission) {
                abort(403, 'You do not have permission to access this feature.');
            }
        } else {
            abort(403, 'You do not have role to access this feature.');
        }

        return $next($request);
    }
}
