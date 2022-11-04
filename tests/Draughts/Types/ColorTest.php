<?php

namespace Tests\Draughts\Types;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use PHPUnit\Framework\TestCase;

//use function Hamcrest\Core\Is;

class ColorTest extends TestCase
{
    public function testGet()
    {
        //$this->assertThat(Color::get(0), is(Color::WHITE));
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

    public function testGivenNullThenEmptyInitial()
    {
        $this->assertEquals(' ', Color::NULL->getInitial());
    }

    public function testGivenBlackThenInitialIsLowerCaseB()
    {
        $this->assertEquals('b', Color::BLACK->getInitial());
    }

    public function testGivenWhiteThenInitialIsLowerCaseW()
    {
        $this->assertEquals('w', Color::WHITE->getInitial());
    }

    public function testGivenNullThenIsNull()
    {
        $this->assertTrue(Color::NULL->isNull());
    }

    public function testGivenBlackThenOppositeIsWhite()
    {
        $this->assertEquals(Color::WHITE, Color::BLACK->opposite());
    }

    public function testGivenWhiteThenOppositeIsBlack()
    {
        $this->assertEquals(Color::BLACK, Color::WHITE->opposite());
    }

}
