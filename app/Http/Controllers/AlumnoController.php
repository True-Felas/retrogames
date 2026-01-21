<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Materia;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Mostrar todos los alumnos con sus materias
     */
    public function index()
    {
        // Obtener todos los alumnos con sus materias (eager loading)
        $alumnos = Alumno::with('materias')->get();

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Mostrar un alumno específico con sus materias
     */
    public function show($id)
    {
        $alumno = Alumno::with('materias')->findOrFail($id);

        // Ejemplo de cómo iterar sobre las materias
        $materiasCursadas = [];
        foreach ($alumno->materias as $materia) {
            $materiasCursadas[] = [
                'nombre' => $materia->nombre_materia,
                'creditos' => $materia->creditos,
                'nota' => $materia->pivot->nota // Acceder a la nota desde la tabla pivote
            ];
        }

        return view('alumnos.show', compact('alumno', 'materiasCursadas'));
    }

    /**
     * Inscribir un alumno en una materia
     */
    public function inscribirMateria($alumnoId, $materiaId)
    {
        $alumno = Alumno::findOrFail($alumnoId);
        $materia = Materia::findOrFail($materiaId);

        // Attach: relacionar alumno con materia
        $alumno->materias()->attach($materiaId, ['nota' => null]);

        return response()->json([
            'message' => "Alumno {$alumno->nombre} inscrito en {$materia->nombre_materia}"
        ]);
    }

    /**
     * Desinscribir un alumno de una materia
     */
    public function desinscribirMateria($alumnoId, $materiaId)
    {
        $alumno = Alumno::findOrFail($alumnoId);

        // Detach: eliminar relación
        $alumno->materias()->detach($materiaId);

        return response()->json([
            'message' => "Alumno {$alumno->nombre} desinscrito de la materia"
        ]);
    }

    /**
     * Actualizar la nota de un alumno en una materia
     */
    public function actualizarNota($alumnoId, $materiaId, Request $request)
    {
        $alumno = Alumno::findOrFail($alumnoId);

        // Sync: actualizar datos en la tabla pivote
        $alumno->materias()->updateExistingPivot($materiaId, [
            'nota' => $request->input('nota')
        ]);

        return response()->json([
            'message' => "Nota actualizada correctamente"
        ]);
    }

    /**
     * Ejemplo de consultas avanzadas
     */
    public function ejemplosConsultas()
    {
        // 1. Obtener alumnos que cursan una materia específica
        $materia = Materia::find(1);
        $alumnosDeMateria = $materia->alumnos;

        // 2. Verificar si un alumno está inscrito en una materia
        $alumno = Alumno::find(1);
        $estaInscrito = $alumno->materias()->where('materia_id', 1)->exists();

        // 3. Contar cuántas materias cursa un alumno
        $cantidadMaterias = $alumno->materias()->count();

        // 4. Obtener alumnos con nota mayor a 8 en cualquier materia
        $alumnosBuenasNotas = Alumno::whereHas('materias', function ($query) {
            $query->where('nota', '>', 8);
        })->get();

        // 5. Sincronizar materias (reemplazar todas las relaciones)
        // $alumno->materias()->sync([1, 2, 3]); // Solo cursará estas 3 materias

        return response()->json([
            'alumnos_de_materia' => $alumnosDeMateria,
            'esta_inscrito' => $estaInscrito,
            'cantidad_materias' => $cantidadMaterias,
            'alumnos_buenas_notas' => $alumnosBuenasNotas
        ]);
    }
}
