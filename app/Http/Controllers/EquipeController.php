<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    /** GET /equipes */
    public function index()
    {
        $equipes = Equipe::withCount('joueurs')->orderBy('nom')->get();
        return view('equipes.index', compact('equipes'));
    }

    /** GET /equipes/create */
    public function create()
    {
        return view('equipes.form');
    }

    /** POST /equipes */
    public function store(Request $request)
    {
        $request->validate([
            'nom'   => 'required|string|max:255',
            'ville' => 'nullable|string|max:255',
        ]);

        Equipe::create($request->only('nom', 'ville'));
        return redirect()->route('equipes.index')->with('success', 'Équipe créée.');
    }

    /**
     * GET /equipes/{id}
     * Exercice 2 – joueurs d'une équipe via son id
     */
    public function show(int $id)
    {
        $equipe = Equipe::with('joueurs')->findOrFail($id);
        return view('equipes.show', compact('equipe'));
    }

    /** GET /equipes/{id}/edit */
    public function edit(int $id)
    {
        $equipe = Equipe::findOrFail($id);
        return view('equipes.form', compact('equipe'));
    }

    /** PUT /equipes/{id} */
    public function update(Request $request, int $id)
    {
        $equipe = Equipe::findOrFail($id);
        $request->validate([
            'nom'   => 'required|string|max:255',
            'ville' => 'nullable|string|max:255',
        ]);
        $equipe->update($request->only('nom', 'ville'));
        return redirect()->route('equipes.index')->with('success', 'Équipe mise à jour.');
    }

    /** DELETE /equipes/{id} */
    public function destroy(int $id)
    {
        Equipe::findOrFail($id)->delete();
        return redirect()->route('equipes.index')->with('success', 'Équipe supprimée.');
    }
}
