<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configuracion;
use App\Models\Ciudad;
use App\Models\User;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable=['nombre','ruc','direccion','telefono','costo','ciudad_id','activo',
                'pruebas','fecha_inicio','fecha_fin_pruebas','usuarios_permitidos'];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    public function configuracion()
    {
        return $this->hasOne(Configuracion::class, 'empresa_id');
    }

    public function conductores()
    {
        return $this->hasMany(User::class, 'empresa_id')->whereHas('roles', function ($query) {
            $query->where('name', 'Conductores');
        });
    }

    public function usuarios()
    {
        return $this->hasMany(User::class, 'empresa_id')->whereHas('roles', function ($query) {
            $query->where('name', 'Operadores');
        });
    }
}
