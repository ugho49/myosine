<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoraireCours extends Model
{
    protected $table = 'horaires_cours';

    protected $primaryKey = 'id_cours';

    public $timestamps = false;

    protected $fillable = ['jour_cours', 'num_jour', 'debut_cours', 'fin_cours', 'id_typeC'];
    protected $appends = ['type'];

    public function getTypeAttribute() {
        return TypeCours::find($this->id_typeC);
    }
}
