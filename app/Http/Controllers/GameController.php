<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    // Datos estáticos simulando una base de datos
    private static $games = [
        [
            'id' => 1,
            'title' => 'Super Mario Bros',
            'year' => 1985,
            'platform' => 'NES',
            'genre' => 'Plataformas',
            'rating' => 9.0,
            'image' => '/images/mario.svg',
            'description' => 'El clásico que enganchó a millones: saltos, tuberías y mucha diversión.'
        ],
        [
            'id' => 2,
            'title' => 'The Legend of Zelda',
            'year' => 1986,
            'platform' => 'NES',
            'genre' => 'Aventura',
            'rating' => 8.9,
            'image' => '/images/zelda.svg',
            'description' => 'Explora mazmorras, recoge objetos y descubre secretos a tu ritmo.'
        ],
        [
            'id' => 3,
            'title' => 'Pac-Man',
            'year' => 1980,
            'platform' => 'Arcade',
            'genre' => 'Laberintos',
            'rating' => 8.5,
            'image' => '/images/pacman.svg',
            'description' => 'Come puntos, esquiva fantasmas y pelea por la mejor puntuación.'
        ],
        [
            'id' => 4,
            'title' => 'Space Invaders',
            'year' => 1978,
            'platform' => 'Arcade',
            'genre' => 'Disparos',
            'rating' => 8.3,
            'image' => '/images/space-invaders.svg',
            'description' => 'Dispara a las filas alien y aguanta el máximo tiempo posible.'
        ],
        [
            'id' => 5,
            'title' => 'Donkey Kong',
            'year' => 1981,
            'platform' => 'Arcade',
            'genre' => 'Plataformas',
            'rating' => 8.7,
            'image' => '/images/donkey-kong.svg',
            'description' => 'Sube pisos, esquiva barriles y siente la tensión del arcade clásico.'
        ],
        [
            'id' => 6,
            'title' => 'Tetris',
            'year' => 1984,
            'platform' => 'Game Boy',
            'genre' => 'Puzzles',
            'rating' => 8.8,
            'image' => '/images/tetris.svg',
            'description' => 'Encaja piezas rápido: simple, adictivo y genial para cualquier partida corta.'
        ],
        [
            'id' => 7,
            'title' => 'Sonic the Hedgehog',
            'year' => 1991,
            'platform' => 'Mega Drive',
            'genre' => 'Plataformas',
            'rating' => 8.6,
            'image' => '/images/sonic.svg',
            'description' => 'Velocidad y actitud: niveles rápidos y con mucha personalidad.'
        ],
        [
            'id' => 8,
            'title' => 'Street Fighter II',
            'year' => 1991,
            'platform' => 'Arcade',
            'genre' => 'Lucha',
            'rating' => 8.9,
            'image' => '/images/street-fighter.svg',
            'description' => 'Combates rápidos, personajes memorables y partidas para recordar.'
        ],
    ];

    // Consolas y sus juegos influyentes (simplificado)
    private static $consoles = [
        [
            'slug' => 'atari-2600',
            'name' => 'Atari 2600',
            'image' => '/images/consoles/atari-2600.svg',
            'games' => [
                ['title' => 'Pong', 'year' => 1972, 'image' => '/images/games/pong.svg'],
                ['title' => 'Adventure', 'year' => 1979, 'image' => '/images/games/adventure.svg'],
            ]
        ],
        [
            'slug' => 'nes',
            'name' => 'NES',
            'image' => '/images/consoles/nes.svg',
            'games' => [
                ['title' => 'Super Mario Bros', 'year' => 1985, 'image' => '/images/mario.svg'],
                ['title' => 'The Legend of Zelda', 'year' => 1986, 'image' => '/images/zelda.svg'],
            ]
        ],
        [
            'slug' => 'snes',
            'name' => 'SNES',
            'image' => '/images/consoles/snes.svg',
            'games' => [
                ['title' => 'Super Mario World', 'year' => 1990, 'image' => '/images/games/smw.svg'],
                ['title' => 'Chrono Trigger', 'year' => 1995, 'image' => '/images/games/chronotrigger.svg'],
            ]
        ],
        [
            'slug' => 'mega-drive',
            'name' => 'Mega Drive',
            'image' => '/images/consoles/mega-drive.svg',
            'games' => [
                ['title' => 'Sonic the Hedgehog', 'year' => 1991, 'image' => '/images/sonic.svg'],
                ['title' => 'Shinobi', 'year' => 1989, 'image' => '/images/games/shinobi.svg'],
            ]
        ],
        [
            'slug' => 'game-boy',
            'name' => 'Game Boy',
            'image' => '/images/consoles/game-boy.svg',
            'games' => [
                ['title' => 'Tetris', 'year' => 1989, 'image' => '/images/tetris.svg'],
                ['title' => 'Pokémon Red', 'year' => 1996, 'image' => '/images/games/pokemon-red.svg'],
            ]
        ],
        [
            'slug' => 'playstation',
            'name' => 'PlayStation',
            'image' => '/images/consoles/playstation.svg',
            'games' => [
                ['title' => 'Final Fantasy VII', 'year' => 1997, 'image' => '/images/games/ff7.svg'],
                ['title' => 'Metal Gear Solid', 'year' => 1998, 'image' => '/images/games/mgs.svg'],
            ]
        ],
        [
            'slug' => 'psp',
            'name' => 'PSP',
            'image' => '/images/consoles/psp.svg',
            'games' => [
                ['title' => 'God of War: Chains of Olympus', 'year' => 2008, 'image' => '/images/games/gow-cop.svg'],
                ['title' => 'Crisis Core: Final Fantasy VII', 'year' => 2007, 'image' => '/images/games/crisis-core.svg'],
            ]
        ],
    ];

    /**
     * Muestra la lista general de juegos
     */
    public function index()
    {
        $games = self::$games;
        $consoles = self::$consoles;
        return view('games.index', ['games' => $games, 'consoles' => $consoles]);
    }

    /**
     * Muestra el detalle de un juego específico
     */
    public function show($id)
    {
        $game = collect(self::$games)->firstWhere('id', $id);

        if (!$game) {
            abort(404, 'Juego no encontrado');
        }

        return view('games.show', ['game' => $game]);
    }

    /**
     * Lista de juegos — opcionalmente filtrada por consola (query param `console`)
     */
    public function list(Request $request)
    {
        $slug = $request->query('console');
        $consoles = self::$consoles;
        $games = self::$games;
        $selectedConsole = null;
        $filtered = [];

        if ($slug) {
            $selectedConsole = collect(self::$consoles)->firstWhere('slug', $slug);
            if ($selectedConsole) {
                foreach ($selectedConsole['games'] as $g) {
                    $match = collect(self::$games)->firstWhere('title', $g['title']);
                    if ($match) {
                        $filtered[] = $match;
                    } else {
                        $filtered[] = array_merge([
                            'id' => null,
                            'platform' => $selectedConsole['name'],
                            'genre' => '',
                            'rating' => 0,
                            'description' => ''
                        ], $g);
                    }
                }
            }
        }

        return view('games.index', [
            'games' => count($filtered) ? $filtered : $games,
            'consoles' => $consoles,
            'selectedConsole' => $selectedConsole,
        ]);
    }

    /**
     * Vista jugable (solo disponible para Mario - id = 1)
     */
    // La función play se eliminó según petición del usuario
}
