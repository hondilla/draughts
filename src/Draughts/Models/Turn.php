<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;

class Turn
{
    public static int $numPlayers = 2;
    private array $players;
    private int $activePlayer;

    public function __construct(private readonly Board $board)
    {
        $this->players = [];
        $this->reset();
    }

    public function reset(): void
    {
        for ($i = 0; $i < self::$numPlayers; $i++) {
            $this->players[$i] = new Player(Color::get($i), $this->board);
        }
        $this->activePlayer = 0;
    }

    public function movePiece(Coordinate $origin, Coordinate $target): void
    {
        $this->players[$this->activePlayer]->movePiece($origin, $target);
    }

    public function getOriginError(Coordinate $coordinate): Error
    {
        return $this->players[$this->activePlayer]->getOriginError($coordinate);
    }

    public function getTargetError(Coordinate $origin, Coordinate $target): Error
    {
        return $this->players[$this->activePlayer]->getTargetError($origin, $target);
    }

    public function getCode(Coordinate $coordinate): string
    {
        return $this->board->getCode($coordinate);
    }

    public function isFinished(): bool
    {
        return $this->board->isFinished($this->getActiveColor());
    }

    public function getActiveColor(): Color
    {
        return $this->players[$this->activePlayer]->getActiveColor();
    }

    public function isWinner(): bool
    {
        return $this->board->isWinner($this->getActiveColor());
    }

    public function next(): void
    {
        $this->activePlayer = ($this->activePlayer + 1) % self::$numPlayers;
    }
}
