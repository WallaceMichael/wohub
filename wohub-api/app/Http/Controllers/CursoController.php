<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
// Display a listing of the resource.
    public function index()
    {
        $cursos = Curso::with("usuario")->get();

        if ($cursos->isEmpty()) {
            return response()->json([], 404);
        }

        return response()->json($cursos);
    }

// Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:50',
            'descricao' => 'required|string|max:255',
            'categoria' => 'required|string|max:50',
            'link' => 'required|url',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

// Handle file upload if present
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('cursos', 'public');
            $validatedData['foto'] = $path;
        }

        Curso::create($validatedData);

        return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
    }

// Display the specified resource.
    public function show($id)
    {
        $curso = Curso::findOrFail($id);

        if (!$curso) {
            return response()->json(null, 404);
        }

        return response()->json($curso);
    }

    public function update(Request $request, Curso $curso)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:50',
            'descricao' => 'required|string|max:255',
            'categoria' => 'required|string|max:50',
            'link' => 'required|url',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('cursos', 'public');
            $validatedData['foto'] = $path;
        }

        $curso->update($validatedData);

        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso excluído com sucesso!');
    }
}
