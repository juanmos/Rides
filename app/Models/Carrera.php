<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aerolinea;
use App\Models\Vuelo;
use App\Models\FormaPago;
use App\Models\Estado;
use App\Models\User;

class Carrera extends Model
{
    use SoftDeletes;

    protected $fillable=['estado_id','usuario_id','conductor_id','forma_pago_id','fecha','hora','vuelo','lugar_arribo','personas','destino','latitud','longitud','aerolinea_id','vuelo_id','costo','comision','factura','compartido','maletas','sentido','calificacion','nombre'];

    public function usuario(){
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function conductor(){
        return $this->belongsTo(User::class,'conductor_id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class,'estado_id');
    }

    public function aerolinea(){
        return $this->belongsTo(Aerolinea::class,'aerolinea_id');
    }

    public function vuelo(){
        return $this->belongsTo(Vuelo::class,'vuelo_id');
    }

    public function formaPago(){
        return $this->belongsTo(FormaPago::class,'forma_pago_id');
    }
}
