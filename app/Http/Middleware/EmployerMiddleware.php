<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployerMiddleware
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
        if(Auth::guard('employer')->check() && Auth::guard('employer')->user()->role->id == 2){
            return $next($request);
        }else{
            return redirect()->route('employer.login');
        } 
    }
}
