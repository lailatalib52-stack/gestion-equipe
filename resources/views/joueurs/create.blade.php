@extends('layouts.app')
@section('title', 'Nouveau joueur')

@section('content')

<div class="page-header">
    <h1 class="page-title">Nouveau <span>Joueur</span></h1>
    <a href="{{ route('joueurs.index') }}" class="btn btn-ghost">← Retour</a>
</div>

<div class="card" style="max-width:580px;">
    <div class="card-body">
        <form method="POST" action="{{ route('joueurs.store') }}">
            @csrf

            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Nom complet</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Ex : Karim Benzema" required>
                    @error('nom') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Numéro de maillot</label>
                    <input type="number" name="numero" value="{{ old('numero') }}" placeholder="Ex : 9" min="1" max="99" required>
                    @error('numero') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Poste</label>
                    <select name="poste" required>
                        <option value="">— Choisir —</option>
                        @foreach(['Gardien','Défenseur','Milieu','Attaquant'] as $p)
                            <option value="{{ $p }}" {{ old('poste') == $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                    @error('poste') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group" style="grid-column:1/-1;">
                    <label>Équipe</label>
                    <select name="idEquipe" required>
                        <option value="">— Choisir une équipe —</option>
                        @foreach($equipes as $equipe)
                            <option value="{{ $equipe->id }}" {{ old('idEquipe') == $equipe->id ? 'selected' : '' }}>
                                {{ $equipe->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('idEquipe') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div style="display:flex; gap:.6rem; margin-top:.5rem;">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('joueurs.index') }}" class="btn btn-ghost">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
