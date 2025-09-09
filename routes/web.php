<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\MascotaAdopcionController;
use App\Http\Controllers\ReaccionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\VacunacionController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\NotificacionController;


Route::get('/notificaciones/leer/{id}', [NotificacionController::class, 'leer'])
    ->name('notificaciones.leer');


Route::get('/notificaciones', [NotificacionController::class, 'index'])
    ->name('notificaciones.index')
    ->middleware('auth');



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/publicaciones.index', function () {
    return view('publicaciones.index');
})->middleware(['auth', 'verified'])->name('publicaciones.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::get('/adopta/crear', [MascotaAdopcionController::class, 'create'])->name('mascotaAdopcion.create');
Route::post('/adopta/guardar', [MascotaAdopcionController::class, 'store'])->name('mascotas.store');
Route::get('/adopta', [MascotaAdopcionController::class, 'index'])->name('adopta.index');

Route::middleware('auth')->group(function () {
    Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
});

Route::post('/publicaciones/{publicacion}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/publicaciones/{publicacion}/reaccion/love', [ReaccionController::class, 'toggleLove'])->middleware('auth')->name('reacciones.love');


Route::resource('consultas', ConsultaController::class);
Route::resource('vacunaciones', VacunacionController::class);
Route::resource('tratamientos', TratamientoController::class);
Route::resource('mascotas', MascotaController::class);
Route::resource('historial', HistorialMedicoController::class);
Route::resource('duenos', DuenoController::class);

Route::get('/busqueda', [BusquedaController::class, 'index'])->name('busqueda');



require __DIR__.'/auth.php';
