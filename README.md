# ⚽ FootManager — Laravel (Blade uniquement, sans React)

Application web complète avec interface **views Blade**, sans aucun framework JS.

---

## 📁 Arborescence des fichiers à créer

```
app/
  Http/Controllers/
    JoueurController.php
    EquipeController.php
  Models/
    Joueur.php
    Equipe.php

database/
  migrations/
    2024_01_01_000001_create_equipes_table.php
    2024_01_01_000002_create_joueurs_table.php
  seeders/
    DatabaseSeeder.php

resources/
  views/
    layouts/
      app.blade.php          ← Layout principal (nav, CSS)
    joueurs/
      index.blade.php        ← Liste + recherche par nom
      create.blade.php       ← Formulaire création
      edit.blade.php         ← Formulaire modification
    equipes/
      index.blade.php        ← Liste équipes
      show.blade.php         ← Joueurs d'une équipe ✓
      form.blade.php         ← Création / modification équipe

routes/
  web.php                    ← Toutes les routes
```

---

## ⚙️ Installation pas à pas

```bash
# 1. Créer le projet
composer create-project laravel/laravel joueurs-app
cd joueurs-app

# 2. Copier tous les fichiers du projet

# 3. Configurer .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=joueurs_db
DB_USERNAME=root
DB_PASSWORD=

# 4. Créer la base
mysql -u root -e "CREATE DATABASE joueurs_db;"

# 5. Migrations + données de test
php artisan migrate --seed

# 6. Lancer
php artisan serve
# → http://localhost:8000
```

---

## 🌐 Pages disponibles

| URL                        | Description                                    |
|----------------------------|------------------------------------------------|
| `/joueurs`                 | ✅ Liste tous les joueurs (CRUD)               |
| `/joueurs?search=Pedri`    | ✅ **Exercice 4** — Recherche par nom          |
| `/joueurs/create`          | ✅ Formulaire ajout joueur                     |
| `/joueurs/{id}/edit`       | ✅ Formulaire modification joueur              |
| `/equipes`                 | ✅ Liste toutes les équipes                    |
| `/equipes/{id}`            | ✅ **Exercice 2** — Joueurs d'une équipe       |
| `/equipes/create`          | ✅ Formulaire ajout équipe                     |

---

## ✅ Couverture de l'exercice

| Exercice | Implémentation |
|----------|---------------|
| 1. CRUD joueurs (4 opérations) | GET/POST/PUT/DELETE via `Route::resource` |
| 2. Joueurs d'une équipe via idEquipe | `GET /equipes/{id}` → `EquipeController@show` |
| 3. Équipe d'un joueur | Affiché dans la colonne "Équipe" de `/joueurs` avec lien cliquable |
| 4. Chercher un joueur par nom | `GET /joueurs?search=...` → barre de recherche dans l'index |

---

## 🎨 Interface

- **100% Blade** — aucun React, Vue, ni framework JS
- CSS vanilla intégré dans le layout `app.blade.php`
- Thème sombre, typographie Barlow (Google Fonts)
- Badges colorés par poste (Gardien, Défenseur, Milieu, Attaquant)
- Messages flash (succès / erreur) après chaque action
