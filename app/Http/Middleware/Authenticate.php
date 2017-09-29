<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;
use View;

class Authenticate
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

        if(!isset($_SESSION['Usuario']))
        {
            $_SESSION['Usuario'] = '';
        }
        /*if(empty($_SESSION['Usuario']) && $request->path() != "welcome" )
        {
            $response = $next($request);

            abort(403, 'accion no autorizada.');
            exit();
        }*/

        return $next($request);
    }
}
