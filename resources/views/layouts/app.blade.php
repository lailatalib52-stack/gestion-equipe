<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestion des Joueurs')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:  #2d8a56; /* Plus sombre pour lisibilité sur fond blanc */
            --dark:   #f4f7f6; /* Fond de page gris très clair */
            --card:   #ffffff; /* Cartes blanches */
            --border: #e2e8f0; /* Bordures douces */
            --muted:  #718096; /* Texte secondaire */
            --text:   #2d3748; /* Texte principal sombre */
            --white:  #ffffff; 
            --accent: #edf2f7;
        }

        html { font-size: 16px; }
        body {
            background: var(--dark);
            color: var(--text);
            font-family: 'Barlow', sans-serif;
            font-weight: 400; /* Un peu plus épais pour la lisibilité sur fond clair */
            min-height: 100vh;
        }

        /* ── NAV ── */
        nav {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .nav-brand {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--green);
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
        }
        .nav-links { display: flex; gap: 0.25rem; }
        .nav-links a {
            color: var(--muted);
            text-decoration: none;
            padding: 0.4rem 0.9rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all .2s;
        }
        .nav-links a:hover, .nav-links a.active {
            color: var(--green);
            background: rgba(45,138,86,.08);
        }

        /* ── MAIN ── */
        main { max-width: 1100px; margin: 0 auto; padding: 2.5rem 1.5rem; }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid var(--border);
        }
        .page-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: var(--text); /* Changé de var(--white) */
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .page-title span { color: var(--green); }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            border-radius: 5px;
            font-family: 'Barlow', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all .2s;
        }
        .btn-primary { background: var(--green); color: white; }
        .btn-primary:hover { background: #24754a; transform: translateY(-1px); }
        .btn-danger  { background: transparent; color: #ff5252; border: 1px solid #ff525240; }
        .btn-danger:hover  { background: #ff525215; }
        .btn-ghost   { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-ghost:hover   { color: var(--text); border-color: var(--muted); }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.78rem; }

        /* ── ALERTS ── */
        .alert {
            padding: 0.85rem 1.1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .alert-success { background: rgba(56,161,105,.1); border: 1px solid rgba(56,161,105,.3); color: var(--green); }
        .alert-error   { background: rgba(255,82,82,.05); border: 1px solid rgba(255,82,82,.2);  color: #e53e3e; }

        /* ── CARDS ── */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .card-body { padding: 1.5rem; }

        /* ── TABLE ── */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: var(--accent); border-bottom: 2px solid var(--border); }
        thead th {
            padding: 0.9rem 1rem;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
        }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }
        tbody tr:hover { background: var(--accent); }
        tbody tr:last-child { border-bottom: none; }
        td { padding: 0.85rem 1rem; font-size: 0.9rem; vertical-align: middle; }

        /* ── BADGE ── */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 500;
            font-family: 'Barlow Condensed', sans-serif;
            letter-spacing: .5px;
        }
        .badge-gk  { background: rgba(255,193,7,.15);  color: #ffc107; }
        .badge-def { background: rgba(33,150,243,.15);  color: #42a5f5; }
        .badge-mid { background: rgba(156,39,176,.15);  color: #ce93d8; }
        .badge-att { background: rgba(255,82,82,.15);   color: #ff7070; }
        .badge-default { background: rgba(0,0,0,.05); color: var(--muted); }

        /* ── FORM ── */
        .form-group { margin-bottom: 1.3rem; }
        label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.45rem;
        }
        input, select {
            width: 100%;
            background: var(--dark);
            border: 1px solid var(--border);
            border-radius: 5px;
            color: var(--text);
            padding: 0.65rem 0.9rem;
            font-family: 'Barlow', sans-serif;
            font-size: 0.9rem;
            transition: border-color .2s;
            outline: none;
        }
        input:focus, select:focus { border-color: var(--green); box-shadow: 0 0 0 3px rgba(45,138,86,.1); }
        select option { background: white; }
        .form-error { color: #ff5252; font-size: 0.8rem; margin-top: 0.3rem; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        /* ── SEARCH BAR ── */
        .search-bar {
            display: flex; gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .search-bar input { max-width: 320px; }

        /* ── STATS ROW ── */
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.2rem 1.4rem;
        }
        .stat-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.72rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
        }
        .stat-value {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--green);
            line-height: 1.1;
            margin-top: 0.2rem;
        }

        /* ── NUMBER CHIP ── */
        .num-chip {
            display: inline-flex; align-items: center; justify-content: center;
            width: 32px; height: 32px;
            border-radius: 50%;
            background: var(--accent);
            border: 1px solid var(--border);
            color: var(--text);
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
        }

        /* ── EMPTY STATE ── */
        .empty {
            text-align: center;
            padding: 3rem;
            color: var(--muted);
        }
        .empty-icon { font-size: 3rem; margin-bottom: 0.8rem; }
        .empty p { font-size: 0.9rem; }

        /* ── DELETE FORM inline ── */
        .delete-form { display: inline; }

        @media (max-width: 700px) {
            .form-grid { grid-template-columns: 1fr; }
            .stats { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<nav>
    <a class="nav-brand" href="{{ route('joueurs.index') }}">⚽ FootManager</a>
    <div class="nav-links">
        <a href="{{ route('joueurs.index') }}" class="{{ request()->routeIs('joueurs.*') ? 'active' : '' }}">Joueurs</a>
        <a href="{{ route('equipes.index') }}" class="{{ request()->routeIs('equipes.*') ? 'active' : '' }}">Équipes</a>
    </div>
</nav>

<main>
    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
    @endif

    @yield('content')
</main>

</body>
</html>
