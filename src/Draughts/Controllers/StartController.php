<?php

namespace Hondilla\Draughts\Controllers;

use Hondilla\Draughts\Models\Game;
use Hondilla\Draughts\Models\State;

class StartController extends Controller
{
    public function accept(ControllersVisitor $controllersVisitor): void
    {
        $controllersVisitor->visitStartController($this);
    }
}
