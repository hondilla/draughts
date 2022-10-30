<?php

namespace Hondilla\Draughts\Controllers;

use Hondilla\Draughts\Models\Game;
use Hondilla\Draughts\Models\State;
use Hondilla\Draughts\Types\Coordinate;

abstract class Controller
{
    public function __construct(protected Game $game, protected State $state)
    {
    }

    public function nextState(): void
    {
        $this->state->next();
    }

    public function getCode(Coordinate $coordinate): string
    {
        return $this->game->getCode($coordinate);
    }

    abstract public function accept(ControllersVisitor $controllersVisitor): void;
}
