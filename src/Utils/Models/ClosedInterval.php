<?php

declare(strict_types=1);

namespace Hondilla\Utils\Models;

class ClosedInterval
{
    public function __construct(
        private readonly int $min,
        private readonly int $max
    ) {
        assert($min <= $max);
    }

    public function isIncluded(int $value): bool
    {
        return $this->min <= $value && $value <= $this->max;
    }

    public function toString(): string
    {
        return "[{$this->min}, {$this->max}]";
    }

    public function equals(object $obj): bool
    {
        if ($this === $obj) {
            return true;
        }
        if (get_class($this) !== get_class($obj)) {
            return false;
        }
        if ($this->min !== $obj->min) {
            return false;
        }
        if ($this->max !== $obj->max) {
            return false;
        }
        return true;
    }
}
