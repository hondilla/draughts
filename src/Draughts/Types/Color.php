<?php

namespace Hondilla\Draughts\Types;

use Hondilla\Utils\Models\ClosedInterval;

enum Color
{
    case WHITE;
    case BLACK;
    case NULL;

    public static function get(int $ordinal): Color
    {
        return self::cases()[$ordinal];
    }

    public static function getInitialColor(Coordinate $coordinate): Color
    {
        if ($coordinate->isInitialPiecePosition()) {
            if (self::blackRowsInterval()->isIncluded($coordinate->getRow())) {
                return self::BLACK;
            }
            if (self::whiteRowsInterval()->isIncluded($coordinate->getRow())) {
                return self::WHITE;
            }
        }
        return self::NULL;
    }

    private static function blackRowsInterval(): ClosedInterval
    {
        return new ClosedInterval(0, 2);
    }

    private static function whiteRowsInterval(): ClosedInterval
    {
        return new ClosedInterval(5, 7);
    }

    public function getInitial(): string
    {
        if ($this->isNull()) {
            return ' ';
        }
        return strtolower($this->name)[0];
    }

    public function isNull(): bool
    {
        return $this === self::NULL;
    }

    public function opposite(): Color
    {
        if ($this->equals(self::BLACK)) {
            return self::WHITE;
        }
        return self::BLACK;
    }

    public function equals(object $obj): bool
    {
        if ($this === $obj) {
            return true;
        }
        if (get_class($this) !== get_class($obj)) {
            return false;
        }
        if (self::BLACK !== $obj) {
            return false;
        }
        if (self::WHITE !== $obj) {
            return false;
        }
        return true;
    }

}
