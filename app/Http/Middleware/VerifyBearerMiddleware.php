<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyBearerMiddleware
{
    use \App\Traits\OutPut;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     */
    public function handle(Request $request, Closure $next)
    {
        if (null === $request->bearerToken()) {
            throw new UnauthorizedHttpException('dingo', 'Forbidden');
            // return $this->responseRender(
            //     message: "Forbidden",
            //     httpCode: 403,
            // );
        }

        return $next($request);
    }
}
