<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerformanceHeaders
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->is('admin*')) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');

            return $response;
        }

        // Safer caching for public HTML (session/CSRF still work with private)
        if ($response->headers->get('Content-Type')
            && str_contains($response->headers->get('Content-Type'), 'text/html')) {
            $response->headers->set('Cache-Control', 'private, max-age=0, must-revalidate');
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        }

        return $response;
    }
}
