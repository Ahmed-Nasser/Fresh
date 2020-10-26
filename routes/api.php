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

Route::get('v1/users', 'UsersController@index');
Route::get('v1/users/{id}', 'UsersController@show');
Route::post('v1/users', 'UsersController@store');
Route::put('v1/users/{id}', 'UsersController@update');

