<?php

use App\Http\Controllers\InicioController;
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
//Route::get('/tienda', 'InicioController@index')->name('inicio.index');



Route::domain('{domain}.comerciocentral.chi')->group(function () {
    Route::get('/', 'InicioController@index');
    Route::post('/login/auth', 'Auth\LoginController@login')->name('main.login.auth');
    //Route::post('/', 'InicioController@indexAdm');
    Auth::routes();
    Route::get('/contacto', 'ContactoController@index');
    //Route::get('/cuenta', 'UserController@index');

    Route::get('/admin/productos', 'ProductoController@index');
    Route::get('/admin/categorias', 'CategoriaController@index');
    Route::get('/admin/marcas', 'MarcaController@index');
    Route::get('/admin/blog', 'BlogAdminController@index');

    Route::get('/carrito', 'CartController@index');
    Route::post('/add_to_cart', 'CartController@addItemsToCart');
    Route::get('/remove_on_cart/{id}/{tienda}', 'CartController@removeItemOnCart');
    Route::get('/reset_on_cart/{id}/{tienda}', 'CartController@resetItemOnCart');
    Route::post('/add_cart_qty', 'CartController@processItemByQty');

    Route::get('/checkout', 'CheckoutController@index');
    Route::post('/payment/webpay', 'CheckoutController@webpayProcess');
    Route::get('/payment/retry', 'CheckoutController@getRetryPayment');
    Route::get('/payment/webpay/retry', 'CheckoutController@retryPayment');
    Route::post('/payment', 'CheckoutController@getPaymentProcess');
    Route::get('/payment/deposito', 'CheckoutController@getDepositoPaymentProcess');
    Route::post('/payment/final', 'CheckoutController@finalPaymentProcess');
    Route::post('/payment/final_deposito', 'CheckoutController@finalDepositoProcess');

    Route::resource('/admin', 'AdminController');
    Route::resource('admin/productos', 'ProductoController');
    Route::resource('admin/categorias', 'CategoriaController');
    Route::resource('admin/marcas', 'MarcaController');
    Route::resource('admin/blog', 'BlogAdminController');

    Route::get('/productos', 'ProductoFrontController@index');
    Route::get('/producto/{id}', 'ProductoFrontController@single')->name('producto.single');

    Route::get('/blog', 'BlogController@index');
    Route::get('/blog/post/{id}', 'BlogController@show')->name('post');

});

//Auth::routes();

Route::get('/', 'MainController@index');
Route::get('/tienda', 'MainController@tienda');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/login', 'MainController@login');
Route::post('/login/auth', 'Auth\LoginController@login')->name('main.login.auth');
Route::post('/registro', 'MainController@register')->name('main.register');
Route::post('/registro/submit', 'MainController@submitRegister')->name('main.register.submit');
Route::get('/registro/checktienda/{domain}', 'MainController@checkTienda');
Route::get('/registro/checkemail/{email}', 'MainController@checkEmail');
Route::get('/registro/checktiendaemail/{email}', 'MainController@checkTiendaEmail');
Route::get('/registro/checktiendadomainemail/{domain}/{email}', 'MainController@checkTiendaDomainEmail');






Route::post('/direccion', 'UserController@addDireccion')->name('user.addDireccion');










Route::resource('comentario', 'ComentarioController');

Route::resource('user', 'UserController');

//Route::get('/.well-known/pki-validation/{key}', 'InicioController@pkiValidation');











Route::get('/admin/ordenes', 'OrdenController@index');
Route::get('/admin/orden/{id}', 'OrdenController@show');

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






Route::resource('admin/headerfrontend', 'HeaderFrontendController');

Route::resource('admin/footerinfo', 'FooterInfoController');

Route::resource('admin/teammember', 'TeamMemberController');







Route::resource('admin/slides', 'SlideController');

Route::resource('admin/comentarios', 'ComentarioAdminController');

Route::resource('admin/socials', 'SocialController');

Route::resource('admin/envios', 'EnvioController');










