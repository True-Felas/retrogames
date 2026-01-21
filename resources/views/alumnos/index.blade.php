<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }

        .alumno-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .alumno-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .alumno-nombre {
            font-size: 1.5em;
            color: #007bff;
            font-weight: bold;
        }

        .alumno-info {
            color: #666;
            margin-bottom: 10px;
        }

        .materias-list {
            margin-top: 15px;
        }

        .materia-item {
            background: #f8f9fa;
            padding: 10px;
            margin: 5px 0;
            border-left: 4px solid #28a745;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
        }

        .materia-nombre {
            font-weight: bold;
            color: #333;
        }

        .materia-creditos {
            color: #666;
            font-size: 0.9em;
        }

        .materia-nota {
            background: #28a745;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-weight: bold;
        }

        .materia-nota.alta {
            background: #28a745;
        }

        .materia-nota.media {
            background: #ffc107;
        }

        .materia-nota.baja {
            background: #dc3545;
        }

        .no-materias {
            color: #999;
            font-style: italic;
        }

        .badge {
            background: #007bff;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <h1>📚 Sistema de Gestión de Alumnos y Materias</h1>

    @if($alumnos->isEmpty())
    <p class="no-materias">No hay alumnos registrados.</p>
    @else
    @foreach($alumnos as $alumno)
    <div class="alumno-card">
        <div class="alumno-header">
            <div>
                <div class="alumno-nombre">{{ $alumno->nombre }}</div>
                <div class="alumno-info">
                    📧 {{ $alumno->email ?? 'Sin email' }} |
                    👤 {{ $alumno->edad ?? 'N/A' }} años
                </div>
            </div>
            <span class="badge">{{ $alumno->materias->count() }} materias</span>
        </div>

        <div class="materias-list">
            <strong>Materias cursadas:</strong>
            @if($alumno->materias->isEmpty())
            <p class="no-materias">No está inscrito en ninguna materia</p>
            @else
            @foreach($alumno->materias as $materia)
            <div class="materia-item">
                <div>
                    <span class="materia-nombre">{{ $materia->nombre_materia }}</span>
                    <span class="materia-creditos">({{ $materia->creditos }} créditos)</span>
                </div>
                <div>
                    @if($materia->pivot->nota)
                    <span class="materia-nota {{ $materia->pivot->nota >= 9 ? 'alta' : ($materia->pivot->nota >= 7 ? 'media' : 'baja') }}">
                        Nota: {{ $materia->pivot->nota }}
                    </span>
                    @else
                    <span class="materia-nota">Sin nota</span>
                    @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
    @endif
</body>

</html>