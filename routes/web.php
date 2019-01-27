<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

//Vista de clientes ((ya no incluido))
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/clientes','ClienteController@index')->name('clientes')->middleware('verified');
Route::post('/clientes','ClienteController@addCliente')->name('clientes_add')->middleware('verified');
Route::get('/clientes/{id}/editar', 'ClienteController@editar')->name('usuario')->middleware('verified');
Route::get('/clientes/{id}/eliminar', 'ClienteController@eliminar')->name('eliminarUsuario')->middleware('verified');

//Perfil de usuario
Route::get('/perfil', 'UserController@profile')->name('perfil')->middleware('verified');
Route::post('/perfil', 'UserController@update_avatar');

//pedidos
Route::get('/pedido', 'PedidoController@listarPedidos')->name('pedido')->middleware('verified');

//Productos
Route::get('/producto', 'ProductoControlador@listarProducto')->name('producto')->middleware('verified');
Route::get('/producto1', 'ProductoControlador@registrarProducto');
Route::post('/producto', 'ProductoControlador@actualizarProducto');

//Categorias
Route::get('/categoria', 'CategoriaControlador@listarCategoria')->name('categoria')->middleware('verified');
Route::get('/categoria1', 'CategoriaControlador@registrarCategoria');
Route::post('/categoria', 'CategoriaControlador@actualizarCategoria');

//Promociones
Route::get('/promocion', 'PromocionControlador@listarPromocion')->name('promocion')->middleware('verified');
Route::get('/promocion1', 'PromocionControlador@registrarPromocion');
Route::post('/promocion', 'PromocionControlador@actualizarPromocion');

//Autenticación y Registro
/*Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::get('/register', 'Auth\RegisterController@registro')->name('registro');
Route::get('/password/reset', 'Auth\ResetPasswordController@resetPassword')->name('resetear_password');
Route::get('/password/email', 'Auth\ResetPasswordController@resetEmail')->name('resetear_email');
Auth::routes();*/

//Route::get('/home', 'HomeController@index')->name('home');
