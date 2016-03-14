<?php

namespace App\Http\Middleware;

use Closure;

class Factura
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
        if(!$request->session()->has('scan')){
          return redirect('/');
        }
        return $next($request);
    }
}
