<?php

namespace Tests\Utils\Models;

use Hondilla\Utils\Models\ClosedInterval;
use Hondilla\Utils\Models\ConcreteCoordinate;
use Hondilla\Utils\Models\Coordinate;
use Hondilla\Utils\Models\Direction;
use PHPUnit\Framework\TestCase;

class ConcreteCoordinateTest extends TestCase
{
    private Coordinate $coordinate;

    protected function setUp(): void
    {
        $this->coordinate = new ConcreteCoordinate(1, 1);
    }

    public function testGivenCoordinateWhenIsNullThenIsFalse(): void
    {
        $this->assertFalse($this->coordinate->isNull());
    }

    public function testGivenCoordinateWhenGetDirectionThenValue(): void
    {
        $this->assertSame(Direction::HORIZONTAL, $this->coordinate->getDirection(new ConcreteCoordinate(1, 2)));
        $this->assertSame(Direction::VERTICAL, $this->coordinate->getDirection(new ConcreteCoordinate(2, 1)));
        $this->assertSame(Direction::MAIN_DIAGONAL, $this->coordinate->getDirection(new ConcreteCoordinate(0, 0)));
        $this->assertSame(Direction::NULL, $this->coordinate->getDirection(new ConcreteCoordinate(0, 2)));
        $this->assertSame(Direction::NULL, $this->coordinate->getDirection($this->coordinate));
    }

    public function testGivenCoordinateWhenInHorizontalThenValue(): void
    {
        $this->assertTrue($this->coordinate->inHorizontal(new ConcreteCoordinate(1, 2)));
        $this->assertFalse($this->coordinate->inHorizontal(new ConcreteCoordinate(0, 0)));
    }

    public function testGivenCoordinateWhenInVerticalThenValue(): void
    {
        $this->assertFalse($this->coordinate->inVertical(new ConcreteCoordinate(1, 0)));
        $this->assertTrue($this->coordinate->inVertical(new ConcreteCoordinate(2, 1)));
    }

    public function testGivenCoordinateWhenIsEqualsThenReturn(): void
    {
        $this->assertTrue($this->coordinate->equals(new ConcreteCoordinate(1, 1)));
        $this->assertFalse($this->coordinate->equals(new ConcreteCoordinate(0, 1)));
    }

    public function testGivenCoordinateWhenToStringThenReturn(): void
    {
        $this->assertSame("Coordinate (1, 1)", $this->coordinate->toString());
    }
}