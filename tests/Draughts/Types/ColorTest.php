<?php

namespace Tests\Draughts\Types;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{
    public function testGet()
    {
        $this->assertEquals(Color::WHITE, Color::get(0));
        $this->assertEquals(Color::BLACK, Color::get(1));
        $this->assertEquals(Color::NULL, Color::get(2));
    }

    public function testGetInitialColor()
    {
        var_dump((new Coordinate(4, 5))->isInitialPiecePosition());
        $this->assertEquals(Color::BLACK, Color::getInitialColor(new Coordinate(0, 1)));
        $this->assertEquals(Color::WHITE, Color::getInitialColor(new Coordinate(6, 3)));
        $this->assertEquals(Color::NULL, Color::getInitialColor(new Coordinate(3, 4)));
        $this->assertEquals(Color::NULL, Color::getInitialColor(new Coordinate(4, 5)));
    }
}
