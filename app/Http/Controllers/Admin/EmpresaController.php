<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use App\Models\Empresa;
use App\Models\Ciudad;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::orderBy('nombre')->paginate(50);
        return view('empresa.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = null;
        $ciudades = Ciudad::orderBy('ciudad')->get()->pluck('ciudad', 'id');
        return view('empresa.form', compact('empresa', 'ciudades'));
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
            'nombre'=>'required',
            'ruc'=>'required|min:10|numeric|unique:App\Models\Empresa,ruc',
            'telefono'=>'required|numeric|min:6',
            'costo'=>'required|numeric'
        ]);
        $empresa = Empresa::create($request->all());
        $empresa->configuracion()->create();
        return redirect()->route('admin.empresa.show', $empresa->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return view('empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        $ciudades = Ciudad::orderBy('ciudad')->get()->pluck('ciudad', 'id');
        return view('empresa.form', compact('empresa', 'ciudades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre'=>'required',
            'ruc'=>'required|min:10|numeric',
            'telefono'=>'required|numeric|min:6',
            'costo'=>'required|numeric'
        ]);
        $empresa->update($request->all());
        return redirect()->route('admin.empresa.show', $empresa->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->configuracion()->delete();
        $empresa->delete();
        return redirect()->route('admin.empresa.index');
    }

    public function configuracionView(Empresa $empresa)
    {
        $configuracion=$empresa->configuracion;
        return view('empresa.configuracion', compact('configuracion', 'empresa'));
    }

    public function configuracionSave(Request $request, Empresa $empresa, Configuracion $config)
    {
        $config->configuraciones=$request->all();
        return redirect()->route('admin.empresa.show', $empresa->id);
    }
}
