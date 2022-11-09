<?php

namespace Tests\Draughts\Types;

use Hondilla\Draughts\Types\Color;
use Hondilla\Draughts\Types\Coordinate;
use Tests\TestCase;


class ColorTest extends TestCase
{
    public function testGivenIndexWhenGetThenColor()
    {
        assertThat(Color::WHITE, is(equalTo(Color::get(0))));
        assertThat(Color::BLACK, is(equalTo(Color::get(1))));
        assertThat(Color::NULL, is(equalTo(Color::get(2))));
    }

    public function testGivenCoordinateWhenInitialColorThenColor()
    {
        assertThat(Color::getInitialColor(new Coordinate(0, 1)), is(equalTo(Color::BLACK)));
        assertThat(Color::getInitialColor(new Coordinate(6, 3)), is(equalTo(Color::WHITE)));
        assertThat(Color::getInitialColor(new Coordinate(3, 4)), is(equalTo(Color::NULL)));
        assertThat(Color::getInitialColor(new Coordinate(4, 5)), is(equalTo(Color::NULL)));
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
