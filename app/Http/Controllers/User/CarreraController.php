<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Models\User;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = auth()->user()->carreras()->get();
        return view('carrera.user', compact('carreras'));
    }
}
