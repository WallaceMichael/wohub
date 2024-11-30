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
            'cargo' => $request->cargo ?? "",
        ]);

        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
         try{
         $usuario = Usuario::find($id);

             if (!$usuario) {
                 return response()->json(['message' => 'Usuário não encontrado'], 404);
             }

             $usuario->update([
                 'nome' => $request->nome,
                 'email' => $request->email,
                 //'senha' => bcrypt($request->senha), // Criptografa a senha
                 'senha' => $request->senha, // Criptografa a senha
                 'cargo' => $request->cargo ?? "",
             ]);
         } catch (Exception $e) {
             return response()->json([
                 "message" => $e->getMessage(),
             ], 400);
         }
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
