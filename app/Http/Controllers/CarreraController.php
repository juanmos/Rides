<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NuevaCarreraEvent;
use App\Jobs\EnviarConductoresJob;
use App\Models\Empresa;
use App\Models\Carrera;
use App\Models\User;
use Event;
use DB;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lat = auth()->user()->latitud;
        $lon = auth()->user()->longitud;

        $carrera = Carrera::creada()
                ->closeTo($lat, $lon)
                ->first();
        
        return response()->json(compact('carrera'));
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
        // EnviarConductoresJob::dispatch($carrera);
        event(new NuevaCarreraEvent($carrera));
        return response()->json(compact('carrera'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        return response()->json(compact('carrera'));
    }

    public function user()
    {
        $carrera = auth()->user()->carreras()->whereIn('estado_id', [1,2,3,4,5])->first();
        return response()->json(compact('carrera'));
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

    public function cancelar(Request $request, Carrera $carrera)
    {
        $carrera->estado_id=20;
        $carrera->hora_cancelacion=now()->toDateTimeString();
        $carrera->save();
        return response()->json(['cancelada'=>true]);
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
