<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\MascotaAdopcionController;
use App\Http\Controllers\ReaccionController;
use App\Http\Controllers\SolicitudAdopcionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\VacunacionController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\CampanaEsterilizacionController;
use App\Http\Controllers\SolicitudCEController;

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
Route::get('/mascotas/{id}', [MascotaAdopcionController::class, 'show'])->name('mascotas.show');
Route::get('/adopta/crear', [MascotaAdopcionController::class, 'create'])->name('mascotaAdopcion.create');
Route::post('/adopta/guardar', [MascotaAdopcionController::class, 'store'])->name('mascotas.store');
Route::get('/adopta', [MascotaAdopcionController::class, 'index'])->name('adopta.index');

Route::middleware(['auth'])->group(function () {

    
    Route::get('/mascotas/{id}/adoptar', [SolicitudAdopcionController::class, 'create'])
        ->name('solicitudes.create');

    Route::post('/mascotas/{id}/adoptar', [SolicitudAdopcionController::class, 'store'])
        ->name('solicitudes.store');

   
    Route::get('/solicitudes', [SolicitudAdopcionController::class, 'index'])
        ->name('solicitudes.index');
});


Route::middleware('auth')->group(  function () {
    Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
});


Route::post('/publicaciones/{publicacion}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/publicaciones/{publicacion}/reaccion/love', [ReaccionController::class, 'toggleLove'])->middleware('auth')->name('reacciones.love');

Route::middleware('auth')->group(function () {
Route::resource('consultas', ConsultaController::class);
Route::resource('vacunaciones', VacunacionController::class);
Route::resource('tratamientos', TratamientoController::class);
Route::resource('mascotas', MascotaController::class);
Route::resource('historial', HistorialMedicoController::class);
Route::resource('duenos', DuenoController::class);
Route::resource('solicitudes', SolicitudCEController::class);
// Primero la ruta personalizada
Route::get('/campanas/publicacion', [CampanaEsterilizacionController::class, 'publicacion'])
    ->name('campanas.publicacion');

// Luego la resource
Route::resource('campanas', CampanaEsterilizacionController::class);

});

require __DIR__.'/auth.php';
