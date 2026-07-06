<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = str_starts_with($request->header('Accept-Language') ?? '', 'en') ? 'en' : 'ar';

        app()->instance('current_language', $lang);
        app()->setLocale($lang);

        return $next($request);
    }
}
