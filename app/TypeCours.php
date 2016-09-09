<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCours extends Model
{
    protected $table = 'type_cours';

    protected $primaryKey = 'id_typeC';

    public $timestamps = false;

    protected $fillable = ['libelle_typeC'];
}
