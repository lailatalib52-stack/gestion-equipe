@extends('layouts.app')
@section('title', isset($equipe) ? 'Modifier ' . $equipe->nom : 'Nouvelle équipe')

@section('content')

<div class="page-header">
    <h1 class="page-title">
        @isset($equipe)
            Modifier <span>{{ $equipe->nom }}</span>
        @else
            Nouvelle <span>Équipe</span>
        @endisset
    </h1>
    <a href="{{ route('equipes.index') }}" class="btn btn-ghost">← Retour</a>
</div>

<div class="card" style="max-width:480px;">
    <div class="card-body">
        <form method="POST" action="{{ isset($equipe) ? route('equipes.update', $equipe->id) : route('equipes.store') }}">
            @csrf
            @isset($equipe) @method('PUT') @endisset

            <div class="form-group">
                <label>Nom de l'équipe</label>
                <input type="text" name="nom" value="{{ old('nom', $equipe->nom ?? '') }}"
                       placeholder="Ex : AS Monaco" required>
                @error('nom') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Ville <span style="color:var(--muted); font-size:.75em;">(optionnel)</span></label>
                <input type="text" name="ville" value="{{ old('ville', $equipe->ville ?? '') }}"
                       placeholder="Ex : Monaco">
                @error('ville') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div style="display:flex; gap:.6rem; margin-top:.5rem;">
                <button type="submit" class="btn btn-primary">
                    {{ isset($equipe) ? 'Mettre à jour' : 'Créer' }}
                </button>
                <a href="{{ route('equipes.index') }}" class="btn btn-ghost">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
