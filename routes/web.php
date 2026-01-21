<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AlumnoController;

// Ruta de la lista de juegos
Route::get('/', [GameController::class, 'index'])->name('games.index');
// Lista filtrada por consola
Route::get('/games', [GameController::class, 'list'])->name('games.list');

// Ruta del detalle de un juego
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');

// Nota: la funcionalidad de "jugar" fue removida temporalmente

// Rutas para el sistema de Alumnos y Materias
Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::get('/alumnos/{id}', [AlumnoController::class, 'show'])->name('alumnos.show');
Route::post('/alumnos/{alumnoId}/materias/{materiaId}/inscribir', [AlumnoController::class, 'inscribirMateria']);
Route::delete('/alumnos/{alumnoId}/materias/{materiaId}/desinscribir', [AlumnoController::class, 'desinscribirMateria']);
Route::put('/alumnos/{alumnoId}/materias/{materiaId}/nota', [AlumnoController::class, 'actualizarNota']);
Route::get('/alumnos/ejemplos/consultas', [AlumnoController::class, 'ejemplosConsultas']);
