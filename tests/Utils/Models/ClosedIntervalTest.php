<?php

namespace Tests\Utils\Models;

use Hondilla\Utils\Models\ClosedInterval;
use PHPUnit\Framework\TestCase;

class ClosedIntervalTest extends TestCase
{
    private ClosedInterval $closedInterval;

    protected function setUp(): void
    {
        $this->closedInterval = new ClosedInterval(-1, 1);
    }

    public function testGivenClosedIntervalWhenIsIncludeThenOk(): void
    {
        $this->assertTrue($this->closedInterval->isIncluded(-1));
        $this->assertTrue($this->closedInterval->isIncluded(0));
        $this->assertTrue($this->closedInterval->isIncluded(1));
    }

    public function testGivenClosedIntervalWhenIsIncludeThenNotOk(): void
    {
        $this->assertFalse($this->closedInterval->isIncluded(-666));
        $this->assertFalse($this->closedInterval->isIncluded(666));
    }

    public function testGivenClosedIntervalWhenToStringThenOk(): void
    {
        $this->assertSame("[-1, 1]", $this->closedInterval->toString());
    }
}