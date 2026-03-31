<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\EquipeController;

// Page d'accueil → liste des joueurs
Route::get('/', fn() => redirect()->route('joueurs.index'));

// ── CRUD Joueurs (exercice 1 + recherche par nom exercice 4) ──────────────
Route::resource('joueurs', JoueurController::class)
     ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

// ── CRUD Équipes + affichage joueurs d'une équipe (exercice 2) ────────────
Route::resource('equipes', EquipeController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
