@extends('layout')

@section('title', 'Catálogo de Juegos Retro')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="page-title">
        <div class="decorative-line"></div>
        <h1>Catálogo de Juegos Retro</h1>
        <p>¿Te apetece un viaje atrás en el tiempo? Aquí tienes algunos clásicos para recordar y disfrutar.</p>
    </div>

    @if(empty($selectedConsole))
    <!-- Consoles Grid -->
    <div id="consolas">
        <div class="games-grid consoles-grid">
            @forelse($consoles as $console)
            <div class="console-card" data-slug="{{ $console['slug'] }}" style="cursor:pointer;">
                <img src="{{ $console['image'] }}" alt="{{ $console['name'] }}" class="game-icon" style="width:100%;height:140px;object-fit:contain;border-radius:8px;margin-bottom:1rem;background:#fff;padding:8px;" />
                <h2 class="game-title">{{ $console['name'] }}</h2>
                <div class="game-meta">
                    <span class="game-badge">{{ count($console['games']) }} juegos</span>
                </div>
                <div class="btn">Ver Catálogo</div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
                <p style="font-size: 1.2rem; color: #999;">No hay consolas disponibles.</p>
            </div>
            @endforelse
        </div>
    </div>
    @else
    <!-- Games list for selected console -->
    <div style="margin-bottom:1rem; display:flex;justify-content:space-between;align-items:center;">
        <h2>{{ $selectedConsole['name'] }} — Catálogo</h2>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">← Volver a Consolas</a>
    </div>
    <div class="games-grid">
        @forelse($games as $game)
        @if(!empty($game['id']))
        <a href="{{ route('games.show', $game['id']) }}" style="text-decoration:none;color:inherit;">
            <div class="game-card">
                <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" class="game-icon" style="width:100%;height:140px;object-fit:cover;border-radius:8px;margin-bottom:1rem;" />
                <h2 class="game-title">{{ $game['title'] }}</h2>
                <div class="game-meta">
                    <span class="game-badge">{{ $game['platform'] ?? $selectedConsole['name'] }}</span>
                    <span class="game-badge">{{ $game['year'] }}</span>
                </div>
                <div class="game-rating"><span>{{ number_format($game['rating'] ?? 0, 1) }}/10</span></div>
                <p class="game-description">{{ $game['description'] ?? '' }}</p>
                <div class="btn">Ver Detalles</div>
            </div>
        </a>
        @else
        <div class="game-card">
            <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" class="game-icon" style="width:100%;height:140px;object-fit:cover;border-radius:8px;margin-bottom:1rem;" />
            <h2 class="game-title">{{ $game['title'] }}</h2>
            <div class="game-meta">
                <span class="game-badge">{{ $selectedConsole['name'] }}</span>
                <span class="game-badge">{{ $game['year'] }}</span>
            </div>
            <p class="game-description">{{ $game['description'] ?? '' }}</p>
        </div>
        @endif
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
            <p style="font-size: 1.2rem; color: #999;">No hay juegos listados para esta consola.</p>
        </div>
        @endforelse
    </div>
    @endif

    <script>
        window.CONSOLES = {
            !!json_encode($consoles) !!
        };
        window.GAMES = {
            !!json_encode($games) !!
        };
    </script>
</div>

<!-- Footer -->
<footer style="background: rgba(0,0,0,0.5); padding: 2rem; text-align: center; color: #999; border-top: 2px solid rgba(255,107,53,0.3); margin-top: 3rem;">
    <p>&copy; 2024 Retro Games. Hecho por estudiantes — si te mola, compártelo con tus colegas. 🎮</p>
</footer>
@endsection