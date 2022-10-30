<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;

class Piece
{
    public function __construct(protected Color $color)
    {
    }

    public function getCode(): string
    {
        return $this->color->getInitial();
    }
}