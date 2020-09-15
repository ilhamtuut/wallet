<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Block
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
        $response = $next($request);
        if(Auth::check() && Auth::user()->is_block){
            Auth::logout();
            $request->session()->flash('failed', 'Your Account is Bloked');
            return redirect()->route('login');
        }
        return $response;
    }
}
