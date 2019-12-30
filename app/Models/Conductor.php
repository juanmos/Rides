<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoVehiculo;

class Conductor extends Model
{
    use SoftDeletes;

    protected $fillable=['marca','modelo','placa','color','saldo','calificacion','capacidad','tipo_vehiculo_id','ano','propio','usuario_crea_id'];

    public function tipo_vehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'tipo_vehiculo_id');
    }
}
