<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogResponseTime
{
    public function handle($request, Closure $next)
    {
        // Start Time
        $startTime = microtime(true);

        // Handle Request
        $response = $next($request);

        // End Time
        $endTime = microtime(true);

        // Calculate Response Time in milliseconds
        $responseTime = ($endTime - $startTime) * 1000;

        // Log the response time
        Log::info('API Response Time: ' . number_format($responseTime, 2) . ' ms');

        // You can also attach the response time in the header
        $response->headers->set('X-Response-Time', number_format($responseTime, 2) . ' ms');

        return $response;
    }
}
