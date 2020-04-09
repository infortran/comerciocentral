<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/contacto', 'ContactoController@index');



Auth::routes();

Route::get('/', 'InicioController@index');

Route::get('/admin', 'HomeController@index');


Route::resource('admin/productos', 'ProductoController');
