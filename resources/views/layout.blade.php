<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Retro Games') - Catálogo de Videojuegos Clásicos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --accent-color: #F7931E;
            --dark-bg: #1a1a2e;
            --light-bg: #16213e;
            --text-light: #eaeaea;
            --text-dark: #1a1a2e;
            --border-radius: 12px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--light-bg) 100%);
            color: var(--text-light);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            padding: 1.5rem 2rem;
            border-bottom: 3px solid var(--primary-color);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 8px 32px rgba(255, 107, 53, 0.1);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-menu {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .navbar-menu a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
        }

        .navbar-menu a:hover {
            color: var(--primary-color);
            background: rgba(255, 107, 53, 0.1);
            transform: translateY(-2px);
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Page Title */
        .page-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-title h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(255, 107, 53, 0.2);
        }

        .page-title p {
            color: #999;
            font-size: 1.1rem;
        }

        /* Decorative lines */
        .decorative-line {
            display: inline-block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), transparent);
            margin: 0 auto 2rem;
            border-radius: 2px;
        }

        /* Grid */
        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Game Card */
        .game-card {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 107, 53, 0.3);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .game-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(255, 107, 53, 0.2), inset 0 0 20px rgba(255, 107, 53, 0.05);
        }

        .game-card:hover::before {
            opacity: 1;
        }

        .game-icon {
            font-size: 4rem;
            text-align: center;
            margin-bottom: 1rem;
            display: block;
        }

        .game-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--text-light);
        }

        .game-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.85rem;
        }

        .game-badge {
            background: rgba(255, 107, 53, 0.2);
            color: var(--accent-color);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
            border: 1px solid rgba(255, 107, 53, 0.3);
        }

        .game-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .stars {
            color: var(--accent-color);
        }

        .game-description {
            color: #aaa;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
            font-size: 1rem;
        }

        .btn:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 107, 53, 0.2);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .games-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .page-title h1 {
                font-size: 2rem;
            }

            .navbar-menu {
                gap: 1rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .game-card {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .game-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .game-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .game-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        .game-card:nth-child(5) {
            animation-delay: 0.4s;
        }

        .game-card:nth-child(6) {
            animation-delay: 0.5s;
        }

        .game-card:nth-child(7) {
            animation-delay: 0.6s;
        }

        .game-card:nth-child(8) {
            animation-delay: 0.7s;
        }

        /* Scroll bar styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('games.index') }}" class="navbar-brand">
                🎮 RETRO GAMES
            </a>
            <ul class="navbar-menu">
                <li><a href="{{ route('games.index') }}">Inicio</a></li>
                <li><a href="#juegos">Juegos</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <script>
        // Animación de scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>