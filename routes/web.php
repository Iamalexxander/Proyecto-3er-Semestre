<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\CardexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioProductoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ConfiguracionFacturaController;

// Ruta principal redirige a productos de usuario
Route::get('/', function () {
    return view('inicio');
});

// Rutas páginas
Route::get('/sobre-nosotros', function () {
    return view('pags.sobre');
})->name('sobre');

Route::get('/terminos-y-condiciones', function () {
    return view('pags.terminos');
})->name('terminos');

Route::get('/politica-privacidad', function () {
    return view('pags.politicas');
})->name('politicas');

// Rutas para la carta, eventos y reservas
Route::get('/carta-bebidas', function () {
    return view('pags.menu');
})->name('menu');

Route::get('/eventos', function () {
    return view('pags.eventos');
})->name('eventos');

Route::get('/reservas', function () {
    return view('pags.reservas');
})->name('reservas');

// Rutas para la galería y ubicación
Route::get('/galeria', function () {
    return view('pags.galeria');
})->name('galeria');

Route::get('/ubicacion', function () {
    return view('pags.ubicacion');
})->name('ubicacion');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Rutas para el reset de contraseña
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.update');
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas para usuarios normales
Route::prefix('usuarios')->name('usuarios.')->group(function() {
    // Rutas públicas
    Route::get('productos', [UsuarioProductoController::class, 'index'])->name('productos.index');
    Route::get('productos/{producto}', [UsuarioProductoController::class, 'show'])->name('productos.show');
    Route::get('productos/{producto}/agregar', [UsuarioProductoController::class, 'create'])
        ->name('productos.create')
        ->middleware('auth');

    // Rutas protegidas por autenticación
    Route::middleware('auth')->group(function() {
        // Rutas de perfil
        Route::get('perfil', [PerfilController::class, 'show'])->name('perfil');
        Route::get('perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');
        Route::put('perfil/actualizar', [PerfilController::class, 'update'])->name('perfil.update');
        Route::put('perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.password');

        // Rutas de compras
        Route::get('compras', [CompraController::class, 'index'])->name('compras.index');
        Route::get('compras/{compra}', [CompraController::class, 'show'])->name('compras.show');
        Route::get('compras/{compra}/factura', [CompraController::class, 'downloadInvoice'])->name('compras.invoice');
        });
});

Route::middleware(['auth'])->group(function () {
    Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
    Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
    Route::post('/carrito/eliminar', [CarritoController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
    Route::post('/carrito/procesar', [CarritoController::class, 'procesarCompra'])->name('carrito.procesar');
    Route::post('/carrito/actualizar/{producto}', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
});

// Rutas para administradores
// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::resource('productos', ProductoController::class);
        Route::resource('clientes', ClienteController::class);
        Route::resource('facturas', FacturaController::class);
        Route::resource('cardex', CardexController::class);
        Route::resource('categorias', CategoriaController::class);
        
        // Reportes
        Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('reportes/productos', [ReporteController::class, 'productosReport'])->name('reportes.productos');
        Route::get('reportes/usuarios', [ReporteController::class, 'usuariosReport'])->name('reportes.usuarios');
        Route::get('reportes/ventas', [ReporteController::class, 'ventasReport'])->name('reportes.ventas');  
        
        // Añadir estas rutas dentro del grupo de rutas para admin
        Route::get('configuracion-factura', [ConfiguracionFacturaController::class, 'edit'])
        ->name('configuracion_factura.edit');
        Route::post('configuracion-factura', [ConfiguracionFacturaController::class, 'update'])
        ->name('configuracion_factura.update');
});
