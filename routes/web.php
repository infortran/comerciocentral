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
Route::get('/blog', 'BlogController@index');
Route::get('/blog/single', 'BlogController@single');


Auth::routes();

Route::get('/', 'InicioController@index');
Route::get('/admin/productos', 'ProductoController@index');
Route::get('/admin/blog', 'BlogAdminController@index');



Route::resource('/admin', 'AdminController');

Route::resource('admin/productos', 'ProductoController');

Route::resource('admin/headerfrontend', 'HeaderFrontendController');

Route::resource('admin/footerinfo', 'FooterInfoController');

Route::resource('admin/teammember', 'TeamMemberController');

Route::resource('admin/blog', 'BlogAdminController');



