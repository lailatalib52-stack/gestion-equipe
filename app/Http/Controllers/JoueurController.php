<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use App\Models\Equipe;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    /** GET /joueurs */
    public function index(Request $request)
    {
        $query = Joueur::with('equipe');

        // Exercice 4 – chercher par nom
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        $joueurs = $query->orderBy('nom')->get();

        return view('joueurs.index', [
            'joueurs'        => $joueurs,
            'totalJoueurs'   => Joueur::count(),
            'totalEquipes'   => Equipe::count(),
            'totalGardiens'  => Joueur::where('poste', 'Gardien')->count(),
            'totalDefenseurs'=> Joueur::where('poste', 'Défenseur')->count(),
            'totalMilieux'   => Joueur::where('poste', 'Milieu')->count(),
            'totalAttaquants'=> Joueur::where('poste', 'Attaquant')->count(),
        ]);
    }

    /** GET /joueurs/create */
    public function create()
    {
        return view('joueurs.create', ['equipes' => Equipe::orderBy('nom')->get()]);
    }

    /** POST /joueurs */
    public function store(Request $request)
    {
        $request->validate([
            'idEquipe' => 'required|exists:equipes,id',
            'nom'      => 'required|string|max:255',
            'numero'   => 'required|integer|min:1|max:99',
            'poste'    => 'required|in:Gardien,Défenseur,Milieu,Attaquant',
        ]);

        Joueur::create($request->only('idEquipe','nom','numero','poste'));

        return redirect()->route('joueurs.index')->with('success', 'Joueur créé avec succès.');
    }

    /** GET /joueurs/{id}/edit */
    public function edit(int $id)
    {
        return view('joueurs.edit', [
            'joueur'  => Joueur::findOrFail($id),
            'equipes' => Equipe::orderBy('nom')->get(),
        ]);
    }

    /** PUT /joueurs/{id} */
    public function update(Request $request, int $id)
    {
        $joueur = Joueur::findOrFail($id);

        $request->validate([
            'idEquipe' => 'required|exists:equipes,id',
            'nom'      => 'required|string|max:255',
            'numero'   => 'required|integer|min:1|max:99',
            'poste'    => 'required|in:Gardien,Défenseur,Milieu,Attaquant',
        ]);

        $joueur->update($request->only('idEquipe','nom','numero','poste'));

        return redirect()->route('joueurs.index')->with('success', 'Joueur mis à jour.');
    }

    /** DELETE /joueurs/{id} */
    public function destroy(int $id)
    {
        Joueur::findOrFail($id)->delete();
        return back()->with('success', 'Joueur supprimé.');
    }
}
