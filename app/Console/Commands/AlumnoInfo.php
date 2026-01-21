<?php

namespace App\Console\Commands;

use App\Models\Alumno;
use Illuminate\Console\Command;

class AlumnoInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alumno:info {id? : ID del alumno (opcional, muestra todos si no se especifica)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra información de alumnos y sus materias sin usar Tinker';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        if ($id) {
            // Mostrar un alumno específico
            $alumno = Alumno::with('materias')->find($id);

            if (!$alumno) {
                $this->error("❌ Alumno con ID {$id} no encontrado");
                return 1;
            }

            $this->showAlumnoDetail($alumno);
        } else {
            // Mostrar todos los alumnos
            $alumnos = Alumno::with('materias')->get();

            if ($alumnos->isEmpty()) {
                $this->error("❌ No hay alumnos en la base de datos");
                return 1;
            }

            $this->info("\n📚 LISTADO DE ALUMNOS\n" . str_repeat("=", 50));

            foreach ($alumnos as $alumno) {
                $this->showAlumnoSummary($alumno);
                $this->line("");
            }

            $this->info("\n💡 Tip: Usa 'php artisan alumno:info {id}' para ver detalles de un alumno específico");
        }

        return 0;
    }

    /**
     * Muestra resumen de un alumno
     */
    private function showAlumnoSummary(Alumno $alumno)
    {
        $this->info("👨‍🎓 {$alumno->nombre} (ID: {$alumno->id})");
        $this->line("   📧 {$alumno->email}");
        $this->line("   📚 Materias: {$alumno->materias->count()}");

        if ($alumno->materias->isNotEmpty()) {
            $notasConValor = $alumno->materias->filter(fn($m) => $m->pivot->nota !== null);
            if ($notasConValor->isNotEmpty()) {
                $promedio = $notasConValor->avg('pivot.nota');
                $this->line("   📊 Promedio: " . number_format($promedio, 2));
            }
        }
    }

    /**
     * Muestra detalle completo de un alumno
     */
    private function showAlumnoDetail(Alumno $alumno)
    {
        $this->info("\n👨‍🎓 INFORMACIÓN DEL ALUMNO\n" . str_repeat("=", 50));
        $this->line("ID:     {$alumno->id}");
        $this->line("Nombre: {$alumno->nombre}");
        $this->line("Email:  {$alumno->email}");
        $this->line("Edad:   {$alumno->edad} años");

        $this->info("\n📚 MATERIAS CURSADAS\n" . str_repeat("=", 50));

        if ($alumno->materias->isEmpty()) {
            $this->warn("⚠️  No está inscrito en ninguna materia");
        } else {
            $table = [];
            $totalCreditos = 0;
            $notasConValor = $alumno->materias->filter(fn($m) => $m->pivot->nota !== null);

            foreach ($alumno->materias as $materia) {
                $table[] = [
                    $materia->nombre_materia,
                    $materia->creditos,
                    $materia->pivot->nota ? number_format($materia->pivot->nota, 1) : 'Sin nota',
                    $materia->descripcion ?? '-'
                ];
                $totalCreditos += $materia->creditos;
            }

            $this->table(
                ['Materia', 'Créditos', 'Nota', 'Descripción'],
                $table
            );

            $this->info("\n📊 RESUMEN");
            $this->line("Total de materias: {$alumno->materias->count()}");
            $this->line("Total de créditos: {$totalCreditos}");

            if ($notasConValor->isNotEmpty()) {
                $promedio = $notasConValor->avg('pivot.nota');
                $this->line("Promedio general: " . number_format($promedio, 2));

                if ($promedio >= 9) {
                    $this->info("⭐ ¡Excelente rendimiento!");
                } elseif ($promedio >= 7) {
                    $this->info("✅ Buen rendimiento");
                } else {
                    $this->warn("⚠️  Necesita mejorar");
                }
            }
        }

        $this->line("");
    }
}
