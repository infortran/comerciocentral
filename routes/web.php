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
Route::get('/', 'InicioController@index')->name('inicio.index');

Route::get('/alexander/{nombre}', 'InicioController@alexander');

Route::get('/contacto', 'ContactoController@index');
Route::get('/blog', 'BlogController@index');
Route::get('/blog/post/{id}', 'BlogController@show')->name('post');
Route::get('/carrito', 'CartController@index');
Route::post('/add_to_cart', 'CartController@addItemsToCart');
Route::get('/productos', 'ProductoFrontController@index');
Route::get('/producto/{id}', 'ProductoFrontController@single')->name('producto.single');
Route::get('/cuenta', 'UserController@index');
Route::post('/direccion', 'UserController@addDireccion')->name('user.addDireccion');

Route::resource('comentario', 'ComentarioController');


Auth::routes();

Route::get('/admin/productos', 'ProductoController@index');

Route::get('/admin/blog', 'BlogAdminController@index');
Route::get('/admin/categorias', 'CategoriaController@index');
Route::get('/admin/marcas', 'MarcaController@index');
Route::get('/admin/comentarios' ,'ComentarioAdminController@index');
Route::post('/admin/social/socialtouser/{id}', 'SocialController@addSocialToUser')->name('social.user.add');
Route::post('/admin/social/detach/{user}/{social}', 'SocialController@detachSocialToUser')->name('social.user.detach');



Route::resource('/admin', 'AdminController');

Route::resource('admin/productos', 'ProductoController');

Route::resource('admin/headerfrontend', 'HeaderFrontendController');

Route::resource('admin/footerinfo', 'FooterInfoController');

Route::resource('admin/teammember', 'TeamMemberController');

Route::resource('admin/blog', 'BlogAdminController');

Route::resource('admin/categorias', 'CategoriaController');

Route::resource('admin/marcas', 'MarcaController');

Route::resource('admin/slides', 'SlideController');

Route::resource('admin/comentarios', 'ComentarioAdminController');

Route::resource('admin/socials', 'SocialController');










