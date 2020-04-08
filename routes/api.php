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
Route::get('ping', 'PassportController@ping');
Route::post('register', 'PassportController@register');
Route::post('login', 'PassportController@login');

Route::prefix('v1')->group(function(){
    Route::get('products', 'Api\v1\ProductController@index');

    Route::middleware('auth:api')->group(function () {
        Route::get('user', 'PassportController@details');
    });
});

