@extends('layouts.app')
@section('title', 'Modifier ' . $joueur->nom)

@section('content')

<div class="page-header">
    <h1 class="page-title">Modifier <span>{{ $joueur->nom }}</span></h1>
    <a href="{{ route('joueurs.index') }}" class="btn btn-ghost">← Retour</a>
</div>

<div class="card" style="max-width:580px;">
    <div class="card-body">
        <form method="POST" action="{{ route('joueurs.update', $joueur->id) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Nom complet</label>
                    <input type="text" name="nom" value="{{ old('nom', $joueur->nom) }}" required>
                    @error('nom') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Numéro de maillot</label>
                    <input type="number" name="numero" value="{{ old('numero', $joueur->numero) }}" min="1" max="99" required>
                    @error('numero') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Poste</label>
                    <select name="poste" required>
                        @foreach(['Gardien','Défenseur','Milieu','Attaquant'] as $p)
                            <option value="{{ $p }}" {{ old('poste', $joueur->poste) == $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                    @error('poste') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group" style="grid-column:1/-1;">
                    <label>Équipe</label>
                    <select name="idEquipe" required>
                        @foreach($equipes as $equipe)
                            <option value="{{ $equipe->id }}" {{ old('idEquipe', $joueur->idEquipe) == $equipe->id ? 'selected' : '' }}>
                                {{ $equipe->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('idEquipe') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div style="display:flex; gap:.6rem; margin-top:.5rem;">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('joueurs.index') }}" class="btn btn-ghost">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
