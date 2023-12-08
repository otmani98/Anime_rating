<?php

namespace App\Http\Middleware;

use App\Exceptions\GeneralJsonException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //if they aren't admin
        // role admin == 1 , role user == 2
        if (auth()->user()->role_id !== 1) {
            throw new GeneralJsonException('You do not have premession to perform this action', 403);
        }
        return $next($request);
    }
}
