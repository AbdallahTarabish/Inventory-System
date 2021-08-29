<?php

namespace App\Http\Middleware;

use Closure;

class ConfigRouteMiddleware
{
    public function handle($request, Closure $next)
    {
        config("aside.main_menu");
    }
}
