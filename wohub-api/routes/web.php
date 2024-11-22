<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ArtigosController;

Route::group(['prefix' => 'api/v1', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', [UsuarioController::class, 'index']); // RETORNA TODOS OS USUARIOS
        Route::get('/{id}', [UsuarioController::class, 'show']); // RETORNA USUARIO ONDE O ID É IGUAL
        Route::post('/', [UsuarioController::class, 'store']); // CRIAR UM USUARIO
        Route::put('/{id}', [UsuarioController::class, 'update']); // ATUALIZA UM USUARIO ONDE O ID É IGUAL
        Route::delete('/{id}', [UsuarioController::class, 'destroy']); // DELETE UM USUARIO ONDE O ID É IGUAL
    });

    Route::group(['prefix' => 'artigos'], function () {
        Route::get('/', [ArtigosController::class, 'index']); // RETORNA TODOS OS ARTIGOS
        Route::get('/{id}', [ArtigosController::class, 'show']); //RETORNAR OS ARTIGOS ONDE O ID É IGUAL
        Route::post('/', [ArtigosController::class, 'store']); // CRIA UM ARTIGO
        Route::put('/{id}', [ArtigosController::class, 'update']); // ATUALIZA UM ARTIGO ONDE O ID É IGUAL
        Route::delete('/{id}', [ArtigosController::class, 'destroy']); // DELETA UM ARTIGO ONDE O ID É IGUAL
    });
});
