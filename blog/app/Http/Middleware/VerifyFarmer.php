<?php

namespace App\Http\Middleware;

use Closure;

class verifyFarmer
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
        if($request->session()->has('userType')=='farmer'){
            return $next($request);
        }else{
            $request->session()->flash('error', 'You Have To Login First');
            return redirect()->route('landing');
        }
    }
}
