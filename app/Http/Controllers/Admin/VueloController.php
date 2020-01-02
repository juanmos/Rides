<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aerolinea;
use App\Models\Vuelo;

class VueloController extends Controller
{
    public function create(Aerolinea $aerolinea)
    {
        $vuelo = null;
        return view('vuelo.form', compact('vuelo', 'aerolinea'));
    }

    public function store(Request $request, Aerolinea $aerolinea)
    {
        $request->validate([
            'vuelo'=>'required',
            'origen'=>'required',
            'destino'=>'required',
            'hora_salida'=>'required',
            'hora_llegada'=>'required',
        ]);
        $data=$request->all();
        $aerolinea->vuelos()->create($data);
        return redirect()->route('admin.aerolinea.index');
    }

    public function edit(Aerolinea $aerolinea, Vuelo $vuelo)
    {
        return view('vuelo.form', compact('vuelo', 'aerolinea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aerolinea $aerolinea, Vuelo $vuelo)
    {
        $vuelo->update(['lunes'=>0,'martes'=>0,'miercoles'=>0,'jueves'=>0,'viernes'=>0,'sabado'=>0,'domingo'=>0]);
        $vuelo->update($request->all());
        return redirect()->route('admin.aerolinea.index');
    }

    public function destroy(Aerolinea $aerolinea, Vuelo $vuelo)
    {
        $vuelo->delete();
        return redirect()->route('admin.aerolinea.index');
    }
}
