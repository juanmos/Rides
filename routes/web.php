<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/mensaje', function () {
    \Event(new App\Events\NuevaCarreraEvent);
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');


    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin.index');

        Route::group(['prefix' => 'drivers'], function () {
            Route::get('/', 'Admin\DriverController@index')->name('admin.drivers.index');
            Route::get('/create', 'Admin\DriverController@create')->name('admin.drivers.create');
            Route::post('/store', 'Admin\DriverController@store')->name('admin.drivers.store');
        });

        Route::group(['prefix' => 'hoteles'], function () {
            Route::get('/', 'Hotel\HotelController@index')->name('admin.hoteles.index');
            Route::get('/create', 'Hotel\HotelController@create')->name('admin.hoteles.create');
            Route::post('/store', 'Hotel\HotelController@store')->name('admin.hoteles.store');
        });

        Route::resource('aerolinea', 'Admin\AerolineaController', ['as'=>'admin']);
        Route::get('aerolinea/{aerolinea}/vuelo/create', 'Admin\VueloController@create')
            ->name('admin.aerolinea.vuelo.create');
        Route::get('aerolinea/{aerolinea}/vuelo/{vuelo}/edit', 'Admin\VueloController@edit')
            ->name('admin.aerolinea.vuelo.edit');
        Route::post('aerolinea/{aerolinea}/vuelo', 'Admin\VueloController@store')
            ->name('admin.aerolinea.vuelo.store');
        Route::put('aerolinea/{aerolinea}/vuelo/{vuelo}', 'Admin\VueloController@update')
            ->name('admin.aerolinea.vuelo.update');
        Route::delete('aerolinea/{aerolinea}/vuelo/{vuelo}', 'Admin\VueloController@destroy')
            ->name('admin.aerolinea.vuelo.destroy');

        Route::resource('users', 'Admin\UsuarioController', ['as'=>'admin']);
        Route::resource('empresa', 'Admin\EmpresaController', ['as'=>'admin']);
        Route::get('empresa/{empresa}/configuracion', 'Admin\EmpresaController@configuracionView')
            ->name('admin.empresa.configuracion');
        Route::put('empresa/{empresa}/configuracion/{config}', 'Admin\EmpresaController@configuracionSave')
            ->name('admin.empresa.configuracion.update');
    });

    Route::group(['prefix' => 'driver'], function () {
        Route::get('/', 'Driver\DashboardController@index')->name('driver.index');
        Route::get('/{id?}', 'Driver\DriverController@show')->name('driver.show');
        Route::get('/{id?}/edit', 'Driver\DriverController@edit')->name('driver.edit');
        Route::put('/{id?}/update', 'Driver\DriverController@update')->name('driver.update');
        Route::delete('/{id?}/destroy', 'Driver\DriverController@destroy')->name('driver.destroy');
    });

    Route::group(['prefix' => 'hotel'], function () {
        Route::get('/', 'Hotel\DashboardController@index')->name('hotel.dashboard');
        Route::get('{hotel?}', 'Hotel\HotelController@show')->name('hotel.show');
        Route::get('{hotel?}/edit', 'Hotel\HotelController@edit')->name('hotel.edit');
        Route::put('{hotel?}/update', 'Hotel\HotelController@update')->name('hotel.update');
        Route::delete('{hotel?}', 'Hotel\HotelController@destroy')->name('hotel.destroy');

        Route::get('{hotel}/user/create', 'Hotel\UserController@create')->name('hotel.user.create');
        Route::post('{hotel}/user/store', 'Hotel\UserController@store')->name('hotel.user.store');
        Route::get('{hotel}/user/{user}/edit', 'Hotel\UserController@edit')->name('hotel.user.edit');
        Route::put('{hotel}/user/{user}/update', 'Hotel\UserController@update')->name('hotel.user.update');
        Route::delete('{hotel}/user/{user}/destroy', 'Hotel\UserController@destroy')->name('hotel.user.destroy');
    });

    Route::group(['prefix' => 'empresa'], function () {
        Route::get('{empresa}', 'Admin\EmpresaController@show')->name('empresa.show');
        Route::get('{empresa}/user/create', 'Empresa\UserController@create')->name('empresa.user.create');
        Route::post('{empresa}/user/store', 'Empresa\UserController@store')->name('empresa.user.store');
        Route::get('{empresa}/user/{user}', 'Empresa\UserController@show')->name('empresa.user.show');
        Route::get('{empresa}/user/{user}/edit', 'Empresa\UserController@edit')->name('empresa.user.edit');
        Route::put('{empresa}/user/{user}/update', 'Empresa\UserController@update')->name('empresa.user.update');
        Route::delete('{empresa}/user/{user}/destroy', 'Empresa\UserController@destroy')->name('empresa.user.destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'User\CarreraController@index')->name('user.index');
    });
});

Route::get('/', function () {
    return view('welcome');
});
