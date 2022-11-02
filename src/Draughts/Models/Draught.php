<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;

class Draught extends Piece
{
    public function getChildOrthogonalVectors(): array
    {
        $orthogonalVectors = [];
        foreach (array(0 => 1, 1 => -1) as $vertical) {
            $this->getOrthogonalVectors($orthogonalVectors, $vertical);
        }
        return $orthogonalVectors;
    }

    public function isValidWay(Coordinate $origin, Coordinate $target): bool
    {
        return true;
    }

    public function isNull(): bool
    {
        return false;
    }

    public function isTooFarMove(Coordinate $origin, Coordinate $target): bool
    {
        return false;
    }

    public function isTooFarJump(Coordinate $origin, Coordinate $target): bool
    {
        return false;
    }

    public function isFinalRow(Coordinate $coordinate): bool
    {
        return false;
    }
}