<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
        $language = $request->segment(1);

        if (in_array($language, Config::get('app.supported_locales'))) {
            app()->setLocale($language);
        } else {
            app()->setLocale('fr');
        }

        return $next($request);
    }
}
