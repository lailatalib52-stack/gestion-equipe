<?php
// app/Models/Equipe.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipe extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'ville'];

    public function joueurs()
    {
        return $this->hasMany(Joueur::class, 'idEquipe');
    }
}
