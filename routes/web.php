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

Route::get('/', function () {
    return view('welcome');
});

Route::name('admin_panel.')
    ->prefix('panel')
    ->namespace('AdminPanel')
    ->middleware('role:admin')
    ->group(function () {
        Route::post('/upload', 'CsvController@upload')->name('csv.upload');
    });