<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aerolinea;

class Vuelo extends Model
{
    protected $fillable=['aerolinea_id','vuelo','origen','destino','hora_salida','hora_llegada','lunes','martes','miercoles','jueves','viernes','sabado','domingo'];

    public function aerolinea(){
        return $this->belongsTo(Aerolinea::class,'aerolinea_id');
    }
}
