<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

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

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        // var_dump(Session::get('location_id'));
        // die();


        // if(($request->session()->has('location_id')) && ($request->session()->get('location_id') == 0))
        // {
        //     $request->session()->forget('location_id');
        //     return redirect()->guest('logout');
        // }

      if($request->segment(1)!='setlocation'){

        if((Session::has('location_id')) && (Session::get('location_id') == 0)){
          //  Session::forget('location_id');
            return redirect()->guest('setlocation');
        }
      }



        return $next($request);
    }
}
