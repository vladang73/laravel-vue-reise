<?php

namespace App\Http\Middleware\Api;

use App\Models\User;
use Closure;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!User::authToken($request->get('token'))){
            return response()->json(['success'=>false, 'error'=>'Not authorized user or token expired.'], 401);
        } else{
            return $next($request);
        }
    }
}
