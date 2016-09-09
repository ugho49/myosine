<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoraireOuverture extends Model
{
    protected $table = 'horaires_ouverture';

    protected $primaryKey = 'id_horaire';

    public $timestamps = false;

    protected $fillable = ['jour_horaire', 'num_jour', 'isMatin_horaire', 'debut_horaire', 'fin_horaire'];
}
