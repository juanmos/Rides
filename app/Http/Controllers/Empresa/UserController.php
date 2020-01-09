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

    public function show(Empresa $empresa, User $user)
    {
        return view('empresa.user', compact('user', 'empresa'));
    }

    public function edit(Empresa $empresa, User $user)
    {
        $roles = Role::whereIn('name', ['Operadores','Conductores'])->orderBy('name')->get()->pluck('name', 'name');
        return view('user.form', compact('empresa', 'roles', 'user'));
    }

    public function update(Request $request, Empresa $empresa, User $user)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email',
            'telefono'=>'required'
        ]);
        $user->update($request->except(['email','password','foto']));
        if ($request->has('password') && $request->get('password')!=null) {
            $user->password=\bcrypt($request->get('password'));
            $user->save();
        }
        if ($request->has('foto')) {
            $user->foto=$request->file('foto')->store('public/usuarios');
            $user->save();
        }

        return redirect()->route('empresa.show', $empresa->id);
    }

    public function destroy(Request $request, Empresa $empresa, User $user)
    {
        $user->delete();
        return redirect()->route('empresa.show', $empresa->id);
    }
}
