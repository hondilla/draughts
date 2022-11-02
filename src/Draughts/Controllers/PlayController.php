<?php

namespace Hondilla\Draughts\Controllers;

use Hondilla\Draughts\Models\Game;
use Hondilla\Draughts\Models\State;
use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;

class PlayController extends Controller
{
    public function accept(ControllersVisitor $controllersVisitor): void
    {
        $controllersVisitor->visitPlayController($this);
    }

    public function isFinished(): bool
    {
        return $this->game->isFinished();
    }

    public function isWinner(): bool
    {
        return $this->game->isWinner();
    }

    public function next(): void
    {
        $this->game->next();
    }

    public function getActiveColor(): Color
    {
        return $this->game->getActiveColor();
    }

    public function movePiece(Coordinate $origin, Coordinate $target): void
    {
        $this->game->movePiece($origin, $target);
    }

    public function getOriginError(Coordinate $coordinate): Error
    {
        return $this->game->getOriginError($coordinate);
    }

    public function getTargetError(Coordinate $origin, Coordinate $target): Error
    {
        return $this->game->getTargetError($origin, $target);
    }

}
