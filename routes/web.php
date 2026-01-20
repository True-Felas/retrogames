<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

// Ruta de la lista de juegos
Route::get('/', [GameController::class, 'index'])->name('games.index');
// Lista filtrada por consola
Route::get('/games', [GameController::class, 'list'])->name('games.list');

// Ruta del detalle de un juego
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');

// Nota: la funcionalidad de "jugar" fue removida temporalmente
