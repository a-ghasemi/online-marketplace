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

Route::get('/', 'HomeController@mainPage')->name('mainpage');
Route::get('/logout', 'Auth\LoginController@logout')->middleware('auth')->name('logout');


Route::name('admin_panel.')
    ->prefix('panel')
    ->namespace('AdminPanel')
    ->middleware('role:admin')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/upload', 'CsvController@create')->name('csv.create');
        Route::post('/upload', 'CsvController@upload')->name('csv.upload');

        Route::resource('product','ProductController');
        Route::resource('product_category','ProductCategoryController');
    });
