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


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');


    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin.index');

        Route::group(['prefix' => 'drivers'], function () {
            Route::get('/', 'Admin\DriverController@index')->name('admin.drivers.index');
            Route::get('/create', 'Admin\DriverController@create')->name('admin.drivers.create');
            Route::post('/store', 'Admin\DriverController@store')->name('admin.drivers.store');
        });
    });

    Route::group(['prefix' => 'driver'], function () {
        Route::get('/', 'Driver\DashboardController@index')->name('driver.index');
        Route::get('/{id?}', 'Driver\DriverController@show')->name('driver.show');
        Route::get('/{id?}/edit', 'Driver\DriverController@edit')->name('driver.edit');
        Route::put('/{id?}/update','Driver\DriverController@update')->name('driver.update');
        Route::delete('/{id?}/destroy', 'Driver\DriverController@destroy')->name('driver.destroy');
    });

    Route::group(['prefix' => 'hotel'], function () {
        Route::get('/', 'Hotel\DashboardController@index')->name('hotel.index');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'User\DashboardController@index')->name('user.index');
    });
});

Route::get('/', function () {
    return view('welcome');
});
