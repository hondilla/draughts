<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;

class Board
{
    private array $pieces;

    public function __construct()
    {
        $this->pieces = [];
        for ($i = 0; $i < Coordinate::$dimension; $i++) {
            $this->pieces[$i] = [];
        }
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

    public function movePiece(Coordinate $origin, Coordinate $target): void
    {
        $piece = $this->getPiece($origin);
        $this->putPiece($origin, Piece::$NULL);
        if ($piece->isFinalRow($target)) {
            $piece = new Draught($piece->getColor());
        }
        $this->putPiece($target, $piece);
        $this->removePiecesInBetween($origin, $target);
    }

    public function getPiece(Coordinate $coordinate): Piece
    {
        return $this->pieces[$coordinate->getRow()][$coordinate->getColumn()];
    }

    public function putPiece(Coordinate $coordinate, Piece $piece): void
    {
        $this->pieces[$coordinate->getRow()][$coordinate->getColumn()] = $piece;
    }

    public function getColor(Coordinate $coordinate): Color
    {
        return $this->getPiece($coordinate)->getColor();
    }

    private function removePiecesInBetween(Coordinate $origin, Coordinate $target): void
    {
        $coordinate = $origin->clone();
        $coordinate->sum($origin->getOrthogonalVector($target));
        while (!$coordinate->equals($target)) {
            $this->putPiece($coordinate, Piece::$NULL);
            $coordinate->sum($origin->getOrthogonalVector($target));
        }
    }

    public function getCode(Coordinate $coordinate): string
    {
        return $this->getPiece($coordinate)->getCode();
    }

    public function isFinished(Color $activeColor): bool
    {
        return $this->isWinner($activeColor) ||
            ($this->isBlockedColor($activeColor) && $this->isBlockedColor($activeColor->opposite()));
    }

    public function isWinner(Color $activeColor): bool
    {
        for ($i = 0; $i < Coordinate::$dimension; $i++) {
            for ($j = 0; $j < Coordinate::$dimension; $j++) {
                $color = $this->getPiece(new Coordinate($i, $j))->getColor();
                if ($color === $activeColor->opposite()) {
                    return false;
                }
            }
        }
        return true;
    }

    public function isBlockedColor(Color $color): bool
    {
        for ($i = 0; $i < Coordinate::$dimension; $i++) {
            for ($j = 0; $j < Coordinate::$dimension; $j++) {
                $coordinate = new Coordinate($i, $j);
                if (!$this->isEmpty($coordinate) && !$this->isBlockedCoordinate($coordinate)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function isBlockedCoordinate(Coordinate $coordinate): bool
    {
        $piece = $this->getPiece($coordinate);
        $diagonalCoordinates = $piece->getDiagonalCoordinates($coordinate);
        foreach ($diagonalCoordinates as $iValue) {
            if ($this->getTargetError($coordinate, $iValue)->isNull()) {
                return false;
            }
        }
        return true;
    }

    public function getTargetError(Coordinate $origin, Coordinate $target): Error
    {
        if (!$this->isEmpty($target)) {
            return Error::NOT_EMPTY;
        }
        if ($this->areColleaguePiecesInBetween($origin, $target)) {
            return Error::COLLEAGUE_EATING;
        }
        $pieces = $this->getPiecesInBetween($origin, $target);
        if (count($pieces) === 1) {
            return $this->getPiece($origin)->getJumpTargetError($origin, $target);
        } else if (count($pieces) === 0) {
            return $this->getPiece($origin)->getMoveTargetError($origin, $target);
        } else {
            return Error::TOO_MUCH_EATINGS;
        }
    }

    public function isEmpty(Coordinate $coordinate): bool
    {
        return $this->getPiece($coordinate)->isNull();
    }

    private function areColleaguePiecesInBetween(Coordinate $origin, Coordinate $target): bool
    {
        $pieces = $this->getPiecesInBetween($origin, $target);
        foreach ($pieces as $iValue) {
            if ($iValue->getColor() === $this->getColor($origin)) {
                return true;
            }
        }
        return false;
    }

    private function getPiecesInBetween(Coordinate $origin, Coordinate $target): array
    {
        $pieces = [];
        $coordinate = $origin->clone();
        $coordinate->sum($origin->getOrthogonalVector($target));
        while (!$coordinate->equals($target)) {
            if (!$this->isEmpty($coordinate)) {
                $pieces[] = $this->getPiece($coordinate);
            }
            $coordinate->sum($origin->getOrthogonalVector($target));
        }
        return $pieces;
    }
}