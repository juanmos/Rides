<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login/{tipo?}', 'ApiAuthController@login');

// Broadcast::routes(["middleware" => ["api", "jwt:auth"]]);

Route::group(['middleware'=>['jwt.auth']], function () {
    Route::get('usuario', 'ApiAuthController@me');
    Route::post('usuario/geoposicion', 'ApiAuthController@geoposicion');
    Route::put('usuario/registro/push', 'ApiAuthController@registroPush');

    Route::resource('carrera', 'CarreraController');
    Route::group(['prefix' => 'carrera'], function () {
        Route::get('by/user', 'CarreraController@user');
        Route::put('{carrera}/cancelar', 'CarreraController@cancelar');
        Route::put('{carrera}/terminar', 'CarreraController@terminar');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
