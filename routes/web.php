<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RequisicionesController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pagos;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\TipoMaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [ClientesController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
    Route::patch('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');

    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');
    Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::patch('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');


    Route::get('/proyectos', [ProyectosController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/create', [ProyectosController::class, 'create'])->name('proyectos.create');
    Route::post('/proyectos', [ProyectosController::class, 'store'])->name('proyectos.store');
    Route::get('/proyectos/{proyecto}', [ProyectosController::class, 'show'])->name('proyectos.show');
    Route::get('/proyectos/{proyecto}/edit', [ProyectosController::class, 'edit'])->name('proyectos.edit');
    Route::patch('/proyectos/{proyecto}', [ProyectosController::class, 'update'])->name('proyectos.update');
    Route::delete('/proyectos/{proyecto}', [ProyectosController::class, 'destroy'])->name('proyectos.destroy');

    Route::get('/almacen', [MaterialsController::class, 'index'])->name('almacen.index');
    Route::get('/almacen/create', [MaterialsController::class, 'create'])->name('almacen.create');
    Route::post('/almacen', [MaterialsController::class, 'store'])->name('almacen.store');
    Route::get('/almacen/{material}', [MaterialsController::class, 'show'])->name('almacen.show');
    Route::get('/almacen/{material}/edit', [MaterialsController::class, 'edit'])->name('almacen.edit');
    Route::patch('/almacen/{material}', [MaterialsController::class, 'update'])->name('almacen.update');
    Route::delete('/almacen/{material}', [MaterialsController::class, 'destroy'])->name('almacen.destroy');

    Route::get('/requisiciones', [RequisicionesController::class, 'index'])->name('requisiciones.index');
    Route::get('/requisiciones/create', [RequisicionesController::class, 'create'])->name('requisiciones.create');
    Route::post('/requisiciones/materiales', [RequisicionesController::class, 'storeMateriales'])->name('requisiciones.materiales.store');
    Route::post('/requisiciones/viaticos', [RequisicionesController::class, 'storeViaticos'])->name('requisiciones.viaticos.store');
    Route::get('/requisiciones/{material}', [RequisicionesController::class, 'show'])->name('requisiciones.show');
    Route::get('/requisiciones/{material}/edit', [RequisicionesController::class, 'edit'])->name('requisiciones.edit');
    Route::patch('/requisiciones/{material}', [RequisicionesController::class, 'update'])->name('requisiciones.update');
    Route::get('/requisiciones/almacen/{id}', [RequisicionesController::class, 'mostrarAlmacen'])->name('requisiciones.almacen');
    Route::get('/requisiciones/viaticos/{id}', [RequisicionesController::class, 'mostrarViaticos'])->name('requisiciones.viaticos');
    Route::post('/requisiciones/suministrar/{id}', [RequisicionesController::class, 'suministrar'])->name('requisiciones.suministrar');
    Route::delete('/requisiciones/{id}', [RequisicionesController::class, 'destroy'])->name('requisiciones.destroy');
    Route::post('/requisiciones/autorizar', [RequisicionesController::class, 'autorizar'])->name('requisiciones.autorizar');




    Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizaciones.index');
    Route::get('/cotizaciones/{id}/create', [CotizacionController::class, 'create'])->name('cotizaciones.create');
    Route::post('/cotizaciones/{id}/store', [CotizacionController::class, 'store'])->name('cotizaciones.store');
    Route::get('/cotizaciones/{id}/show', [CotizacionController::class, 'show'])->name('cotizaciones.show');
    Route::get('/cotizaciones/{id}/edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');
    Route::patch('/cotizaciones/{id}/update', [CotizacionController::class, 'update'])->name('cotizaciones.update');
    Route::patch('/cotizaciones/{id}/updateProvider', [CotizacionController::class, 'updateProvider'])->name('cotizaciones.proveedor');
    Route::post('/enviar-a-pago', [CotizacionController::class, 'enviarAPago'])->name('enviar.a.pago');
    Route::post('/cotizaciones/{id}/estado', [CotizacionController::class, 'cambiarEstado'])->name('cotizaciones.actualizarEstado');
    

    Route::get('/unidades', [UnidadesController::class, 'index'])->name('unidades.index');
    Route::get('/unidades/create', [UnidadesController::class, 'create'])->name('unidades.create');
    Route::post('/unidades', [UnidadesController::class, 'store'])->name('unidades.store');
    Route::get('/unidades/{id}', [UnidadesController::class, 'show'])->name('unidades.show');
    Route::get('/unidades/{id}/edit', [UnidadesController::class, 'edit'])->name('unidades.edit');
    Route::patch('/unidades/{id}', [UnidadesController::class, 'update'])->name('unidades.update');
    Route::delete('/unidades/{id}', [UnidadesController::class, 'destroy'])->name('unidades.destroy');

    Route::get('/tipomaterial', [TipoMaterialController::class, 'index'])->name('tipomaterial.index');
    Route::get('/tipomaterial/create', [TipoMaterialController::class, 'create'])->name('tipomaterial.create');
    Route::post('/tipomaterial', [TipoMaterialController::class, 'store'])->name('tipomaterial.store');
    Route::get('/tipomaterial/{id}', [TipoMaterialController::class, 'show'])->name('tipomaterial.show');
    Route::get('/tipomaterial/{id}/edit', [TipoMaterialController::class, 'edit'])->name('tipomaterial.edit');
    Route::patch('/tipomaterial/{id}', [TipoMaterialController::class, 'update'])->name('tipomaterial.update');
    Route::delete('/tipomaterial/{id}', [TipoMaterialController::class, 'destroy'])->name('tipomaterial.destroy');

    Route::get('/pagos', [PagosController::class, 'index'])->name('pagos.index');
    Route::get('/pagos/create', [PagosController::class, 'create'])->name('pagos.create');
    Route::post('/pagos', [PagosController::class, 'store'])->name('pagos.store');
    Route::get('/pagos/{id}', [PagosController::class, 'show'])->name('pagos.show');
    Route::get('/pagos/{id}/edit', [PagosController::class, 'edit'])->name('pagos.edit');
    Route::patch('/pagos/{id}', [PagosController::class, 'update'])->name('pagos.update');
    Route::delete('/pagos/{id}', [PagosController::class, 'destroy'])->name('pagos.destroy');
    Route::post('/pagos/update-forma-pago', [PagosController::class, 'updateFormaPago'])->name('pagos.updateFormaPago');

});

require __DIR__ . '/auth.php';
