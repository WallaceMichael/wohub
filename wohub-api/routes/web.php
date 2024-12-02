<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ArtigosController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Middleware\EnsureSessionWithToken;

Route::group(['prefix' => 'api'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
    Route::post('/contato', [ContatoController::class, 'store']);
    Route::post('/usuarios', [UsuarioController::class, 'store']); // CRIAR UM USUARIO
});

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth:sanctum']], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', [UsuarioController::class, 'index']); // RETORNA TODOS OS USUARIOS
        Route::get('/{id}', [UsuarioController::class, 'show']); // RETORNA USUARIO ONDE O ID É IGUAL
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

    Route::group(['prefix' => 'cursos'], function () {
        Route::get('/', [CursoController::class, 'index']); // RETORNA TODOS OS ARTIGOS
        Route::get('/{id}', [CursoController::class, 'show']); //RETORNAR OS ARTIGOS ONDE O ID É IGUAL
        Route::post('/', [CursoController::class, 'store']); // CRIA UM ARTIGO
        Route::put('/{id}', [CursoController::class, 'update']); // ATUALIZA UM ARTIGO ONDE O ID É IGUAL
        Route::delete('/{id}', [CursoController::class, 'destroy']); // DELETA UM ARTIGO ONDE O ID É IGUAL
    });

    Route::group(['prefix' => 'eventos'], function () {
        Route::get('/my', [EventoController::class, 'my']);
        Route::get('/', [EventoController::class, 'index']);
        Route::get('/{id}', [EventoController::class, 'show']);
        Route::post('/', [EventoController::class, 'store']);
        Route::put('/', [EventoController::class, 'update']);
        Route::delete('/', [EventoController::class, 'destroy']);
        Route::post('/subscribe/{event_id}', [EventoController::class, 'subscribe']);
        Route::get('/topEvents/{quantity?}', [EventoController::class, 'topEvents']);
    });
});
