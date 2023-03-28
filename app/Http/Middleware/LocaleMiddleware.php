<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        $language = $request->route()->parameter('language');
        if ($language) {
            App::setLocale($language);
        }

        return $next($request);
    }
}
