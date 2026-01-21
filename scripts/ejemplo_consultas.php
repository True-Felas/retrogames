<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "========================================\n";
echo "   EJEMPLO DE CONSULTAS - TINKER\n";
echo "========================================\n\n";

// 1. Ver primer alumno con sus materias
echo "1️⃣  ALUMNO Y SUS MATERIAS:\n";
echo "----------------------------\n";
$alumno = App\Models\Alumno::with('materias')->first();
echo "👨‍🎓 Alumno: " . $alumno->nombre . "\n";
echo "📧 Email: " . $alumno->email . "\n";
echo "📚 Materias que cursa:\n";
foreach ($alumno->materias as $materia) {
    echo "   • " . $materia->nombre_materia . " (Nota: " . $materia->pivot->nota . ")\n";
}

echo "\n";

// 2. Ver una materia con sus alumnos
echo "2️⃣  MATERIA Y SUS ALUMNOS:\n";
echo "----------------------------\n";
$materia = App\Models\Materia::with('alumnos')->where('nombre_materia', 'Programación')->first();
echo "💻 Materia: " . $materia->nombre_materia . "\n";
echo "📖 Descripción: " . $materia->descripcion . "\n";
echo "👥 Alumnos inscritos:\n";
foreach ($materia->alumnos as $alumno) {
    echo "   • " . $alumno->nombre . " (Nota: " . $alumno->pivot->nota . ")\n";
}

echo "\n";

// 3. Estadísticas generales
echo "3️⃣  ESTADÍSTICAS:\n";
echo "----------------------------\n";
echo "Total de alumnos: " . App\Models\Alumno::count() . "\n";
echo "Total de materias: " . App\Models\Materia::count() . "\n";
echo "Total de inscripciones: " . \DB::table('alumno_materia')->count() . "\n";

echo "\n";

// 4. Alumno con más materias
echo "4️⃣  ALUMNO CON MÁS MATERIAS:\n";
echo "----------------------------\n";
$alumnoConMasMaterias = App\Models\Alumno::withCount('materias')
    ->orderBy('materias_count', 'desc')
    ->first();
echo "🏆 " . $alumnoConMasMaterias->nombre . " cursa " . $alumnoConMasMaterias->materias_count . " materias\n";

echo "\n";

// 5. Alumnos con promedio alto
echo "5️⃣  ALUMNOS CON NOTAS ALTAS:\n";
echo "----------------------------\n";
$alumnos = App\Models\Alumno::with('materias')->get();
foreach ($alumnos as $alumno) {
    $notasConValor = $alumno->materias->filter(fn($m) => $m->pivot->nota !== null);
    if ($notasConValor->isNotEmpty()) {
        $promedio = $notasConValor->avg('pivot.nota');
        if ($promedio >= 8) {
            echo "⭐ " . $alumno->nombre . " - Promedio: " . number_format($promedio, 2) . "\n";
        }
    }
}

echo "\n========================================\n";
echo "✅ Consultas ejecutadas correctamente!\n";
echo "========================================\n";
