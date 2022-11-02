<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;

abstract class Piece
{
    public static Piece $NULL = NullPiece::getInstance();

    public function __construct(protected Color $color)
    {
    }

    abstract public function isNull(): bool;

    public function getMoveTargetError(Coordinate $origin, Coordinate $target): Error
    {
        if ($this->isTooFarMove($origin, $target)) {
            return Error::TOO_FAR;
        }
        return $this->getNotValidWayError($origin, $target);
    }

    abstract public function isTooFarMove(Coordinate $origin, Coordinate $target): bool;

    private function getNotValidWayError(Coordinate $origin, Coordinate $target): Error
    {
        if (!$this->isValidWay($origin, $target)) {
            return Error::NOT_VALID_WAY;
        }
        return Error::NULL;
    }

    abstract public function isValidWay(Coordinate $origin, Coordinate $target): bool;

    public function getJumpTargetError(Coordinate $origin, Coordinate $target): Error
    {
        if ($this->isTooFarJump($origin, $target)) {
            return Error::TOO_FAR;
        }
        return $this->getNotValidWayError($origin, $target);
    }

    abstract public function isTooFarJump(Coordinate $origin, Coordinate $target): bool;

    abstract public function isFinalRow(Coordinate $coordinate): bool;

    public function getColor(): Color
    {
        return $this->color;
    }

    public function getDiagonalCoordinates(Coordinate $origin): array
    {
        $diagonalCoordinates = [];
        foreach ($this->getChildOrthogonalVectors() as $coordinate) {
            foreach ($origin->getDiagonalCoordinates($coordinate) as $coordinateDiagonal) {
                $diagonalCoordinates[] = $coordinateDiagonal;
            }
        }
        return $diagonalCoordinates;
    }

    abstract public function getChildOrthogonalVectors(): array;

    public function getOrthogonalVectors(array $orthogonalVectors, int $vertical): array
    {
        $horizontals = array(0 => 1, 1 => -1);
        foreach ($horizontals as $horizontal) {
            $orthogonalVectors[] = new Coordinate($vertical, $horizontal);
        }
        return $orthogonalVectors;
    }

    public function getCode(): string
    {
        return $this->color->getInitial();
    }
}