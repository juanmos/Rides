<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\CarreraFinalizadaEvent;
use App\Events\CarreraAceptadaOtroEvent;
use App\Events\CancelaCarreraPreviaEvent;
use App\Events\CarreraAceptadaEvent;
use App\Events\CarreraCanceladaEvent;
use App\Events\TaxiLlegoEvent;
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
        $carrera = auth()->user()->carrera();
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
    public function update(Request $request, Carrera $carrera)
    {
        if ($request->has('estado_id')) {
            $carrera->estado_id=$request->get('estado_id');
            if ($carrera->estado_id ==2 || $carrera->estado_id ==3) {
                $carrera->hora_aceptacion=now()->toDateTimeString();
                $carrera->conductor_id=auth()->user()->id;
                event(new CarreraAceptadaEvent($carrera));
                event(new CarreraAceptadaOtroEvent($carrera));
            } elseif ($carrera->estado_id ==4) {
                $carrera->hora_llegada=now()->toDateTimeString();
                event(new TaxiLlegoEvent($carrera));
            } elseif ($carrera->estado_id ==5) {
                $carrera->hora_abordaje=now()->toDateTimeString();
            }
            $carrera->save();
        }
        return response()->json(compact('carrera'));
    }

    public function terminar(Request $request, Carrera $carrera)
    {
        $carrera->estado_id=7;
        $carrera->hora_terminacion=now()->toDateTimeString();
        $carrera->costo=$request->get('costo');
        $carrera->calificacion_usuario=$request->get('calificacion_usuario');
        $carrera->latitud_destino=$request->get('latitud_destino');
        $carrera->longitud_destino=$request->get('longitud_destino');

        $carrera->save();
        event(new CarreraFinalizadaEvent($carrera));
        return response()->json(['finalizada'=>true]);
    }

    public function cancelar(Request $request, Carrera $carrera)
    {
        $carrera->estado_id=($carrera->estado_id==1)?20:21;
        $carrera->hora_cancelacion=now()->toDateTimeString();
        $carrera->save();
        if ($carrera->estado_id==21) {
            event(new CarreraCanceladaEvent($carrera));
        } else {
            event(new CancelaCarreraPreviaEvent($carrera));
        }
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
