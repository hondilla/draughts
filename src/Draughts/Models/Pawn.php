<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;

class Pawn extends Piece
{
    private static int $maxMoveDistance = 1;
    private static int $maxJumpDistance = 2;

    public function isTooFarMove(Coordinate $origin, Coordinate $target): bool
    {
        return $origin->getVerticalDistance($target) > self::$maxMoveDistance;
    }

    public function isTooFarJump(Coordinate $origin, Coordinate $target): bool
    {
        return $origin->getVerticalDistance($target) > self::$maxJumpDistance;
    }

    public function isFinalRow(Coordinate $coordinate): bool
    {
        return ($this->color === Color::WHITE
                && $coordinate->getRow() === 0)
            || ($this->color === Color::BLACK
                && $coordinate->getRow() === Coordinate::$dimension - 1);
    }

    public function isValidWay(Coordinate $origin, Coordinate $target): bool
    {
        $orthogonalVector = $origin->getOrthogonalVector($target);
        return ($this->color === Color::BLACK && $orthogonalVector->getRow() === 1) ||
            ($this->color === Color::WHITE && $orthogonalVector->getRow() === -1);
    }

    public function getChildOrthogonalVectors(): array
    {
        $orthogonalVectors = [];
        $vertical = 1;
        if ($this->color === Color::WHITE) {
            $vertical = -1;
        }
        $this->getOrthogonalVectors($orthogonalVectors, $vertical);
        return $orthogonalVectors;
    }

    public function isNull(): bool
    {
        return false;
    }
}