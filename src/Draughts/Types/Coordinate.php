<?php

namespace Hondilla\Draughts\Types;

use Hondilla\Utils\Models\SquareBoundedCoordinate;

class Coordinate extends SquareBoundedCoordinate
{
    public static int $dimension = 8;

    public function isInitialPiecePosition(): bool
    {
        return ($this->getRow() + $this->getColumn()) % 2 !== 0;
    }

    protected function getDimension(): int
    {
        return static::$dimension;
    }
}
