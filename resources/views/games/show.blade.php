@extends('layout')

@section('title', $game['title'] . ' - Retro Games')

@section('content')
<div class="container">
    <!-- Back Button -->
    <a href="{{ route('games.index') }}" class="btn btn-secondary" style="max-width: 200px; margin-bottom: 2rem;">
        ← Volver al Catálogo
    </a>

    <!-- Game Details -->
    <div style="background: rgba(255,255,255,0.05); border: 2px solid rgba(255,107,53,0.3); border-radius: 12px; padding: 3rem; backdrop-filter: blur(10px);">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
            <!-- Game Icon -->
            <div style="text-align: center;">
                <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" style="width:240px;height:160px;object-fit:cover;border-radius:12px;margin-bottom:2rem;" />
            </div>

            <!-- Game Info -->
            <div>
                <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--text-light);">{{ $game['title'] }}</h1>

                <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
                    <span class="game-badge">{{ $game['platform'] }}</span>
                    <span class="game-badge">{{ $game['year'] }}</span>
                    <span class="game-badge">{{ $game['genre'] }}</span>
                </div>

                <div class="game-rating" style="font-size: 1.3rem; margin-bottom: 2rem;">
                    <span class="stars">★★★★★</span>
                    <span>{{ number_format($game['rating'], 1) }}/10</span>
                </div>

                <p style="font-size: 1.1rem; color: #ccc; line-height: 1.8; margin-bottom: 2rem;">
                    {{ $game['description'] }}
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">PLATAFORMA</p>
                        <p style="font-size: 1.2rem; font-weight: bold;">{{ $game['platform'] }}</p>
                    </div>
                    <div>
                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">AÑO DE LANZAMIENTO</p>
                        <p style="font-size: 1.2rem; font-weight: bold;">{{ $game['year'] }}</p>
                    </div>
                    <div>
                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">GÉNERO</p>
                        <p style="font-size: 1.2rem; font-weight: bold;">{{ $game['genre'] }}</p>
                    </div>
                    <div>
                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">VALORACIÓN</p>
                        <p style="font-size: 1.2rem; font-weight: bold; color: var(--primary-color);">{{ number_format($game['rating'], 1) }}/10</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsive adjustment -->
        @media (max-width: 768px) {
        <style>
            .game-details {
                grid-template-columns: 1fr !important;
            }
        </style>
        }
    </div>

    <!-- Más juegos que te pueden gustar -->
    <div style="margin-top: 4rem;">
        <h2 style="font-size: 2rem; margin-bottom: 2rem; color: var(--text-light);">Otros clásicos que quizá te interesen</h2>
        <a href="{{ route('games.index') }}" class="btn">
            Volver al listado
        </a>
    </div>
</div>
@endsection