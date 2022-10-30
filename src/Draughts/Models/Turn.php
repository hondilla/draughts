<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;

class Turn
{
    public static int $NUMBER_PLAYERS = 2;
    private array $players;
    private int $activePlayer;

    public function __construct(private Board $board)
    {
        $this->reset();
    }

    private function reset(): void
    {
        for ($i = 0; $i < self::$NUMBER_PLAYERS; $i++) {
            $this->players[$i] = new Player(Color::get($i), $this->board);
        }
        $this->activePlayer = 0;
    }
}