<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EditModeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $editMode = false;

        $session = session();

        if (request('edit') === 'y' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', true);
        }

        if (request('edit') === 'n' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', false);
        }

        if (auth()->id() > 0 && auth()->user()->role === 'admin' && $session->get('editMode') === true) {
            $editMode = true;
        }

        view()->share('editMode', $editMode);

        return $next($request);
    }
}
