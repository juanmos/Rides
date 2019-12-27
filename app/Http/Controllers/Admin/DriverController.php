<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoVehiculo;
use App\Models\Conductor;
use App\Models\User;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::where('conductor_id', '>', 0)->orderBy('nombre')->with(['conductor'])->paginate(50);
        return view('driver.index', compact('drivers'));
    }

    public function create()
    {
        $driver = null;
        $tipos = TipoVehiculo::orderBy('tipo_vehiculo')->get()->pluck('tipo_vehiculo', 'id');
        return view('driver.form', compact('driver', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email|unique:App\Models\User,email',
            'telefono'=>'required|numeric',
            'marca'=>'required',
            'modelo'=>'required',
            'placa'=>'required',
            'color'=>'required'
        ]);
        $data = $request->except(['foto']);
        $data['usuario_crea_id']=auth()->user()->id;
        
        $conductor = Conductor::create($data);
        $data['conductor_id']=$conductor->id;
        $data['password']=bcrypt('123456');
        $user = User::create($data);
        $user->assignRole('Conductores');
        if ($request->has('foto')) {
            $user->foto=$request->file('foto')->store('public/usuarios');
            $user->save();
        }
        return redirect()->route('driver.show', $user->id);
    }
}
