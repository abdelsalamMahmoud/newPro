<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAge
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
        //the logic of this middleware
            $age = Auth::user()->age;
            if($age <15){
                return redirect()->route('dash');
            }
        return $next($request);
    }
}
