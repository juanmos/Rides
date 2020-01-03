<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Administradores')) {
            return redirect()->route('admin.index');
        } elseif (auth()->user()->hasRole('Conductores')) {
            return redirect()->route('driver.index');
        } elseif (auth()->user()->hasRole('Hoteles')) {
            return redirect()->route('hotel.dashboard');
        } elseif (auth()->user()->hasRole('Usuarios')) {
            return redirect()->route('user.index');
        }
        abort(404);
    }
}
