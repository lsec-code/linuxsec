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
        $ip = $request->ip();
        
        // Check if visitor exists, if not create
        // using firstOrCreate to avoid race conditions roughly
        if (!Visitor::where('ip_address', $ip)->exists()) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent()
            ]);
        }

        return $next($request);
    }
}
