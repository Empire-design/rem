<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;
            // if ($usertype !== "user" && $usertype !== "admin") {
            //     return to_route('login');
            // }
        }
        
        return $next($request);
    }
}





























































//     $userType = Auth::user();
        //     if ($userType === 'admin' || $userType === 'user') {
        //         return to_route('admin.dashboard');
        //     }
