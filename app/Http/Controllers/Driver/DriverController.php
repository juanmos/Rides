<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoVehiculo;

use App\Models\User;
use App\Models\Conductor;

class DriverController extends Controller
{
    public function show($id = null)
    {
        if ($id==null) {
            $id=auth()->user()->id;
        }
        $driver = User::find($id);
        return view('driver.show', compact('driver'));
    }

    public function edit($id = null)
    {
        if ($id==null) {
            $id=auth()->user()->id;
        }
        $driver = User::find($id);
        $tipos = TipoVehiculo::orderBy('tipo_vehiculo')->get()->pluck('tipo_vehiculo', 'id');
        return view('driver.form', compact('driver', 'tipos'));
    }
}
