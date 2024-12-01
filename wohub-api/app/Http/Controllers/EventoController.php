<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Inscricao;
use Illuminate\Validation\Rule;

class EventoController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $eventos = Evento::with("usuario")->get();

        if ($eventos->isEmpty()) {
            return response()->json([], 404);
        }

        return response()->json($eventos);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'categoria' => 'required|string',
            'link' => 'required|string',
            'tipo_evento' => ['required', 'string', Rule::in(['palestra', 'workshop', 'hackathon'])],
            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto' => 'nullable|string',
            'data_evento' => 'nullable|date',
            'usuarios_id' => 'required|integer|exists:usuarios,id',
        ]);

        $validatedData["usuarios_id"] = $request->user()->id;

        // Handle file upload if present
//        if ($request->hasFile('foto')) {
//            $path = $request->file('foto')->store('eventos', 'public');
//            $validatedData['foto'] = $path;
//        }

        try {
            $event = Evento::create($validatedData);
            return response()->json($event, 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating event: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Display the specified resource.
    public function show($id)
    {
        $evento = Evento::with("usuario")->findOrFail($id);

        if (!$evento) {
            return response()->json(null, 404);
        }

        return response()->json($evento);
    }

    // Update the specified resource in storage.
    public function update(Request $request, Evento $evento)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:50',
            'descricao' => 'required|string|max:255',
            'categoria' => 'required|string|max:50',
            'link' => 'required|url',
            'tipo_evento' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('eventos', 'public');
            $validatedData['foto'] = $path;
        }

        $evento->update($validatedData);

        return redirect()->route('eventos.index')->with('success', 'Evento atualizado com sucesso!');
    }

    // Remove the specified resource from storage.
    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento excluído com sucesso!');
    }

    public function my(Request $request)
    {
        $userId = session('user_id');

        $eventos = Evento::with(["inscricoes", "usuario"])->whereHas('inscricoes', function ($query) use ($userId) {
            $query->where('usuarios_id', $userId);
        })->get();

        if ($eventos->isEmpty()) {
            return response()->json(['message' => 'Nenhum evento encontrado para este usuário.'], 404);
        }

        return response()->json($eventos);
    }

    public function subscribe(Request $request, $event_id)
    {
        $userId = $request->input('user_id');
        // Verificar se o evento existe
        $evento = Evento::find($event_id);
        if (!$evento) {
            return response()->json(['message' => 'Evento não encontrado.'], 404);
        }

        // Verificar se o usuário já está inscrito no evento
        $existingInscricao = Inscricao::where('usuarios_id', $userId)
            ->where('eventos_id', $event_id)
            ->first();

        if ($existingInscricao) {
            return response()->json(['message' => 'Usuário já inscrito neste evento.'], 409);
        }

        // Criar a inscrição
        $inscricao = Inscricao::create([
            'usuarios_id' => $userId,
            'eventos_id' => $event_id,
        ]);

        return response()->json([
            'message' => 'Inscrição realizada com sucesso!',
            'inscricao' => $inscricao,
        ], 201);
    }
}
