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

    public function getOrthogonalVector(Coordinate $coordinate): Coordinate
    {
        return new Coordinate(
            $coordinate->getRow() > $this->getRow() ? 1 : -1,
            $coordinate->getColumn() > $this->getColumn() ? 1 : -1
        );
    }

    public function getDiagonalCoordinates(Coordinate $orthogonalVector): array
    {
        $diagonalCoordinates = [];
        $coordinate = $this->clone();
        $coordinate->sum($orthogonalVector);
        for ($i = 0; $i < $this->getDimension() && $coordinate->isValid(); $i++) {
            $diagonalCoordinates[$i] = $coordinate->clone();
            $coordinate->sum($orthogonalVector);
        }
        return $diagonalCoordinates;
    }

    public function clone(): Coordinate
    {
        return new Coordinate($this->getRow(), $this->getColumn());
    }

    public function getDimension(): int
    {
        return self::$dimension;
    }
}
