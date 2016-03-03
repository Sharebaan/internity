<?php

namespace App\Http\Middleware;

use Closure;


class Reset
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
      if($request->session()->has('scan') || $request->session()->has('detplata')){
        $request->session()->forget('scan');
        $request->session()->forget('detplata');
      }
        return $next($request);
    }
}
