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

Route::get('/contacto', 'ContactoController@index');
Route::get('/blog', 'BlogController@index');
Route::get('/blog/post/{id}', 'BlogController@show')->name('post');

Route::get('/carrito', 'CartController@index');
Route::post('/add_to_cart', 'CartController@addItemsToCart');
Route::get('/remove_on_cart/{id}', 'CartController@removeItemOnCart');
Route::get('/reset_on_cart/{id}', 'CartController@resetItemOnCart');
Route::post('/add_cart_qty', 'CartController@processItemByQty');


Route::get('/checkout', 'CheckoutController@index');
Route::post('/payment_process', 'CheckoutController@paymentProcess');
Route::post('/pagar', 'CheckoutController@getPaymentProcess');


Route::get('/productos', 'ProductoFrontController@index');
Route::get('/producto/{id}', 'ProductoFrontController@single')->name('producto.single');
Route::get('/cuenta', 'UserController@index');
Route::post('/direccion', 'UserController@addDireccion')->name('user.addDireccion');

Route::resource('comentario', 'ComentarioController');

Route::resource('user', 'UserController');


Auth::routes();

Route::get('/admin/productos', 'ProductoController@index');

Route::get('/admin/blog', 'BlogAdminController@index');

Route::get('/admin/categorias', 'CategoriaController@index');

Route::get('/admin/marcas', 'MarcaController@index');

Route::get('/admin/comentarios' ,'ComentarioAdminController@index');
Route::put('/admin/comentarios/ban/{id}', 'ComentarioController@ban')->name('comentario.ban');
Route::put('/admin/comentarios/unlock/{id}', 'ComentarioController@unlock')->name('comentario.unlock');

Route::post('/admin/social/socialtouser/{id}', 'SocialController@addSocialToUser')->name('social.user.add');
Route::post('/admin/social/detach/{user}/{social}', 'SocialController@detachSocialToUser')->name('social.user.detach');
Route::post('/admin/social/socialtosite', 'SocialController@addSocialToSite')->name('social.site.add');
Route::post('/admin/social/deletesocialsite/{id}', 'SocialController@deleteSocialToSite')->name('social.site.delete');

Route::get('/admin/password/view', 'AdminController@changePassword')->name('admin.view.changepass');
Route::post('/admin/password/check', 'AdminController@checkPassword')->name('admin.check.pass');
Route::post('admin/password/update', 'AdminController@updatePassword')->name('admin.changepass');
Route::get('/admin/password/reset', 'AdminController@resetCheckPassword');

Route::get('/cuenta/password/view', 'UserController@changePassword')->name('user.view.changepass');
Route::post('/cuenta/password/check', 'UserController@checkPassword')->name('user.check.pass');
Route::post('/cuenta/password/update', 'UserController@updatePassword')->name('user.changepass');
Route::get('/cuenta/password/reset', 'UserController@resetCheckPassword');

Route::get('admin/users', 'AdminController@show');
Route::post('admin/users/ban/{id}', 'AdminController@banUser');
Route::post('admin/users/unlock/{id}', 'AdminController@unlockUser');

Route::post('admin/productos/set_available/{id}', 'ProductoController@setAvailable');
Route::post('admin/productos/set_not_available/{id}', 'ProductoController@setNotAvailable');


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

Route::resource('admin/envios', 'EnvioController');










