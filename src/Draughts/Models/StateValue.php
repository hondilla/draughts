<?php

namespace Hondilla\Draughts\Models;

enum StateValue
{
    case INITIAL;
    case IN_GAME;
    case RESUME;
    case EXIT;

    public function ordinal(): int
    {
    }
}
