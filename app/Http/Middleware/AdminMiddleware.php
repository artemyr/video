<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->id()) {
            flash()->alert('Not authorized');
            return redirect('login');
        }
        if (auth()->id() > 0 && auth()->user()->role !== 'admin') {
            flash()->alert('Forbidden');
            return redirect('login');
        }
        return $next($request);
    }
}
