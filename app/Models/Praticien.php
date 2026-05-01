<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Praticien extends Model
{
    protected $table = 'praticien';
    protected $primaryKey = 'id_praticien';
    public $timestamps = false;
    protected $fillable = ['id_type_praticien', 'nom_praticien', 'prenom_praticien', 'adresse_praticien', 'cp_praticien', 'ville_praticien', 'coef_notoriete'];

    public function typePraticien()
    {
        return $this->belongsTo(TypePraticien::class, 'id_type_praticien', 'id_type_praticien');
    }

    public function specialites()
    {
        return $this->belongsToMany(Specialite::class, 'posseder', 'id_praticien', 'id_specialite')
            ->withPivot('diplome', 'coef_prescription');
    }
}
