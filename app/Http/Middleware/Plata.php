<?php

namespace App\Http\Middleware;

use Closure;

class Plata
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
      if(!$request->session()->has('detplata')){
        return redirect('/platafacturi');
      }
        return $next($request);
    }
}
