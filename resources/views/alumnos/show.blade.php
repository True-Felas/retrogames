<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Alumno - {{ $alumno->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            border-bottom: 3px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
        }

        .info-value {
            color: #212529;
        }

        .materias-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .materia-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .materia-nombre {
            font-size: 1.3em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .materia-descripcion {
            font-size: 0.9em;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .materia-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        .creditos-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.9em;
        }

        .nota-badge {
            background: white;
            color: #667eea;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .no-materias {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>👨‍🎓 {{ $alumno->nombre }}</h1>

        <div class="info-section">
            <h2 style="margin-top: 0; color: #495057;">Información Personal</h2>
            <div class="info-row">
                <span class="info-label">📧 Email:</span>
                <span class="info-value">{{ $alumno->email ?? 'No registrado' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">👤 Edad:</span>
                <span class="info-value">{{ $alumno->edad ?? 'No especificada' }} años</span>
            </div>
            <div class="info-row">
                <span class="info-label">📚 Total de Materias:</span>
                <span class="info-value">{{ $alumno->materias->count() }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">📊 Promedio General:</span>
                <span class="info-value">
                    @php
                    $notasConValor = $alumno->materias->filter(fn($m) => $m->pivot->nota !== null);
                    $promedio = $notasConValor->isNotEmpty() ? $notasConValor->avg('pivot.nota') : 0;
                    @endphp
                    {{ $notasConValor->isNotEmpty() ? number_format($promedio, 2) : 'Sin notas' }}
                </span>
            </div>
        </div>

        <h2 style="color: #495057;">Materias Cursadas</h2>

        @if($alumno->materias->isEmpty())
        <div class="no-materias">
            Este alumno no está inscrito en ninguna materia
        </div>
        @else
        <div class="materias-grid">
            @foreach($alumno->materias as $materia)
            <div class="materia-card">
                <div class="materia-nombre">{{ $materia->nombre_materia }}</div>
                <div class="materia-descripcion">
                    {{ $materia->descripcion ?? 'Sin descripción' }}
                </div>
                <div class="materia-footer">
                    <span class="creditos-badge">{{ $materia->creditos }} créditos</span>
                    <span class="nota-badge">
                        @if($materia->pivot->nota)
                        {{ $materia->pivot->nota }} / 10
                        @else
                        Sin nota
                        @endif
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <a href="{{ route('alumnos.index') }}" class="back-link">← Volver al listado</a>
    </div>
</body>

</html>