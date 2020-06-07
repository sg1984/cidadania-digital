<?php

namespace App\Http\Middleware;

use Closure;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->is_active) {
            auth()->logout();
            return redirect()
                ->route('login')
                ->with('error', 'Sua conta de usuário foi desativada');
        }

        return $next($request);
    }
}
