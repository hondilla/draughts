<?php

namespace Tests\Utils\Models;

use Hondilla\Utils\Models\Coordinate;
use Hondilla\Utils\Models\Direction;
use PHPUnit\Framework\TestCase;

class CoordinateTest extends TestCase
{
    private Coordinate $coordinate;

    protected function setUp(): void
    {
        $this->coordinate = new Coordinate(1, 1);
    }

    public function testGivenCoordinateWhenGetDirectionThenValue(): void
    {
        $this->assertSame(Direction::HORIZONTAL, $this->coordinate->getDirection(new Coordinate(1, 2)));
        $this->assertSame(Direction::VERTICAL, $this->coordinate->getDirection(new Coordinate(2, 1)));
        $this->assertSame(Direction::MAIN_DIAGONAL, $this->coordinate->getDirection(new Coordinate(2, 2)));
        $this->assertSame(Direction::INVERSE_DIAGONAL, $this->coordinate->getDirection(new Coordinate(2, -2)));
        $this->assertSame(Direction::NULL, $this->coordinate->getDirection(new Coordinate(1, 1)));
    }

    public function testGivenCoordinateWhenGetVerticalDistanceBetweenTwoPoints(): void
    {
        $this->assertSame(1, $this->coordinate->getVerticalDistance(new Coordinate(2, 1)));
        $this->assertSame(0, $this->coordinate->getVerticalDistance(new Coordinate(1, 1)));
    }

    public function testGivenCoordinateWhenGetHorizontalDistanceBetweenTwoPoints(): void
    {
        $this->assertSame(1, $this->coordinate->getHorizontalDistance(new Coordinate(1, 2)));
        $this->assertSame(0, $this->coordinate->getHorizontalDistance(new Coordinate(1, 1)));
    }

    public function testGivenCoordinateWhenGetCoordinateAfterSum(): void
    {
        $row = 25;
        $column = 3;
        $coordinate = new Coordinate($row, $column);

        $expectedRowSum = $this->coordinate->getRow() + $row;
        $expectedColSum = $this->coordinate->getColumn() + $column;

        $this->coordinate->sum($coordinate);

        $this->assertSame($expectedRowSum, $this->coordinate->getRow());
        $this->assertSame($expectedColSum, $this->coordinate->getColumn());
    }

    public function testGivenCoordinateWhenGetToString(): void
    {
        $this->assertSame('Coordinate (1, 1)', $this->coordinate->toString());
    }

    public function testGivenCoordinateWhenGetCoordinatesAreEquals(): void
    {
        $this->assertTrue($this->coordinate->equals($this->coordinate));
        $this->assertFalse($this->coordinate->equals($this));

        $this->assertFalse($this->coordinate->equals(new Coordinate($this->coordinate->getRow() + 1, $this->coordinate->getColumn())));
        $this->assertFalse($this->coordinate->equals(new Coordinate($this->coordinate->getRow(), $this->coordinate->getColumn() + 1)));

        $this->assertTrue($this->coordinate->equals(new Coordinate($this->coordinate->getRow(), $this->coordinate->getColumn())));
    }
}