<?php

namespace Tests\Auxiliar;

use Tests\TestCase;

class AssertThatTest extends TestCase
{
    public function test(): void
    {
        //phpunit nativo
        $this->assertThat(6, $this->equalTo(6));
        $this->assertThat(6, $this->logicalNot($this->equalTo(5)));

        //hamcrest
        assertThat(6, is(equalTo(6)));
        assertThat(6, not(equalTo(5)));

        assertThat(6, is(greaterThan(5)));
        assertThat(6, is(not(greaterThan(6))));

        assertThat(6, is(greaterThanOrEqualTo(5)));
        assertThat(6, is(not(greaterThanOrEqualTo(7))));

        assertThat(6, is(lessThan(7)));
        assertThat(6, is(not(lessThan(5))));

        assertThat(6, is(lessThanOrEqualTo(9)));
        assertThat(6, is(not(lessThanOrEqualTo(3))));

        assertThat(6.5, is(closeTo(6.4, 0.1)));
        assertThat(6.5, is(not(closeTo(6.4, 0.05))));

        assertThat(null, is(nullValue()));
        assertThat(new X(null), is(not(nullValue())));

        assertThat(new X(null), is(notNullValue()));
        assertThat(null, is(not(notNullValue())));

        $a = new X(null);
        $b = $a;
        $c = new X(null);

        assertThat($a, is(sameInstance($b)));
        assertThat($a, is(not(sameInstance($c))));

        assertThat($a, anInstanceOf(X::class));

        assertThat("hola", is(equalToIgnoringCase("HolA")));
        assertThat("hola", is(not(equalToIgnoringCase("HolA "))));

        assertThat("hola Paula!", is(equalToIgnoringWhiteSpace("hola  Paula!")));
        assertThat("ho,bro!", is(not(equalToIgnoringWhiteSpace("hi, bro!"))));

        assertThat(5, allOf(greaterThan(0), lessThan(10)));
        assertThat(500, anyOf(greaterThan(0), lessThan(10)));
    }

    public function testAssertEquals(): void
    {
        $expectedInt = (int)0;
        $resultInt = (int)0;
        $this->assertEquals($expectedInt, $resultInt);
        // with assertThat
        assertThat($resultInt, is(equalTo($expectedInt)));
        assertThat($resultInt, equalTo($expectedInt));
        assertThat($resultInt, is($expectedInt));

        $expectedFloat = (float)0.0;
        $resultFloat = (float)0.0;
        $this->assertEquals($expectedFloat, $resultFloat, 0.001);
        // with assertThat
        assertThat((double)$resultFloat, closeTo($expectedFloat, 0.001));

        $expectedDouble = (double)0.0;
        $resultDouble = (double)0.0;
        $this->assertEquals($expectedDouble, $resultDouble, 0.001);
        // with assertThat
        assertThat($resultDouble, closeTo($expectedDouble, 0.001));

        $expectedChar = (string)"0";
        $resultChar = (string)"0";
        $this->assertEquals($expectedChar, $resultChar);
        // with assertThat
        assertThat($resultChar, equalTo($expectedChar));

        $expectedBoolean = (bool)true;
        $resultBoolean = (bool)true;
        $this->assertEquals($expectedBoolean, $resultBoolean);
        // with assertThat
        assertThat($resultBoolean, equalTo($expectedBoolean));

        $expectedX = new X(null);
        $resultX = $expectedX;
        $this->assertEquals($expectedX, $resultX);
        // with assertThat
        assertThat($resultX, equalTo($expectedX));
    }

    public function testAssertTrue(): void
    {
        $resultBoolean = (bool)true;
        $this->assertTrue($resultBoolean, "should be true");
        $this->assertTrue($resultBoolean);
        // with assertThat
        assertThat($resultBoolean, equalTo(true));
    }

    public function testAssertFalse(): void
    {
        $resultBoolean = (bool)false;
        $this->assertFalse($resultBoolean, "should be true");
        $this->assertFalse($resultBoolean);
        // with assertThat
        assertThat($resultBoolean, equalTo(false));
    }

    public function testAssertNull(): void
    {
        $resultX = null;
        $this->assertNull($resultX, "should be null");
        $this->assertNull($resultX);
        // with assertThat
        assertThat($resultX, nullValue());
    }

    public function testAssertNotNull(): void
    {
        $resultX = new X(null);
        $this->assertNotNull($resultX, "should be not null");
        $this->assertNotNull($resultX);
        // with assertThat
        assertThat($resultX, not(nullValue()));
        assertThat($resultX, notNullValue());
    }

    public function testAssertSame(): void
    {
        $expectedX = new X(null);
        $resultX = $expectedX;
        $this->assertSame($expectedX, $resultX, "should be same");
        $this->assertSame($expectedX, $resultX);
        // better than
        assertThat($resultX, sameInstance($resultX));
    }

    public function testAssertNotSame(): void
    {
        $expectedX = new X(null);
        $resultX = new X(null);
        $this->assertNotSame($expectedX, $resultX, "should be distinct");
        $this->assertNotSame($expectedX, $resultX);
        // better than
        assertThat($resultX, not(sameInstance($expectedX)));
    }

    public function testAssertArrayEquals(): void
    {
        $expectedIntArray = [1, 2, 3];
        $resultIntArray = [1, 2, 3];
        $this->assertEquals($expectedIntArray, $resultIntArray);

        $expectedXArray = [new X(null), new X(null), new X(null)];
        $resultXArray = [$expectedXArray[0], $expectedXArray[1], $expectedXArray[2]];
        $this->assertEquals($expectedXArray, $resultXArray);
    }

    public function testAssertThatForRelational(): void
    {
        $resultInt = 1;
        assertThat($resultInt, greaterThan(0));
        assertThat($resultInt, greaterThanOrEqualTo(0));
        assertThat($resultInt, greaterThanOrEqualTo(1));
        assertThat($resultInt, lessThan(2));
        assertThat($resultInt, lessThanOrEqualTo(2));
        assertThat($resultInt, lessThanOrEqualTo(1));
    }

    public function testAssertThatCombined(): void
    {
        assertThat("characters", allOf(startsWith("char"), endsWith("ters")));
        assertThat("characters", anyOf(containsString("car"), containsString("rac")));
    }

    public function testAssertThatArray(): void
    {
        $resultList = [1, 2, 3];
        assertThat($resultList, hasItemInArray(2));
        assertThat($resultList, arrayContainingInAnyOrder(1, 3, 2));
    }
}