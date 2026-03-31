@extends('layouts.app')
@section('title', 'Équipes')

@section('content')

<div class="page-header">
    <h1 class="page-title">Nos <span>Équipes</span></h1>
    <a href="{{ route('equipes.create') }}" class="btn btn-primary">+ Nouvelle équipe</a>
</div>

<div class="card">
    @if($equipes->isEmpty())
        <div class="empty">
            <div class="empty-icon">🛡️</div>
            <p>Aucune équipe enregistrée.</p>
        </div>
    @else
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Ville</th>
                <th>Joueurs</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipes as $equipe)
            <tr>
                <td style="color:var(--muted); font-size:.8rem;">{{ $equipe->id }}</td>
                <td style="font-weight:500; color:var(--text);">{{ $equipe->nom }}</td>
                <td>{{ $equipe->ville ?? '—' }}</td>
                <td>
                    <span class="badge badge-default">{{ $equipe->joueurs->count() }} joueurs</span>
                </td>
                <td>
                    <div style="display:flex; gap:.4rem;">
                        <a href="{{ route('equipes.show', $equipe->id) }}" class="btn btn-ghost btn-sm">Voir effectif</a>
                        <a href="{{ route('equipes.edit', $equipe->id) }}" class="btn btn-ghost btn-sm">Modifier</a>
                        <form class="delete-form" method="POST" action="{{ route('equipes.destroy', $equipe->id) }}"
                              onsubmit="return confirm('Supprimer {{ $equipe->nom }} ?')">
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
