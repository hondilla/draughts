<?php declare(strict_types=1);

namespace Hondilla\Utils\Models;

enum Direction
{
    case VERTICAL;
    case HORIZONTAL;
    case MAIN_DIAGONAL;
    case INVERSE_DIAGONAL;
    case NULL;

    public function isNull(): bool
    {
        return $this === self::NULL;
    }
}
