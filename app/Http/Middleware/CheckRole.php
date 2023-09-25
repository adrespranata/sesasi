<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * @author      Adres Pranata
     * @email       adrespranata0201@gmail.com
     * @copyright   2023
     */

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }
        return response()->json(['message' => 'You do not have permission to access for this page.']);
        // return abort(403, 'Unauthorized');
    }
}
