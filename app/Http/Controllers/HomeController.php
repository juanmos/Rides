<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        if(auth()->user()->hasRole('Administradores')){
            return redirect()->route('admin.index');
        }
        else if(auth()->user()->hasRole('Conductores')){
            return redirect()->route('driver.index');
        }
        else if(auth()->user()->hasRole('Hoteles')){
            return redirect()->route('hotel.dashboard');
        }
        else if(auth()->user()->hasRole('Usuarios')){
            return redirect()->route('user.index');
        }
        abort(404);
    }
}
