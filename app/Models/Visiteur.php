<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    protected $table = 'visiteur'; // Le nom de ta table si ce n’est pas "visiteurs"
    protected $primaryKey = 'id_visiteur'; // Clé primaire personnalisée
    public $timestamps = false; // Si ta table ne contient pas created_at et updated_at

    // Si tu veux autoriser les champs à être remplis automatiquement
    protected $fillable = [
        'id_visiteur',
        'login',
        'pwd_visiteur',
        // ajoute d'autres champs si nécessaire
    ];
}
