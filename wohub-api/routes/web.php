<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ArtigosController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


Route::group(['prefix' => 'api', 'middleware' => ['web']], function () {
    Route::post('/login', [AuthController::class, 'login']);
});
Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/sanctum/token', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken()->plainTextToken;
    });

    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

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

    Route::group(['prefix' => 'cursos'], function () {
        Route::get('/', [CursoController::class, 'index']); // RETORNA TODOS OS ARTIGOS
        Route::get('/{id}', [CursoController::class, 'show']); //RETORNAR OS ARTIGOS ONDE O ID É IGUAL
        Route::post('/', [CursoController::class, 'store']); // CRIA UM ARTIGO
        Route::put('/{id}', [CursoController::class, 'update']); // ATUALIZA UM ARTIGO ONDE O ID É IGUAL
        Route::delete('/{id}', [CursoController::class, 'destroy']); // DELETA UM ARTIGO ONDE O ID É IGUAL
    });

    Route::group(['prefix' => 'eventos'], function () {
        Route::get('/', [EventoController::class, 'index']);
        Route::get('/{id}', [EventoController::class, 'show']);
        Route::post('/', [EventoController::class, 'store']);
        Route::put('/', [EventoController::class, 'update']);
        Route::delete('/', [EventoController::class, 'destroy']);
        Route::post('/subscribe/{event_id}', [EventoController::class, 'subscribe']);
        Route::post('/my', [EventoController::class, 'getEventosByUsuario']);

    });
});
