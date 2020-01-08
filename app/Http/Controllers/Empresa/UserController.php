<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Empresa;
use App\Models\User;

class UserController extends Controller
{
    public function create(Empresa $empresa)
    {
        $user=null;
        $roles = Role::whereIn('name', ['Operadores','Conductores'])->orderBy('name')->get()->pluck('name', 'name');
        return view('user.form', compact('user', 'empresa', 'roles'));
    }

    public function store(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email|unique:App\Models\User,email',
            'telefono'=>'required',
            'password'=>'required',
            'role'=>'required|in:Operadores,Conductores'
        ]);
        $data=$request->all();
        $data['password']=bcrypt($request->get('password'));
        $user=$empresa->usuarios()->create($data);
        if ($request->has('foto')) {
            $user->foto=$request->file('foto')->store('public/usuarios');
            $user->save();
        }
        $user->assignRole($request->get('role'));
        return redirect()->route('empresa.show', $empresa->id);
    }
}
