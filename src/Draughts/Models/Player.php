<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;
use Hondilla\Utils\Models\Direction;

class Player
{
    public function __construct(private Color $color, private Board $board)
    {
    }

    public function movePiece(Coordinate $origin, Coordinate $target): void
    {
        $this->board->movePiece($origin, $target);
    }

    public function getOriginError(Coordinate $coordinate): Error
    {
        if ($this->board->getColor($coordinate) !== $this->color) {
            return Error::NOT_OWNER;
        }
        if ($this->board->isBlockedCoordinate($coordinate)) {
            return Error::BLOCKED_PIECE;
        }
        return Error::NULL;
    }

    public function getColor(): Color
    {
        return $this->color;
    }

    public function getTargetError(Coordinate $origin, Coordinate $target): Error
    {
        if ($origin->equals($target)) {
            return Error::SAME_COORDINATES;
        }
        $direction = $origin->getDirection($target);
        if ($direction !== Direction::MAIN_DIAGONAL &&
            $direction !== Direction::INVERSE_DIAGONAL) {
            return Error::NOT_DIAGONAL;
        }
        return $this->board->getTargetError($origin, $target);
    }
}