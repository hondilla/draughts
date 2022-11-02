<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;

class Game
{
    private Board $board;
    private Turn $turn;

    public function __construct()
    {
        $this->board = new Board();
        $this->turn = new Turn($this->board);
    }

    public function reset(): void
    {
        $this->board->reset();
        $this->turn->reset();
    }

    public function movePiece(Coordinate $origin, Coordinate $target): void
    {
        $this->turn->movePiece($origin, $target);
    }

    public function getOriginError(Coordinate $coordinate): Error
    {
        return $this->turn->getOriginError($coordinate);
    }

    public function getTargetError(Coordinate $origin, Coordinate $target): Error
    {
        return $this->turn->getTargetError($origin, $target);
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
        return $this->turn->getActiveColor();
    }

    public function isWinner(): bool
    {
        return $this->board->isWinner($this->getActiveColor());
    }

    public function next(): void
    {
        $this->turn->next();
    }
}
