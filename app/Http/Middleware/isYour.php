<?php

namespace App\Http\Middleware;

use Closure;

class isYour
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
        if($request->user()->role=='admin' || $request->is('*'.$request->user()->id.'*'))
        {
            return $next($request);
        }
        return redirect('home');
    }
}
