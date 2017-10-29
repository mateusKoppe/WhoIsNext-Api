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

Route::namespace('Auth')->group(function(){
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');
});

Route::resource('tasks', 'TaskController')->middleware('auth:api');

Route::prefix('helpers')
    ->middleware('auth:api')
    ->group(function(){
        Route::post('list/{task}', 'HelperController@store');
        Route::get('list/{task}', 'HelperController@index');
        Route::get('item/{helper}', 'HelperController@show');
        Route::put('item/{helper}', 'HelperController@update');
        Route::delete('item/{helper}', 'HelperController@destroy');
    });
