<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aerolinea;

class AerolineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aerolineas = Aerolinea::orderBy('aerolinea')->with(['vuelos'])->paginate(50);
        return view('aerolinea.index', compact('aerolineas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aerolinea = null;
        return view('aerolinea.form', compact('aerolinea'));
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
            'aerolinea'=>'required'
        ]);
        $aerolinea = Aerolinea::create($request->all());
        return redirect()->route('admin.aerolinea.index');
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
    public function edit(Aerolinea $aerolinea)
    {
        return view('aerolinea.form', compact('aerolinea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aerolinea $aerolinea)
    {
        $request->validate([
            'aerolinea'=>'required'
        ]);
        $aerolinea->update($request->all());
        return redirect()->route('admin.aerolinea.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aerolinea $aerolinea)
    {
        $aerolinea->delete();
        return redirect()->route('admin.aerolinea.index');
    }
}
