<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            if (Auth::user()->role_as == '1') // 1=Admin & 0=User
            {
                return $next($request);
            } else {
                return redirect('/home')->with('message', 'Access Denied! As You Are Not An Admin');
            }
        } else {
            return redirect('/login')->with('message', 'Please login first!');
        }
    }
}
