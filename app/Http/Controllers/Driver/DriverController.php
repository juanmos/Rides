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

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email',
            'telefono'=>'required|numeric',
            'marca'=>'required',
            'modelo'=>'required',
            'placa'=>'required',
            'color'=>'required'
        ]);
        $data = $request->except(['foto']);
        $conductor = User::find($id)->conductor()->update($request->only(['marca','modelo','placa','color','tipo_vehiculo_id','capacidad','ano','propio']));
        $user = User::find($id);
        $user->update($data);
        if($request->has('foto')){
            $user->foto=$request->file('foto')->store('public/usuarios');
            $user->save();
        }
        return redirect()->route('driver.show', $user->id);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->conductor()->delete();
        $user->delete();
        return redirect()->route('admin.drivers.index');
    }
}
