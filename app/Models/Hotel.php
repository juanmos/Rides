<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable=['nombre','direccion','email','telefono','web','facebook','latitud','longitud'];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'hotel_id');
    }
}
