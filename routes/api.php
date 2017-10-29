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

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::resource('tasks', 'TaskController')->middleware('auth:api');

Route::post('helpers/list/{task}', 'HelperController@store')->middleware('auth:api');
Route::get('helpers/list/{task}', 'HelperController@index')->middleware('auth:api');
Route::get('helpers/item/{helper}', 'HelperController@show')->middleware('auth:api');
Route::put('helpers/item/{helper}', 'HelperController@update')->middleware('auth:api');
