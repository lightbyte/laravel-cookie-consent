<?php

namespace MacsiDigital\CookieConsent\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CookieConsent
{
    public function handle($request, Closure $next)
    {
        $consent_required = false;
        if (config('cookie-consent.enabled')){
            $cookieName = config('cookie-consent.cookie_name');
            if(! $request->cookies->has($cookieName)){
                $consent_required = true;
            }
        }
        app('view')->share('consent_required', $consent_required);

        return $next($request);
    }
}