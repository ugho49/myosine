<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bandeau extends Model
{
    protected $table = 'bandeau';

    protected $primaryKey = 'id_sb';

    public $timestamps = false;

    protected $fillable = ['libelle_sb', 'date_create_sb', 'date_fin_sb'];
}
