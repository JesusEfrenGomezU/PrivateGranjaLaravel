<?php

namespace App\Http\Middleware;

use App\Helpers\RolHelper;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission = null): Response
    {

        if (!Auth::check()){

            return redirect()->route('login');
        }

        if(!empty($permission)){
            $isAuthorized = RolHelper::isAuthorized($permission);
            if(!$isAuthorized){

                abort(403, 'No hay autorizacion');
            }
        }
        return $next($request);
    }
}
