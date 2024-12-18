<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Redirect based on user role
            if ($user->role == '1') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == '2') {
                return redirect()->route('department.dashboard');
            } elseif ($user->role == '3') {
                return redirect()->route('employee.dashboard');
            }
        }

        return $next($request);
    }
}
