<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TypePraticien extends Model {
    protected $table = 'type_praticien';
    protected $primaryKey = 'id_type_praticien';
    public $timestamps = false;
}
