@extends('layout')

@section('title', 'Jugar - ' . $game['title'])

@section('content')
<div class="container">
    <a href="{{ route('games.show', $game['id']) }}" class="btn btn-secondary" style="max-width: 200px; margin-bottom: 1rem;">← Volver a detalles</a>

    <h1 style="color:var(--text-light); margin-bottom: 1rem;">{{ $game['title'] }} — Mundo 1-1 (versión simplificada)</h1>
    <p style="color:#cfcfcf; margin-bottom: 1rem;">Usa las flechas o A/D para moverte, espacio para saltar. Esta es una versión simplificada inspirada en el nivel clásico.</p>

    <div id="game-wrap" style="background: linear-gradient(#9ad3ff, #5a9bd8); padding: 1rem; border-radius:12px;">
        <canvas id="gameCanvas" width="800" height="300" style="display:block; width:100%; max-width:1000px; background:linear-gradient(#87CEEB 0%, #5DADE2 100%); border-radius:8px;"></canvas>
    </div>

    <p style="color:#999; margin-top:1rem;">Nota: Nivel recreado con fines educativos — no contiene assets oficiales.</p>
    @extends('layout')

    @section('title', 'Jugar - Deshabilitado')

    @section('content')
    <div class="container">
        <div style="background: rgba(255,255,255,0.03); border-radius:12px; padding:2rem; text-align:center;">
            <h2 style="color:var(--text-light); margin-bottom:0.5rem;">Funcionalidad deshabilitada</h2>
            <p style="color:#cfcfcf;">La opción de jugar el nivel ya no está disponible en esta versión. Puedes volver a la ficha del juego o explorar otros títulos.</p>
            <a href="{{ route('games.show', $game['id'] ?? 1) }}" class="btn" style="margin-top:1rem; display:inline-block; max-width:220px;">Volver a la ficha</a>
        </div>
    </div>

    @endsection