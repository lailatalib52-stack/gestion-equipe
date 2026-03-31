<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Equipe;
use App\Models\Joueur;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $barca = Equipe::create(['nom' => 'FC Barcelona',  'ville' => 'Barcelone']);
        $real  = Equipe::create(['nom' => 'Real Madrid',   'ville' => 'Madrid']);
        $psg   = Equipe::create(['nom' => 'PSG',           'ville' => 'Paris']);

        $data = [
            // Barcelona
            [$barca->id, 'Marc-André ter Stegen', 1,  'Gardien'],
            [$barca->id, 'Ronald Araújo',         4,  'Défenseur'],
            [$barca->id, 'Pedri',                 8,  'Milieu'],
            [$barca->id, 'Robert Lewandowski',    9,  'Attaquant'],
            [$barca->id, 'Lamine Yamal',          27, 'Attaquant'],
            // Real Madrid
            [$real->id,  'Thibaut Courtois',      1,  'Gardien'],
            [$real->id,  'Éder Militão',          3,  'Défenseur'],
            [$real->id,  'Luka Modrić',           10, 'Milieu'],
            [$real->id,  'Vinícius Júnior',       7,  'Attaquant'],
            // PSG
            [$psg->id,   'Gianluigi Donnarumma',  99, 'Gardien'],
            [$psg->id,   'Marquinhos',            5,  'Défenseur'],
            [$psg->id,   'Vitinha',               17, 'Milieu'],
            [$psg->id,   'Ousmane Dembélé',       10, 'Attaquant'],
        ];

        foreach ($data as [$idEquipe, $nom, $numero, $poste]) {
            Joueur::create(compact('idEquipe', 'nom', 'numero', 'poste'));
        }
    }
}
