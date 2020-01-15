<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aerolinea;
use App\Models\Vuelo;
use App\Models\FormaPago;
use App\Models\Ciudad;
use App\Models\Empresa;
use App\Models\Estado;
use App\Models\User;

class Carrera extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'empresa_id',
        'estado_id',
        'usuario_id',
        'conductor_id',
        'forma_pago_id',
        'fecha',
        'hora',
        'direccion',
        'referencia',
        'destino',
        'latitud',
        'longitud',
        'latitud_destino',
        'longitud_destino',
        'inicio',
        'costo',
        'comision',
        'calificacion_usuario',
        'calificacion_conductor',
        'hora_aceptacion',
        'hora_llegada',
        'hora_abordaje',
        'hora_terminacion',
        'hora_cancelacion',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function conductor()
    {
        return $this->belongsTo(User::class, 'conductor_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function aerolinea()
    {
        return $this->belongsTo(Aerolinea::class, 'aerolinea_id');
    }

    public function vuelo()
    {
        return $this->belongsTo(Vuelo::class, 'vuelo_id');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    public function scopeCloseTo($query, $latitude, $longitude)
    {
        return $query->whereRaw("
            ST_Distance_Sphere(
                    point(longitud, latitud),
                    point(?, ?)
                ) * .000621371192 < 5
            ", [
                $longitude,
                $latitude,
            ]);
    }

    public function scopeCreada($query)
    {
        return $query->whereIn('estado_id', [1]);
    }
}
