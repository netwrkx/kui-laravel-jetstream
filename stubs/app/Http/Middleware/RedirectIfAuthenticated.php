<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  ...$guards
     *
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response|RedirectResponse
    {
        $guards = empty($guards) ? [null] : $guards;

        // Before we redirect to any intended url,
        // check if an earlier request to remove it was made.
        if ($request->session()->has('removeUrlIntended')) {
            $request->session()->forget('url.intended');
            $request->session()->forget('removeUrlIntended');
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
