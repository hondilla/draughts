<?php

namespace Hondilla\Draughts\Controllers;

use Hondilla\Draughts\Models\Game;
use Hondilla\Draughts\Models\State;

class ResumeController extends Controller
{

    public function __construct(Game $game, State $state)
    {
        parent::__construct($game, $state);
    }

    public function accept(ControllersVisitor $controllersVisitor): void
    {
        $controllersVisitor->visitResumeController($this);
    }

    public function reset(): void
    {
        $this->game->reset();
        $this->state->reset();
    }

}





