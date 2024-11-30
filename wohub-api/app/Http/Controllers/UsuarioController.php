<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Hash;

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
        try {
            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|unique:usuarios,email',
                'password' => 'required|string',
                'foto' => 'nullable|string',
                'tipo_usuario' => 'required|string|in:1,2',
                'cargo' => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Bad Request',
                'errors' => $e->errors(),
            ], 400);
        }

        $usuario = Usuario::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'foto' => $validated['foto'] ?? null, // Se foto for nula, armazena string vazia
            'tipo_usuario' => $validated['tipo_usuario'],
            'cargo' => $validated['cargo'],
        ]);

        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
        try {
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
