<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ignore API and Assets
        if ($request->is('api/*') || $request->is('assets/*')) {
            return $next($request);
        }

        try {
            // Count unique visitor by IP
            // We use firstOrCreate to avoid duplicates due to the unique constraint on ip_address
            Visitor::firstOrCreate(
                ['ip_address' => $request->ip()],
                ['user_agent' => $request->userAgent()]
            );
        } catch (\Exception $e) {
            // Fail silently if something goes wrong (e.g. race condition) to not block the request
        }

        return $next($request);
    }
}
