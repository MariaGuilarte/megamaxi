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
Route::get('/main', function () {
        return view('menu/contenido');
    })->name('main');

Route::get('/dashboard', 'DashboardController')->name('dashboard');
Route::post('/notification/get','NotificationController@get');

Route::get('/rol', 'RolController@index');
Route::get('/rol/selectrol', 'RolController@selectRol');

Route::get('/usuario', 'UserController@index')->name('usuario.index');;
Route::post('/usuario/registrar', 'UserController@store');
Route::put('/usuario/actualizar', 'UserController@update');
Route::put('/usuario/desactivar', 'UserController@desactivar');
Route::get('/usuario/cambiosgeneral', 'UserController@cambiosgeneral');
Route::any('/usuario/actualizarcambiosgeneral', 'UserController@actualizarcambiosgeneral');


Route::get('/usuarioinactivos', 'UserController@usuariosinactivos');
Route::put('/usuarioinactivos/activar', 'UserController@activarusuarios');
Route::put('/usuarioinactivos/borrar', 'UserController@borrarinactivos');



Route::get('/','Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



Route::get('/proveedor', 'ProveedorController@index')->name('proveedor.index');
Route::get('/proveedor/selectproveedor', 'ProveedorController@selectproveedor')->name('proveedor.seleccionarproveedor');
Route::post('/proveedor/registrar', 'ProveedorController@store')->name('proveedor.store');
Route::put('/proveedor/actualizar', 'ProveedorController@update')->name('proveedor.update');
Route::put('/proveedor/eliminar', 'ProveedorController@delete')->name('proveedor.delete');
Route::get('/proveedor/proveedortotales', 'ProveedorController@ConteoProveedor')->name('proveedor.ConteoProveedor');


Route::get('/cliente', 'ClienteController@index')->name('cliente.index');
Route::get('/cliente/selectcliente', 'ClienteController@selectcliente')->name('cliente.seleccionarcliente');
Route::post('/cliente/registrar', 'ClienteController@store')->name('cliente.store');
Route::put('/cliente/actualizar', 'ClienteController@update')->name('cliente.update');
Route::put('/cliente/eliminar', 'ClienteController@delete')->name('cliente.delete');
Route::get('/cliente/clienteTotales', 'ClienteController@ConteoCliente')->name('cliente.ConteoCliente');


Route::get('/categoria', 'CategoriaController@index')->name('categoria.index');
Route::post('/categoria/registrar', 'CategoriaController@store')->name('categoria.store');
Route::put('/categoria/actualizar', 'CategoriaController@update')->name('categoria.update');
Route::put('/categoria/eliminar', 'CategoriaController@delete')->name('categoria.delete');
Route::get('/categoria/selectcategoria', 'CategoriaController@selectcategoria')->name('categoria.selectcategoria');
Route::get('/categoria/categoriatotales', 'CategoriaController@ConteoCategoria')->name('categoria.ConteoCategoria');


Route::get('/producto', 'ProductoController@index')->name('producto.index');
Route::post('/producto/registrar', 'ProductoController@store')->name('producto.store');
Route::put('/producto/actualizar', 'ProductoController@update')->name('producto.update');
Route::put('/producto/eliminar', 'ProductoController@delete')->name('producto.delete');
Route::get('/producto/buscarproducto', 'ProductoController@buscarProducto')->name('producto.buscarProducto');
Route::get('/producto/buscarproductoventa', 'ProductoController@buscarProductoVenta')->name('producto.buscarproductoVenta');
Route::get('/producto/listarproducto', 'ProductoController@listarProducto')->name('producto.listarProducto');
Route::get('/producto/listarproductoventa', 'ProductoController@listarProductoVenta')->name('producto.listarproductoVenta');
Route::get('/producto/listarproductopdf', 'ProductoController@listarPDF')->name('producto.listarpdf');
Route::get('/producto/productostotales', 'ProductoController@ConteoProducto')->name('producto.ConteoProducto');


Route::get('/ingreso', 'IngresoController@index')->name('ingreso.index');
Route::post('/ingreso/registrar', 'IngresoController@store')->name('ingreso.store');
Route::put('/ingreso/desactivar', 'IngresoController@desactivar')->name('ingreso.desactivar');
Route::get('/ingreso/obtenerCabeceras', 'IngresoController@obtenerCabeceras')->name('ingreso.obtenerCabeceras');
Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles')->name('ingreso.obtenerDetalles');
Route::get('/ingreso/conteoingresos', 'IngresoController@ConteoIngresos')->name('ingreso.ConteoIngresos');

Route::get('/venta', 'VentaController@index')->name('venta.index');
Route::post('/venta/registrar', 'VentaController@store')->name('venta.store');
Route::put('/venta/desactivar', 'VentaController@desactivar')->name('venta.desactivar');
Route::get('/venta/obtenerCabeceras', 'VentaController@obtenerCabeceras')->name('venta.obtenerCabeceras');
Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles')->name('venta.obtenerDetalles');
Route::get('/venta/pdf/{id}', 'VentaController@pdf')->name('venta.pdf');
Route::get('/venta/ventastotales', 'VentaController@ConteoVentas')->name('venta.ConteoVentas');
Route::post('/notifications/{id}/markAsRead','NotificationController@markAsRead');
