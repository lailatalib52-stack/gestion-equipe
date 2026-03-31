@extends('layouts.app')
@section('title', $equipe->nom)

@section('content')

<div class="page-header">
    <div>
        <p style="font-size:.8rem; color:var(--muted); letter-spacing:1px; text-transform:uppercase; margin-bottom:.3rem;">
            Équipe
        </p>
        <h1 class="page-title" style="font-size:2.4rem;">{{ $equipe->nom }}
            @if($equipe->ville)
                <span style="font-size:1rem; color:var(--muted); font-weight:400; text-transform:none; letter-spacing:0;">
                    — {{ $equipe->ville }}
                </span>
            @endif
        </h1>
    </div>
    <div style="display:flex; gap:.5rem;">
        <a href="{{ route('equipes.edit', $equipe->id) }}" class="btn btn-ghost">Modifier</a>
        <a href="{{ route('equipes.index') }}" class="btn btn-ghost">← Équipes</a>
    </div>
</div>

{{-- Stat --}}
<div style="margin-bottom:1.5rem;">
    <span style="color:var(--muted); font-size:.85rem;">
        {{ $equipe->joueurs->count() }} joueur(s) dans cette équipe
    </span>
</div>

<div class="card">
    @if($equipe->joueurs->isEmpty())
        <div class="empty">
            <div class="empty-icon">👤</div>
            <p>Aucun joueur dans cette équipe.</p>
        </div>
    @else
    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Poste</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipe->joueurs->sortBy('numero') as $joueur)
            <tr>
                <td><span class="num-chip">{{ $joueur->numero }}</span></td>
                <td style="font-weight:500; color:var(--text);">{{ $joueur->nom }}</td>
                <td>
                    @php
                        $map = [
                            'Gardien'   => 'badge-gk',
                            'Défenseur' => 'badge-def',
                            'Milieu'    => 'badge-mid',
                            'Attaquant' => 'badge-att',
                        ];
                        $cls = $map[$joueur->poste] ?? 'badge-default';
                    @endphp
                    <span class="badge {{ $cls }}">{{ $joueur->poste }}</span>
                </td>
                <td>
                    <div style="display:flex; gap:.4rem;">
                        <a href="{{ route('joueurs.edit', $joueur->id) }}" class="btn btn-ghost btn-sm">Modifier</a>
                        <form class="delete-form" method="POST" action="{{ route('joueurs.destroy', $joueur->id) }}"
                              onsubmit="return confirm('Supprimer {{ $joueur->nom }} ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<div style="margin-top:1rem;">
    <a href="{{ route('joueurs.create') }}" class="btn btn-primary">+ Ajouter un joueur</a>
</div>

@endsection
