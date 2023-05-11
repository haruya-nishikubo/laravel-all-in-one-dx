<?php

namespace App\Http\Middleware;

use App\Exceptions\RoutePolicyNotAllowedException;
use Closure;
use Illuminate\Http\Request;

class EnsureRoutePolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     *
     * @throws RoutePolicyNotAllowedException
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $middleware = $request->route()
            ->gatherMiddleware();

        if (! in_array('auth', $middleware)) {
            return $response;
        }

        $user = auth()->user();

        if (empty($user)) {
            return $response;
        }

        $route = $request->route()
            ->getName();

        if (! $user->isRouteAllowed($route)) {
            throw new RoutePolicyNotAllowedException(implode("\t", [
                "email:{$user->email}",
                "route:{$route}",
            ]));
        }

        return $response;
    }
}
