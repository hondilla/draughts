<?php

namespace Tests\Auxiliar;

class X
{
    public function __construct(private ?int $x)
    {
        $this->x = $x ?? 0;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function equals(?object $obj): bool {
		if ($this === $obj) { return true; }
		if ($obj === null) { return false; }
		if (get_class($this) !== get_class($obj)) { return false; }
		if ($this->x !== $obj->x) { return false; }
		return true;
	}

    public function hashCode(): int
    {
        $prime = 31;
        $result = 1;
        return $prime * $result + $this->x;
    }
}