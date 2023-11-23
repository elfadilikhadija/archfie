<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next){

        if ($request->user() && $request->user()->role !== 'cadre') {
            return redirect('/cadre/home')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
