@extends('layouts.app')

@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->

                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!--[ daily sales section ] start-->
                            <div class="col-md-6 col-xl-4">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Ventas diarias</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>$ 249.95</h3>
                                            </div>

                                            <div class="col-3 text-right">
                                                <p class="m-b-0">67%</p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ daily sales section ] end-->
                            <!--[ Monthly  sales section ] starts-->
                            <div class="col-md-6 col-xl-4">
                                <div class="card Monthly-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Ventas mensuales</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-down text-c-red f-30 m-r-10"></i>$ 2.942.32</h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0">36%</p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme2" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ Monthly  sales section ] end-->
                            <!--[ year  sales section ] starts-->
                            <div class="col-md-12 col-xl-4">
                                <div class="card yearly-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Ventas anuales</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>$ 8.638.32</h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0">80%</p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ year  sales section ] end-->
                            <!-- [ statistics year chart ] start -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-event">
                                    <div class="card-block">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col">
                                                <h5 class="m-0">{{$empresa->nombre}}</h5>
                                                <sub class="text-muted f-14">{{$empresa->direccion}}</sub><br>
                                                <sub class="text-muted f-14">{{$empresa->telefono}}</sub><br>
                                                <sub class="text-muted f-14">{{$empresa->email}}</sub>
                                            </div>
                                            {{-- <div class="col-auto">
                                                <label class="label theme-bg2 text-white f-14 f-w-400 float-right">34%</label>
                                            </div> --}}
                                        </div>
                                        <h6 class="text-muted mt-4 mb-0">
                                            @if(Auth::user()->hasRole('Administradores') || Auth::user()->hasRole('SuperAdminsitrador'))
                                            <a href="{{route('admin.empresa.edit',$empresa->id)}}" class="label theme-bg text-white f-12">Editar</a> 
                                            <a href="{{route('admin.empresa.configuracion',$empresa->id)}}" class="label theme-bg2 text-white f-12">Configuraciones</a>
                                            @endif
                                        </h6>
                                        <i class="far fa-building text-c-purple f-50"></i>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-block border-bottom">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-auto">
                                                <i class="feather icon-users f-30 text-c-purple"></i>
                                            </div>
                                            <div class="col">
                                                <h3 class="f-w-300">0</h3>
                                                <span class="d-block text-uppercase">TOTAL DE CONDUCTORES</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block border-bottom">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-auto">
                                                <i class="feather icon-zap f-30 text-c-green"></i>
                                            </div>
                                            <div class="col">
                                                <h3 class="f-w-300">0</h3>
                                                <span class="d-block text-uppercase">TOTAL DE CARRERAS</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-auto">
                                                <i class="feather icon-map-pin f-30 text-c-blue"></i>
                                            </div>
                                            <div class="col">
                                                <h3 class="f-w-300">0</h3>
                                                <span class="d-block text-uppercase">TOTAL DE CARRERAS TERMINADAS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ statistics year chart ] end -->
                            <!--[ Recent Users ] start-->
                            <div class="col-xl-8 col-md-6">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>Listado de usuarios</h5>
                                        @if(Auth::user()->hasRole('Administradores') || Auth::user()->hasRole('Operadores'))
                                        <a href="{{route('empresa.user.create',$empresa->id)}}" class="btn btn-primary float-right"><i class="fas fa-user-plus text-c-white f-10 m-r-15"></i> Nuevo usuario</a>
                                        @endif
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <ul class="nav nav-pills" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="conductores-tab" data-toggle="tab" href="#conductores" role="tab" aria-controls="conductores" aria-selected="false">Conductores <b>{{$empresa->conductores->count()}}</b></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="operadores-tab" data-toggle="tab" href="#operadores" role="tab" aria-controls="operadores" aria-selected="true">Usuarios <b>{{$empresa->usuarios->count()}}</b></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade active show" id="conductores" role="tabpanel" aria-labelledby="conductores-tab">
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                @forelse ($empresa->conductores as $usuario )
                                                                <tr class="unread">
                                                                    <td><img class="rounded-circle" style="width:40px;" src="{{Storage::url($usuario->foto)}}" alt="activity-user"></td>
                                                                    <td>
                                                                        <h6 class="mb-1">{{$usuario->nombre}} {{$usuario->apellido}}</h6>
                                                                        <p class="m-0">{{$usuario->telefono}}</p>
                                                                    </td>
                                                                    <td>
                                                                        <h6 class="text-muted"><i class="fas fa-circle {{($usuario->activo)?'text-c-green' :'text-c-red' }} f-10 m-r-15"></i>{{$usuario->email}}</h6>
                                                                        <p class="m-0">{{$usuario->getRoleNames()->implode(',')}}</p>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('empresa.user.show',[$empresa->id,$usuario->id] )}}" class="label theme-bg2 text-white f-12">Ver</a>
                                                                        <a href="{{route('empresa.user.edit',[$empresa->id,$usuario->id] )}}" class="label theme-bg text-white f-12">Editar</a>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                <p>No hay usuarios</p>
                                                                
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="operadores" role="tabpanel" aria-labelledby="operadores-tab">
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                @forelse ($empresa->usuarios as $usuario )
                                                                <tr class="unread">
                                                                    <td><img class="rounded-circle" style="width:40px;" src="{{Storage::url($usuario->foto)}}" alt="activity-user"></td>
                                                                    <td>
                                                                        <h6 class="mb-1">{{$usuario->nombre}} {{$usuario->apellido}}</h6>
                                                                        <p class="m-0">{{$usuario->telefono}}</p>
                                                                    </td>
                                                                    <td>
                                                                        <h6 class="text-muted"><i class="fas fa-circle {{($usuario->activo)?'text-c-green' :'text-c-red' }} f-10 m-r-15"></i>{{$usuario->email}}</h6>
                                                                        <p class="m-0">{{$usuario->getRoleNames()->implode(',')}}</p>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('empresa.user.show',[$empresa->id,$usuario->id] )}}" class="label theme-bg2 text-white f-12">Ver</a>
                                                                        <a href="{{route('empresa.user.edit',[$empresa->id,$usuario->id] )}}" class="label theme-bg text-white f-12">Editar</a>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                <p>No hay usuarios</p>
                                                                
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ Recent Users ] end-->

                           

                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
