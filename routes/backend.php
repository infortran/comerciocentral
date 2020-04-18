<?php
use Illuminate\Support\Facades\Route;



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
