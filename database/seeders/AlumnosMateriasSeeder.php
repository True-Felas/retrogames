<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Materia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnosMateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear Alumnos
        $alumno1 = Alumno::create([
            'nombre' => 'Juan Pérez',
            'email' => 'juan.perez@example.com',
            'edad' => 20
        ]);

        $alumno2 = Alumno::create([
            'nombre' => 'María García',
            'email' => 'maria.garcia@example.com',
            'edad' => 19
        ]);

        $alumno3 = Alumno::create([
            'nombre' => 'Carlos López',
            'email' => 'carlos.lopez@example.com',
            'edad' => 21
        ]);

        $alumno4 = Alumno::create([
            'nombre' => 'Ana Martínez',
            'email' => 'ana.martinez@example.com',
            'edad' => 20
        ]);

        // Crear Materias
        $mates = Materia::create([
            'nombre_materia' => 'Matemáticas',
            'descripcion' => 'Cálculo diferencial e integral',
            'creditos' => 6
        ]);

        $historia = Materia::create([
            'nombre_materia' => 'Historia',
            'descripcion' => 'Historia contemporánea',
            'creditos' => 4
        ]);

        $fisica = Materia::create([
            'nombre_materia' => 'Física',
            'descripcion' => 'Mecánica clásica',
            'creditos' => 5
        ]);

        $programacion = Materia::create([
            'nombre_materia' => 'Programación',
            'descripcion' => 'Fundamentos de programación en PHP',
            'creditos' => 6
        ]);

        $literatura = Materia::create([
            'nombre_materia' => 'Literatura',
            'descripcion' => 'Literatura española',
            'creditos' => 3
        ]);

        // Relacionar Alumnos con Materias (usando attach)
        // Juan Pérez cursa Matemáticas, Historia y Programación
        $alumno1->materias()->attach($mates->id, ['nota' => 8.5]);
        $alumno1->materias()->attach($historia->id, ['nota' => 7.0]);
        $alumno1->materias()->attach($programacion->id, ['nota' => 9.0]);

        // María García cursa Física, Programación y Literatura
        $alumno2->materias()->attach($fisica->id, ['nota' => 8.0]);
        $alumno2->materias()->attach($programacion->id, ['nota' => 9.5]);
        $alumno2->materias()->attach($literatura->id, ['nota' => 8.5]);

        // Carlos López cursa todas las materias
        $alumno3->materias()->attach($mates->id, ['nota' => 7.5]);
        $alumno3->materias()->attach($historia->id, ['nota' => 6.5]);
        $alumno3->materias()->attach($fisica->id, ['nota' => 7.0]);
        $alumno3->materias()->attach($programacion->id, ['nota' => 8.0]);
        $alumno3->materias()->attach($literatura->id, ['nota' => 7.5]);

        // Ana Martínez cursa Matemáticas y Física
        $alumno4->materias()->attach($mates->id, ['nota' => 9.5]);
        $alumno4->materias()->attach($fisica->id, ['nota' => 9.0]);

        echo "\nBase de datos poblada con éxito!\n";
        echo "- 4 alumnos creados\n";
        echo "- 5 materias creadas\n";
        echo "- Relaciones establecidas en tabla pivote\n";
    }
}
