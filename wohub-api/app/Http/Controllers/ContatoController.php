<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensagem' => 'required|string',
        ]);

        // Create a new contact entry in the database
        $contato = Contato::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'mensagem' => $request->mensagem,
        ]);

        return response()->json([
            'message' => 'Contato enviado com sucesso!',
            'data' => $contato
        ]);
    }
}
