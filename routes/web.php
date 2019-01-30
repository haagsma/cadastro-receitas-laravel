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


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adicionar', 'HomeController@adicionar')->name('adicionar');

Route::post('/salvar', 'HomeController@salvar')->name('salvar');

Route::post('/deletar', 'HomeController@deletar')->name('deletar');

Route::post('/editar', 'HomeController@editar')->name('editar');

Route::post('/editsalvar', 'HomeController@editsalvar')->name('editsalvar');

