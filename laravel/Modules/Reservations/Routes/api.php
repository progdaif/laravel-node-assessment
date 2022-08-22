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

Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => '/reservation'], function () {
    Route::get('/', 'ReservationsController@index');
    Route::get('/{id}', 'ReservationsController@show');
    Route::post('/', 'ReservationsController@store');
    Route::put('/{id}', 'ReservationsController@update');
    Route::delete('/{id}', 'ReservationsController@destroy');
});