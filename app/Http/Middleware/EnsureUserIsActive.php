<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Impede o acesso ao sistema de utilizadores marcados como inativos
 * (ex: ex-funcionários), sem precisar de apagar o registo do histórico.
 */
class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && ! Auth::user()->ativo) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'A sua conta está desativada. Contacte o administrador.',
            ]);
        }

        return $next($request);
    }
}
