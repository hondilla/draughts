<?php declare(strict_types=1);

namespace Hondilla\Utils\Models;

class ConcreteCoordinate extends Coordinate
{
    public function isNull(): bool
    {
        return false;
    }

    public function getDirection(Coordinate $coordinate): Direction
    {
        return match (true) {
            $this->equals($coordinate) => Direction::NULL,
            $this->inHorizontal($coordinate) => Direction::HORIZONTAL,
            $this->inVertical($coordinate) => Direction::VERTICAL,
            $this->inMainDiagonal($coordinate) => Direction::MAIN_DIAGONAL,
            $this->inInverseDiagonal($coordinate) => Direction::INVERSE_DIAGONAL,
            default => Direction::NULL
        };
    }

    public function inHorizontal(Coordinate $coordinate): bool
    {
        if ($coordinate->isNull()) { return false; }
        return $this->row === $coordinate->getRow();
    }

    public function inVertical(Coordinate $coordinate): bool
    {
        if ($coordinate->isNull()) { return false; }
        return $this->column === $coordinate->getColumn();

    }

    public function inMainDiagonal(Coordinate $coordinate): bool
    {
        if ($coordinate->isNull()) { return false; }
        return $this->mainDiagonal() === $coordinate->mainDiagonal();
    }

    public function mainDiagonal(): int
    {
        return $this->getRow() - $this->getColumn();
    }

    public function inInverseDiagonal(Coordinate $coordinate): bool
    {
        if ($coordinate->isNull()) { return false; }
        return $this->mainDiagonal() === $coordinate->inverseDiagonal();
    }

    public function inverseDiagonal(): int
    {
        return $this->getRow() + $this->getColumn();
    }

    public function getVerticalDistance(Coordinate $coordinate): int
    {
		assert(!$coordinate->isNull());
		return abs($this->row - $coordinate->getRow());
	}

    public function getHorizontalDistance(Coordinate $coordinate): int
    {
        assert(!$coordinate->isNull());
        return abs($this->column - $coordinate->getColumn());
    }

	public function sum(Coordinate $coordinate): void
    {
        assert(!$coordinate->isNull());
		$this->row += $coordinate->getRow();
		$this->column += $coordinate->getColumn();
	}

	public function getRow(): int
    {
		return $this->row;
	}

	public function getColumn(): int
    {
		return $this->column;
	}

    public function hashCode(): int
    {
		$prime = 31;
		$result = 1;
		$result = $prime * $result + $this->column;
		return $prime * $result + $this->row;
	}

    public function equals(object $obj): bool
    {
        if ($this === $obj) { return true; }
        if (get_class($this) !== get_class($obj)) { return false; }
        if ($this->column !== $obj->column) { return false; }
        if ($this->row !== $obj->row) { return false; }
		return true;
	}

    public function toString(): string
    {
		return "Coordinate ({$this->row}, {$this->column})";
	}
}
