<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('nombre')->paginate(50);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=null;
        $roles = Role::orderBy('name')->get()->pluck('name', 'name');

        return view('user.form', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email|unique:App\Models\User,email',
            'telefono'=>'required',
            'password'=>'required'
        ]);

        $usuario = User::create($request->except(['foto']));
        if ($request->has('foto')) {
            $usuario->foto=$request->file('foto')->store('public/usuarios');
            $usuario->save();
        }
        if ($request->has('password')) {
            $usuario->password=\bcrypt($request->get('password'));
            $usuario->save();
        }

        $usuario->syncRoles($request->get('role'));
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get()->pluck('name', 'name');
        return view('user.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email',
            'telefono'=>'required'
        ]);
        $user->update($request->except(['foto','password']));
        if ($request->has('foto')) {
            $user->foto=$request->file('foto')->store('public/usuarios');
            $user->save();
        }
        if ($request->has('password') && $request->get('password')!=null) {
            $user->password=\bcrypt($request->get('password'));
            $user->save();
        }

        $user->syncRoles($request->get('role'));
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        foreach ($user->getRoleNames() as $role) {
            $user->removeRole($role);
        }
        
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
