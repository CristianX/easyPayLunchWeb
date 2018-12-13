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


Route::get('/home','HomeController@index')->name('home');
Route::get('/clientes','ClienteController@index')->name('clientes');
//Route::get('/productos','ProductoController@listarproductos')->name('productos');
Route::get('/phpfirebase_sdk','FirebaseController@index');
//Route::get('/producto/create','ProductoController@agregarproductos');
//Route::get('/producto/show','ProductoController@show');
Route::resource('productos','ProductooController');

Route::get('/codigoqr','QrController@makeQR');
Route::get('/vcard','QrController@vcard');

Route::get('/pagoqr','QR2Controller@qr');

Route::get('/generarqr','QrPagoController@qr');

Route::get('/promociones','PromocionController@index');
//Route::get('promocion/create','PromocionController@agregar');


