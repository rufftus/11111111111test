<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Praticien extends Model
{
protected $table = 'praticien';
protected $primaryKey = 'id_praticien';
public $timestamps = false;

public function typePraticien() {
return $this->belongsTo(TypePraticien::class, 'id_type_praticien', 'id_type_praticien');
}

public function specialites() {
return $this->belongsToMany(Specialite::class, 'posseder', 'id_praticien', 'id_specialite')
->withPivot('diplome', 'coef_prescription');
}

public function activites() {
return $this->belongsToMany(ActiviteCompl::class, 'inviter', 'id_praticien', 'id_activite_compl')
->withPivot('specialiste');
}
}
?>
