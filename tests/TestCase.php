<?php

namespace Tests;

use Hamcrest\MatcherAssert;
use Hamcrest\Util;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;

abstract class TestCase extends PhpUnitTestCase
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







