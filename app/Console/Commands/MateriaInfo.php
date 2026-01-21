<?php

namespace App\Console\Commands;

use App\Models\Materia;
use Illuminate\Console\Command;

class MateriaInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'materia:info {id? : ID de la materia (opcional, muestra todas si no se especifica)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra información de materias y sus alumnos inscritos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        if ($id) {
            // Mostrar una materia específica
            $materia = Materia::with('alumnos')->find($id);

            if (!$materia) {
                $this->error("❌ Materia con ID {$id} no encontrada");
                return 1;
            }

            $this->showMateriaDetail($materia);
        } else {
            // Mostrar todas las materias
            $materias = Materia::withCount('alumnos')->get();

            if ($materias->isEmpty()) {
                $this->error("❌ No hay materias en la base de datos");
                return 1;
            }

            $this->info("\n📖 LISTADO DE MATERIAS\n" . str_repeat("=", 50));

            $table = [];
            foreach ($materias as $materia) {
                $table[] = [
                    $materia->id,
                    $materia->nombre_materia,
                    $materia->creditos,
                    $materia->alumnos_count,
                    substr($materia->descripcion ?? '-', 0, 40) . '...'
                ];
            }

            $this->table(
                ['ID', 'Materia', 'Créditos', 'Alumnos', 'Descripción'],
                $table
            );

            $this->info("\n💡 Tip: Usa 'php artisan materia:info {id}' para ver detalles de una materia específica");
        }

        return 0;
    }

    /**
     * Muestra detalle completo de una materia
     */
    private function showMateriaDetail(Materia $materia)
    {
        $this->info("\n📖 INFORMACIÓN DE LA MATERIA\n" . str_repeat("=", 50));
        $this->line("ID:          {$materia->id}");
        $this->line("Nombre:      {$materia->nombre_materia}");
        $this->line("Créditos:    {$materia->creditos}");
        $this->line("Descripción: " . ($materia->descripcion ?? '-'));

        $this->info("\n👥 ALUMNOS INSCRITOS\n" . str_repeat("=", 50));

        if ($materia->alumnos->isEmpty()) {
            $this->warn("⚠️  No hay alumnos inscritos en esta materia");
        } else {
            $table = [];
            $notasConValor = $materia->alumnos->filter(fn($a) => $a->pivot->nota !== null);

            foreach ($materia->alumnos as $alumno) {
                $table[] = [
                    $alumno->id,
                    $alumno->nombre,
                    $alumno->email,
                    $alumno->pivot->nota ? number_format($alumno->pivot->nota, 1) : 'Sin nota'
                ];
            }

            $this->table(
                ['ID', 'Nombre', 'Email', 'Nota'],
                $table
            );

            $this->info("\n📊 ESTADÍSTICAS");
            $this->line("Total de alumnos: {$materia->alumnos->count()}");

            if ($notasConValor->isNotEmpty()) {
                $promedio = $notasConValor->avg('pivot.nota');
                $this->line("Promedio de la clase: " . number_format($promedio, 2));
                $this->line("Nota más alta: " . number_format($notasConValor->max('pivot.nota'), 1));
                $this->line("Nota más baja: " . number_format($notasConValor->min('pivot.nota'), 1));
            }
        }

        $this->line("");
    }
}
