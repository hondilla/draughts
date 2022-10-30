<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;

class Player
{
    public function __construct(private Color $color, private Board $board)
    {
    }
}