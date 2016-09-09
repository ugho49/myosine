<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarif';

    protected $primaryKey = 'id_tarif';

    public $timestamps = false;

    protected $fillable = [
        'nom_tarif', 'prix_tarif', 'prixEtu_tarif',
    ];
}
