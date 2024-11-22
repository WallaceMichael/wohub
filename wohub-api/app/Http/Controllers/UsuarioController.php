<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Exception;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        if ($usuarios->isEmpty()) {
            return response()->json([], 404);
        }

        return response()->json($usuarios);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(null, 404);
        }

        return response()->json($usuario);
    }

    public function store(Request $request)
    {

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            //'senha' => bcrypt($request->senha), // Criptografa a senha
            'senha' => $request->senha, // Criptografa a senha
            'foto' => $request->foto,
            'tipo_usuario' => $request->tipo_usuario,
        ]);

        dd($usuario);
        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
        dd($request);
        // try{
        // $usuario = Usuario::find($id);

        //     if (!$usuario) {
        //         return response()->json(['message' => 'Usuário não encontrado'], 404);
        //     }

        //     $request->validate([
        //         'nome' => 'sometimes|string|max:50',
        //         'email' => 'sometimes|string|email|max:50|unique:usuarios,email,' . $id,
        //         'senha' => 'sometimes|string|min:6',
        //     ]);

        //     $usuario->update([
        //     'nome' => $request->nome ?? $usuario->nome,
        //     'email' => $request->email ?? $usuario->email,
        //     //'senha' => $request->senha ? bcrypt($request->senha) : $usuario->senha,
        //     'senha' => $request->senha ? $request->senha : $usuario->senha, // Atualiza senha se fornecida
        //     ]);
        // }catch(Exception $e){
        //     dd($e);
        //     return response()->json($usuario);
        // }
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
}
