<?php
// app/Models/Joueur.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Joueur extends Model
{
    use HasFactory;
    protected $fillable = ['idEquipe', 'nom', 'numero', 'poste'];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'idEquipe');
    }
}
