<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VideoStreamingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only set headers for video streaming route
        if ($request->is('video-stream/*')) {
            $response->headers->set('Accept-Ranges', 'bytes');
            $response->headers->set('Content-Type', 'video/mp4');
        }

        return $response;
    }
}
