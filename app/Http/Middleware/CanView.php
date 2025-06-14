<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanView
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (canView($permission)){
            return $next($request);
        }
        abort(403, 'Usted no tiene autorización');
    }
}
