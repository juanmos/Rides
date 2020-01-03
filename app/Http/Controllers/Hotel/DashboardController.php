<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class DashboardController extends Controller
{
    public function index()
    {
        $hotel = Hotel::find(auth()->user()->hotel_id);
        return view('hotel.show', compact('hotel'));
    }
}
