<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    protected $fillable =['tipo_vehiculo','precio_simple','precio_compartido','comision_simple','comision_compartido'];
}
