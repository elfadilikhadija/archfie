<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\Request;
class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin' && $request->is('admin/register')) {
                return $next($request);
            }

            return redirect('/admin/home');
        }

        return $next($request);
    }
}
