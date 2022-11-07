<?php

namespace Tests\Auxiliar;

use Tests\TestCase;

class ExecutionTest extends TestCase
{
    private static int $staticMember = 7;
    private int $instanceMember;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->instanceMember = 666;
        echo "New object: " . $this->toString();
    }

    public function test5(): void
    {
		echo "\n 5> instance: " . $this->instanceMember . " and static: " . self::$staticMember;
		self::$staticMember++;
		$this->instanceMember++;
		echo "\n 5< instance: " . $this->instanceMember . " and static: " . self::$staticMember;
	}

    public function test4(): void
    {
        echo "\n 4> instance: " . $this->instanceMember . " and static: " . self::$staticMember;
		self::$staticMember++;
		$this->instanceMember++;
		echo "\n 4< instance: " . $this->instanceMember . " and static: " . self::$staticMember;
	}

    public function test3(): void
    {
        echo "\n 3> instance: " . $this->instanceMember . " and static: " . self::$staticMember;
		self::$staticMember++;
		$this->instanceMember++;
        echo "\n 3< instance: " . $this->instanceMember . " and static: " . self::$staticMember;
	}

    public function test2(): void
    {
        echo "\n 2> instance: " . $this->instanceMember . " and static: " . self::$staticMember;
		self::$staticMember++;
		$this->instanceMember++;
        echo "\n 2< instance: " . $this->instanceMember . " and static: " . self::$staticMember;
	}

    public function test1(): void
    {
        echo "\n 1> instance: " . $this->instanceMember . " and static: " . self::$staticMember;
		self::$staticMember++;
		$this->instanceMember++;
        echo "\n 1< instance: " . $this->instanceMember . " and static: " . self::$staticMember;
	}

    public function test0(): void
    {
        echo "\n 0> instance: " . $this->instanceMember . " and static: " . self::$staticMember;
		self::$staticMember++;
		$this->instanceMember++;
        echo "\n 0< instance: " . $this->instanceMember . " and static: " . self::$staticMember;
	}
}