<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artigo;
use Illuminate\Validation\Rule;

class ArtigosController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $artigos = Artigo::with('usuario', 'comentarios.usuario')->get();
        if ($artigos->isEmpty()) {
            return response()->json([], 404);
        }

        return response()->json($artigos);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('artigos.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string',
            'descricao_curta' => 'required|string|max:255',
            'descricao' => 'required|string',
            'categoria' => 'required|string',
            'link' => 'required|string',
            'foto' => 'nullable|string',
            'usuarios_id' => 'required|integer|exists:usuarios,id',
        ]);

        $validatedData["usuarios_id"] = $request->user()->id;

        // Handle file upload if present
//        if ($request->hasFile('foto')) {
//            $path = $request->file('foto')->store('artigos', 'public');
//            $validatedData['foto'] = $path;
//        }

        try {
            $article = Artigo::create($validatedData);
            return response()->json($article, 201);
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
        $artigo = Artigo::with(['usuario', 'comentarios.usuario'])->findOrFail($id);

        if (!$artigo) {
            return response()->json(null, 404);
        }

        return response()->json($artigo);
    }

    // Show the form for editing the specified resource.
    public function edit(Artigo $artigo)
    {
        return view('artigos.edit', compact('artigo'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Artigo $artigo)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'descricao_curta' => 'required|string',
            'link' => 'required|string',
            'categoria' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'usuarios_id' => 'required|exists:usuarios,id',
        ]);

        // Handle file upload if present
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('artigos', 'public');
            $validatedData['foto'] = $path;
        }

        $artigo->update($validatedData);

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    // Remove the specified resource from storage.
    public function destroy(Artigo $artigo)
    {
        $artigo->delete();
        return redirect()->route('artigos.index')->with('success', 'Artigo excluído com sucesso!');
    }
}
