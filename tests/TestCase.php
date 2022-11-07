<?php

namespace Tests;

use Hamcrest\MatcherAssert;
use Hamcrest\Util;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function runBare(): void
    {
        Util::registerGlobalFunctions();
        MatcherAssert::resetCount();

        try {
            parent::runBare();
        } finally {
            $this->addToAssertionCount(MatcherAssert::getCount());
        }
    }
}