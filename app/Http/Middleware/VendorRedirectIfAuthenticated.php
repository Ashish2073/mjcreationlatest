<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VendorRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'vendor'): Response
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->back()->withErrors([
                'alreadyloginmessage' => 'You are already logged in. Please logout first to access this page.'
            ]);
        }
        return $next($request);
    }
}
