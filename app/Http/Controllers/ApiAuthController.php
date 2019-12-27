<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuthExceptions\JWTException;
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

    public function login(Request $request)
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
                    'error' => 'No hemos encontrado tus credenciales de usuario. Por favor contacte al administrador.'
                ], 404);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'success' => false,
                'error' => 'Error al iniciar sesión, por favor intente nuevamente.'
            ], 500);
        }
        // all good so return the token
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer'
        ]);
        //return response()->json(['success' => true, 'data'=> [ 'token' => $token ]], 200);
    }

    public function me()
    {
        try {
            $user = User::where('id',auth('api')->user()->id)->with(['conductor'])->first();
            $roles = $user->getRoleNames();
            return response()->json(compact('user','roles'));
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        } 
    }
}
