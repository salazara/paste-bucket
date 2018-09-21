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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paste/create', 'PasteController@create');
Route::get('/paste/edit/{id}', 'PasteController@edit');
Route::get('/paste/show/{id}', 'PasteController@show');

Route::post('/paste/store', 'PasteController@store');
Route::post('/paste/update', 'PasteController@update');
Route::post('/paste/destroy', 'PasteController@destroy');