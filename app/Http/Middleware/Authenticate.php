<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, \Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        // Custom logic to check if the user is active
        if (Auth::check() && Auth::user()->is_active) {
            session()->flash('is_active', 'You are logged in as an active user!');
        }

        return $next($request);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
