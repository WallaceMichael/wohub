<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Redirecionar usuários não autenticados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Verifica se a requisição espera JSON
        if (!$request->expectsJson()) {
            // Redireciona para a rota de login
            dd("caiu dentro");
            return route('login');
        }
dd("caiu aqui");
        // Para APIs, retorna 401 Unauthorized
        return route('login');
    }
}
