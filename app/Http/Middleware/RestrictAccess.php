<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use User;

class RestrictAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check if user has signed in then check if he has admin access or not
        if(Auth::check() && Auth::User()->isAdmin()){
            //return the admin to the requested page
            return $next($request);
        }
        // return user to log in page
        return redirect("/login");
       
    }
}
