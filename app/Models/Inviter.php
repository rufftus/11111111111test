<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inviter extends Model
{
    protected $table = 'inviter';
    public $timestamps = false;

    // Ajoute ces deux lignes pour dire à Laravel qu'il n'y a pas d'ID unique simple
    protected $primaryKey = null;
    public $incrementing = false;
}
