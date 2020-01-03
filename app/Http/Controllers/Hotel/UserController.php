<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\User;

class UserController extends Controller
{
    public function create(Hotel $hotel)
    {
        $user=null;
        return view('user.form', compact('user', 'hotel'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email|unique:App\Models\User,email',
            'telefono'=>'required',
            'password'=>'required'
        ]);
        $data=$request->all();
        $data['password']=bcrypt($request->get('password'));
        $user=$hotel->usuarios()->create($data);
        if ($request->has('foto')) {
            $user->foto=$request->file('foto')->store('public/usuarios');
            $user->save();
        }
        $user->assignRole('Hoteles');
        return redirect()->route('hotel.show', $hotel->id);
    }

    public function edit(Hotel $hotel, User $user)
    {
        return view('user.form', compact('hotel', 'user'));
    }

    public function update(Request $request, Hotel $hotel, User $user)
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

        return redirect()->route('hotel.show', $hotel->id);
    }

    public function destroy(Request $request, Hotel $hotel, User $user)
    {
        $user->delete();
        return redirect()->route('hotel.show', $hotel->id);
    }
}
