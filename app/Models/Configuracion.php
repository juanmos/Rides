<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;

class Configuracion extends Model
{
    protected $fillable=['empresa_id','configuraciones'];
    protected $casts = [
        'configuraciones' => 'array',
    ];
    
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
