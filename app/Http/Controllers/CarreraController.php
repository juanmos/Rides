<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\EnviarConductoresJob;
use App\Models\Empresa;
use App\Models\Carrera;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'empresa_id'=>'required|exists:App\Models\Empresa,id',
            'forma_pago_id'=>'required',
            'direccion'=>'required',
            'referencia'=>'required',
            'latitud'=>'required',
            'longitud'=>'required'
        ]);

        $data=$request->all();
        $data['fecha']=now()->toDateString();
        $data['hora']=now()->toTimeString();

        $carrera = auth()->user()->carreras()->create($data);
        EnviarConductoresJob::dispatch($carrera);
        return response()->json(compact('carrera'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
