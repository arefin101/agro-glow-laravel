<?php

namespace App\Http\Middleware;

use Closure;

class VerifySession
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
        if($request->session()->has('userName') && $request->session()->get('validity')=='valid'){
            return $next($request);
        }else{
            $request->session()->flash('error', 'invalid request....');
            return redirect('/login');
        }
    }
}
