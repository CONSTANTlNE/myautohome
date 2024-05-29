<?php

namespace App\Http\Middleware;

use App\Models\Allowedip;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Checkip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $allowedIps=Allowedip::pluck('ip')->toArray();
        $ipAddress = $request->ip();




        if (!in_array($ipAddress, $allowedIps, true)) {
            // If not allowed, return a 403 Forbidden response
            return response()->view('ip-error', [], 403);
        }

        return $next($request);
    }
}
