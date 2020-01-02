@extends('layouts.app')

@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    @if($user!=null)
                                    <h5 class="m-b-10">Editar usuario</h5>
                                    @else
                                    <h5 class="m-b-10">Nuevo usuario</h5>
                                    @endif
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.hoteles.index')}}">Usuario</a></li>
                                    @if($user!=null)
                                    <li class="breadcrumb-item"><a href="javascript:">Editar</a></li>
                                    @else
                                    <li class="breadcrumb-item"><a href="javascript:">Nuevo</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                @if(Request::is('hotel/*'))

                <form action="{{($user!=null)?route('hotel.user.update',[$hotel->id,$user->id]):route('hotel.user.store',$hotel->id)}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="hotel_id" value="{{$hotel->id}}"/>
                @else
                <form action="{{($user!=null)?route('admin.users.update',[$user->id]):route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="_method" value="{{($user!=null)?'PUT':'POST'}}"/>

                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Datos del usuario</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-3 ">
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail img-circle">
                                                        @if($user!=null && $user->foto != '')
                                                            <img id="foto_nueva" src="{{Storage::url($user->foto)}}" border="0">
                                                        @else
                                                            <img id="foto_nueva" src="{{asset('images/default_user.png')}}" border="0">
                                                        @endif
                                                    </div>
                                                    <div id="image_preview" class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Buscar foto</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        {!! Form::file('foto',null,['class' => 'form-control']) !!}
                                                    </span>
                                                    <br />
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Borrar</a>
                                                </div>


                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label for="exampleInputEmail1">Nombre</label>
                                                <input type="text" value="@if($user!=null){{$user->nombre}}@else{{old('nombre')}}@endif" name="nombre" class="form-control @error('nombre') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Nombre">
                                                @error('nombre')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <label for="exampleInputPassword1">Apellido</label>
                                                <input type="text" value="@if($user!=null){{$user->apellido}}@else{{old('apellido')}}@endif" name="apellido" class="form-control @error('apellido') is-invalid @enderror" id="exampleInputPassword1" placeholder="Apellido">
                                                @error('apellido')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Email</label>
                                                <input type="email" value="@if($user!=null){{$user->email}}@else{{old('email')}}@endif" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputPassword1" placeholder="Email">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Contraseña</label>
                                                <input type="password" value="@if($user!=null){{$user->password}}@else{{old('password')}}@endif" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Contraseña">
                                                @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Teléfono</label>
                                                <input type="text" value="@if($user!=null){{$user->telefono}}@else{{old('telefono')}}@endif" name="telefono" class="form-control @error('telefono') is-invalid @enderror" id="exampleInputPassword1" placeholder="Teléfono">
                                                @error('telefono')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @if($user!=null)
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Estado</label>
                                                {!! Form::select('activo', ["0"=>"Inactivo","1"=>"Activo"], ($user!=null)?$user->activo : 1 ,["class"=>"form-control"]) !!}
                                            </div>
                                            @endif
                                            @if(!Request::is('hotel/*'))
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Role</label>
                                                {!! Form::select('role', $roles, ($user!=null)?$user->activo : 1 ,["class"=>"form-control"]) !!}
                                            </div>
                                            @endif
                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary"><span class="pcoded-micon"><i class="feather icon-save"></i></span><span class="pcoded-mtext">Guardar</span></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $('input[name=foto]').change(function(e) {

        var tgt = e.target || window.event.srcElement,
        files = tgt.files;

        var filename = files[0].name;
        var extension = files[0].type;
        var fileExtension = filename.split('.')[filename.split('.').length - 1].toLowerCase();

        var file = $(this)[0].files[0];
        if (file) {
            {{-- orientation(file, function(base64img, value) {
                console.log(rotation[value]);
                var rotated = $('#image_preview').attr('src', base64img);
                if (value) {
                    rotated.css('transform', rotation[value]);
                }
            }); --}}
        }

        if (FileReader && files && files.length) {
            if (fileExtension === 'png' || fileExtension === 'jpeg' || fileExtension === 'jpg') {
                var fr = new FileReader();
                fr.onload = function () {
                    $("#foto_nueva").attr("src",fr.result);
                }
                fr.readAsDataURL(files[0]);
            }else {
                alert('Formato de imagen inválido, solo se permite PNG, JPG o JPEG');
                $('input[name=foto]').val('');
            }
        }
    });
})
</script>
@endpush
