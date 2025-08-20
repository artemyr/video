<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PageCacheMiddleware
{
    private bool $isNeedCachePage;
    private ?string $routeName;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->routeName = $request->route()->getName();
        $this->isNeedCachePage = $this->isNeedCachePage();

        if ($this->isNeedCachePage) {
            $cache = Cache::get('page_cache_' . $this->routeName);
            if (!empty($cache)) {
                return \response($cache, Response::HTTP_OK);
            }
        }

        $response = $next($request);

        if ($this->isNeedCachePage) {
            Cache::rememberForever('page_cache_' . $this->routeName, fn(): string => $response->getContent());
        }

        return $response;
    }

    protected function isNeedCachePage(): bool
    {
        $cachedRoutes = config('cache.cached_routes');
        if (!in_array($this->routeName, $cachedRoutes)) {
            return false;
        }

        if (auth()->user() && auth()->user()->role === 'admin') {
            return false;
        }

        return true;
    }
}
