<?php declare(strict_types=1);

namespace Hondilla\Utils\Models;

abstract class SquareBoundedCoordinate
{
    private Coordinate $adaptee;

    public function __construct(int $row, int $column)
    {
        $this->adaptee = new ConcreteCoordinate($row, $column);

        assert($this->isValid());
    }

    public function isNull(): bool
    {
        return $this->adaptee->isNull();
    }

    public function isValid(): bool
    {
        assert(!$this->adaptee->isNull());
        return $this->getLimits()->isIncluded($this->adaptee->getRow())
            && $this->getLimits()->isIncluded($this->adaptee->getColumn());
    }

    public function getLimits(): ClosedInterval
    {
        return new ClosedInterval(0, $this->getDimension() - 1);
    }

    abstract protected function getDimension(): int;

    public function getDirection(SquareBoundedCoordinate $coordinate): Direction
    {
        if ($this->equals($coordinate) || $this->isNull() || $coordinate->isNull()) {
            return Direction::NULL;
        }
        return $this->adaptee->getDirection($coordinate->adaptee);
    }

    public function getVerticalDistance(SquareBoundedCoordinate $coordinate): int {
		assert(!$this->adaptee->isNull());

		return $this->adaptee->getVerticalDistance(new ConcreteCoordinate($coordinate->getRow(), $coordinate->getColumn()));
	}

    public function sum(ConcreteCoordinate $coordinate): void
    {
        assert(!$this->adaptee->isNull());
        $this->adaptee->sum(new ConcreteCoordinate($coordinate->getRow(), $coordinate->getColumn()));
    }

    public function random(): void
    {
        $this->adaptee = new ConcreteCoordinate(
            random_int(0, $this->getDimension()),
            random_int(0, $this->getDimension())
        );
    }

    public function equals(object $obj): bool
    {
        if ($this === $obj) { return true; }
        if (get_class($this) !== get_class($obj)) { return false; }
        if ($this->adaptee !== $obj->adaptee) { return false; }
        return true;
    }

    public function getRow(): int
    {
        assert(!$this->adaptee->isNull());
        return $this->adaptee->getRow();
    }

    public function getColumn(): int
    {
        assert(!$this->adaptee->isNull());
        return $this->adaptee->getColumn();
    }
}
