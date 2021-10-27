<?php

namespace App\Http\Middleware;

use Closure;

class Role
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
        // if(auth()->user()->hasrole('customer')){
            
        //     return redirect()->route('welcome')->with('error','Permission Denied!!! You do not have administrative access.');
        // }
          return $next($request);
    }
}
