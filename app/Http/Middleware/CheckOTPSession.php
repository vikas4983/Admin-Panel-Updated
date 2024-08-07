<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        if (session()->has('otp_sent')) {
            session()->forget('otp_sent');
            return redirect('admin-login')
                ->with('error', 'Something went wrong. Please try again in two minutes.');
        }
        return $next($request);
    }
}
