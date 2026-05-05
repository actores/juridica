<?php

use App\Http\Controllers\ContratoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    // --- RUTAS DE CONTRATOS ---

    // Centro Camaleón (USA ESTE NOMBRE EN EL HREF)
    Route::get('/contratos/camaleon', [ContratoController::class, 'createCamaleon'])
        ->name('contratos.camaleon');

    Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos.index');
    Route::get('/contratos/{contrato}', [ContratoController::class, 'show'])->name('contratos.show');


    Route::post('/contratos/{contrato}/generar-word', [ContratoController::class, 'generarWord'])
        ->name('contratos.generar-word');

    // Futuro Centro Atenas
    Route::get('/contratos/atenas', [ContratoController::class, 'createAtenas'])
        ->name('contratos.atenas');

    // Ruta única para Guardar (POST)
    Route::post('/contratos/store', [ContratoController::class, 'store'])
        ->name('contratos.store');
});

require __DIR__ . '/auth.php';
