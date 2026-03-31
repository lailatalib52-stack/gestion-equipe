@extends('layouts.app')
@section('title', 'Joueurs')

@section('content')

{{-- Stats --}}
<div class="stats">
    <div class="stat-card">
        <div class="stat-label">Total joueurs</div>
        <div class="stat-value">{{ $totalJoueurs }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Équipes</div>
        <div class="stat-value">{{ $totalEquipes }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Gardiens</div>
        <div class="stat-value">{{ $totalGardiens }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Défenseurs</div>
        <div class="stat-value">{{ $totalDefenseurs }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Milieux</div>
        <div class="stat-value">{{ $totalMilieux }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Attaquants</div>
        <div class="stat-value">{{ $totalAttaquants }}</div>
    </div>
</div>

{{-- Header --}}
<div class="page-header">
    <h1 class="page-title">Liste des <span>Joueurs</span></h1>
    <a href="{{ route('joueurs.create') }}" class="btn btn-primary">+ Nouveau joueur</a>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('joueurs.index') }}" class="search-bar">
    <input type="text" name="search" placeholder="Rechercher un joueur par nom…" value="{{ request('search') }}">
    <button type="submit" class="btn btn-ghost">Rechercher</button>
    @if(request('search'))
        <a href="{{ route('joueurs.index') }}" class="btn btn-ghost">✕ Effacer</a>
    @endif
</form>

{{-- Table --}}
<div class="card">
    @if($joueurs->isEmpty())
        <div class="empty">
            <div class="empty-icon">🔍</div>
            <p>Aucun joueur trouvé.</p>
        </div>
    @else
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>N°</th>
                <th>Poste</th>
                <th>Équipe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($joueurs as $joueur)
            <tr>
                <td style="color:var(--muted); font-size:.8rem;">{{ $joueur->id }}</td>
                <td style="font-weight:500; color:var(--text);">{{ $joueur->nom }}</td>
                <td><span class="num-chip">{{ $joueur->numero }}</span></td>
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
                    @if($joueur->equipe)
                        <a href="{{ route('equipes.show', $joueur->equipe->id) }}"
                           style="color:var(--green); text-decoration:none; font-size:.88rem;">
                            {{ $joueur->equipe->nom }}
                        </a>
                    @else
                        <span style="color:var(--muted);">—</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex; gap:.4rem; align-items:center;">
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

@endsection
