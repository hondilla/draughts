<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;

class Pawn extends Piece
{
    private static int $maxMoveDistance = 1;
    private static int $maxJumpDistance = 2;

    public function __construct(Color $color)
    {
        parent::__construct($color);
    }
}