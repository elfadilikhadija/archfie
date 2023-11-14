<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (!$request->is('admin/register') && !$request->is('admin/register/*')) {
                    $role = Auth::user()->role;
                    if ($role === 'admin' || $role === 'sg') {
                        return redirect("/$role/home");
                    }
                
                }
            }
        }

        return $next($request);
    }
}
