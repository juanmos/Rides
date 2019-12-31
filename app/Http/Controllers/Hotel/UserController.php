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
        return view('user.form',compact('user','hotel'));
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
        $hotel->usuarios()->create($request->all());
        return redirect()->route('hotel.show',$hotel->id);
    }

    public function edit(Hotel $hotel,User $user)
    {
        return view('user.form',compact('hotel','user'));
    }

    public function update(Request $request, Hotel $hotel, User $user)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email',
            'telefono'=>'required',
            'password'=>'required'
        ]);
        $user->update($request->except(['email']));
        return redirect()->route('hotel.show',$hotel->id);
    }

    public function destroy(Request $request, Hotel $hotel, User $user)
    {
        $user->delete();
        return redirect()->route('hotel.show',$hotel->id);
    }
}
