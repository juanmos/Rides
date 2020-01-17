<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuthExceptions\JWTException;
use App\Events\NuevaPosicionEvent;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use JWTAuth;

class ApiAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    public function login(Request $request, $tipo = null)
    {
        $credentials = $request->only('email', 'password');
        
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'error' => 'No hemos encontrado tus datos de usuario. Por favor contacte al administrador.'
                ], 404);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'success' => false,
                'error' => 'Error al iniciar sesión, por favor intente nuevamente.'
            ], 500);
        }
        if ($tipo!=null &&  !in_array($tipo, auth('api')->user()->getRoleNames()->toArray())) {
            return response()->json([
                    'success' => false,
                    'error' => 'No tienes permiso para acceder a esta aplicación. Si quieres conectarte a la de usuarios descarga Lupp App.'
                ], 404);
        }
        // all good so return the token
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer'
        ]);
        //return response()->json(['success' => true, 'data'=> [ 'token' => $token ]], 200);
    }

    public function me(Request $request)
    {
        try {
            $user = User::where('id', auth('api')->user()->id)->with(['conductor'])->first();
            $roles = $user->getRoleNames();
            $carrera = $user->carrera();
            return response()->json(compact('user', 'roles', 'carrera'));
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }

    public function registroPush(Request $request)
    {
        $request->validate([
            'dispositivo'=>'required',
            'tipo'=>'required'
        ]);
        $data=[];
        if ($request->get('tipo')==1) {
            $data['token_ios']=$request->get('dispositivo');
        } else {
            $data['token_and']=$request->get('dispositivo');
        }
        auth()->user()->update($data);
        return response()->json(['guardado'=>true]);
    }

    public function geoposicion(Request $request)
    {
        $request->validate([
            'latitud'=>'required',
            'longitud'=>'required'
        ]);
        auth()->user()->update($request->all());
        $carrera = auth()->user()->carrera();
        if ($carrera!=null) {
            event(new NuevaPosicionEvent($carrera));
        }
        return response()->json(['guardado'=>true]);
    }
}
