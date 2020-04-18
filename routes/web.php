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
Route::get('/', 'InicioController@index');

Route::get('/contacto', 'ContactoController@index');
Route::get('/blog', 'BlogController@index');
Route::get('/blog/post/{id}', 'BlogController@show')->name('post');


Auth::routes();

Route::get('/admin/productos', 'ProductoController@index');

Route::get('/admin/blog', 'BlogAdminController@index');
Route::get('/admin/categorias', 'CategoriaController@index');
Route::get('/admin/marcas', 'MarcaController@index');



Route::resource('/admin', 'AdminController');

Route::resource('admin/productos', 'ProductoController');

Route::resource('admin/headerfrontend', 'HeaderFrontendController');

Route::resource('admin/footerinfo', 'FooterInfoController');

Route::resource('admin/teammember', 'TeamMemberController');

Route::resource('admin/blog', 'BlogAdminController');

Route::resource('admin/categorias', 'CategoriaController');

Route::resource('admin/marcas', 'MarcaController');

Route::resource('admin/slides', 'SlideController');








