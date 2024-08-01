<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOTPSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('mobileLogin') || !$request->session()->has('admin')) {
            return redirect()->route('admin-login')->with('error', 'Something went wrong, please try again!');
        }



        return $next($request);
    }
}
