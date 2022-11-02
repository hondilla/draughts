<?php

namespace Hondilla\Draughts\Controllers;

use Hondilla\Draughts\Models\Game;
use Hondilla\Draughts\Models\State;
use Hondilla\Draughts\Models\StateValue;

class Logic
{
    private State $state;
    private array $controllers;

    public function __construct(private readonly Game $game)
    {
        $this->state = new State();
        $this->controllers = array(
            StateValue::INITIAL->name => new StartController($this->game, $this->state),
            StateValue::IN_GAME->name => new PlayController($this->game, $this->state),
            StateValue::RESUME->name => new ResumeController($this->game, $this->state),
            StateValue::EXIT->name => null
        );
    }

    public function getController(): Controller
    {
        return $this->controllers[$this->state->getValueState()->name];
    }

}
