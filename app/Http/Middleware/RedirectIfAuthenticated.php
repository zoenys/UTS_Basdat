<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect('/admin_validate');
                case 'psikolog':
                    return redirect('/sched');
                case 'user':
                    return redirect('/doctor');
                default:
                    return redirect('/'); // Atau ke halaman default lainnya
            }
        }
    
        return $next($request);
    }
}
