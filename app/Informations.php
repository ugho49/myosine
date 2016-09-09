<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    protected $table = 'informations';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['nom_salle', 'tel_salle', 'adresse_salle', 'mail_salle'];
}
