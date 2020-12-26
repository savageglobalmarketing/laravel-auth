<?php

namespace SavageGlobalMarketing\Auth\Http\Middleware;

use App\Http\Middleware\Authenticate;
use Closure;

class AuthMiddleware extends Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        $tokenName = config('sav-auth.token_name');

        if (
            $request->cookie($tokenName) &&
            !$request->headers->get('authorization') &&
            !$request->headers->get('disable-authorization')
        ) {
            $request->headers->set('authorization', 'Bearer ' . $request->cookie($tokenName));
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
