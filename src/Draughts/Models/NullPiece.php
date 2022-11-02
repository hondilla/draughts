<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;

class NullPiece extends Piece
{
    private static NullPiece $instance;

    private function __construct()
    {
        parent::__construct(Color::NULL);
    }

    static function getInstance(): NullPiece
    {
        if (self::$instance === null) {
            self::$instance = new NullPiece();
        }
        return self::$instance;
    }

    public function isNull(): bool
    {
        return true;
    }

    public function getChildOrthogonalVectors(): array
    {
        return [];
    }

    public function isValidWay(Coordinate $origin, Coordinate $target): bool
    {
        return false;
    }

    public function isTooFarMove(Coordinate $origin, Coordinate $target): bool
    {
        return true;
    }

    public function isTooFarJump(Coordinate $origin, Coordinate $target): bool
    {
        return true;
    }

    public function isFinalRow(Coordinate $coordinate): bool
    {
        return false;
    }
}
