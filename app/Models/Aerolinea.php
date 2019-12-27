<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vuelo;

class Aerolinea extends Model
{
    protected $fillable=['aerolinea'];
    
    public $timestamps = false;
    
    public function vuelos(){
        return $this->hasMany(Vuelo::class,'aerolinea_id');
    }
}
