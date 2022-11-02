<?php

declare(strict_types=1);

namespace Hondilla\Utils\Models;

abstract class SquareBoundedCoordinate extends Coordinate
{
    public function isValid(): bool
    {
        return $this->getLimits()->isIncluded($this->getRow())
            && $this->getLimits()->isIncluded($this->getColumn());
    }

    public function getLimits(): ClosedInterval
    {
        return new ClosedInterval(0, $this->getDimension() - 1);
    }

    abstract protected function getDimension(): int;

    public function getDirection(Coordinate $coordinate): Direction
    {
        if ($this->equals($coordinate)) {
            return Direction::NULL;
        }
        return $this->getDirection($coordinate);
    }

    public function getVerticalDistance(Coordinate $coordinate): int
    {
        return $this->getVerticalDistance(new Coordinate($coordinate->getRow(), $coordinate->getColumn()));
    }

    public function sum(Coordinate $coordinate): void
    {
        $this->sum(new Coordinate($coordinate->getRow(), $coordinate->getColumn()));
    }

    public function random(): void
    {
        $row = random_int(0, $this->getDimension());
        $column = random_int(0, $this->getDimension());
    }

    public function equals(object $obj): bool
    {
        if ($this === $obj) {
            return true;
        }
        if (get_class($this) !== get_class($obj)) {
            return false;
        }
        if ($this->getRow() !== $obj->getRow()) {
            return false;
        }
        if ($this->getColumn() !== $obj->getColumn()) {
            return false;
        }
        return true;
    }
}
