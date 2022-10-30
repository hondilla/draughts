<?php

namespace Hondilla\Draughts\Models;


use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;

class Board
{
    private array $pieces;

    public function __construct()
    {
        $this->pieces[Coordinate::$dimension][Coordinate::$dimension] = null;
        $this->reset();
    }

    public function reset(): void
    {
        for ($i = 0; $i < Coordinate::$dimension; $i++) {
            for ($j = 0; $j < Coordinate::$dimension; $j++) {
                $color = Color::getInitialColor(new Coordinate($i, $j));
                $piece = null;
                if (!$color->isNull()) {
                    $piece = new Pawn($color);
                }
                $this->pieces[$i][$j] = $piece;
            }
        }
    }

    public function getPiece(Coordinate $coordinate): Piece
    {
        return $this->pieces[$coordinate->getRow()][$coordinate->getColumn()];
    }

    public function getCode(Coordinate $coordinate): string
    {
        return $this->getPiece($coordinate)->getCode();
    }
}