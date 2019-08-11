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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/','ShippingController@index');
Route::get('/{id}','ShippingController@show');
Route::put('/{id}','ShippingController@update');
Route::delete('/{id}','ShippingController@destroy');
Route::post('/calculate','ShippingRateController@store');
