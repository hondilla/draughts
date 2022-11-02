<?php declare(strict_types=1);

namespace Hondilla\Draughts\Types;

enum Error
{
    case NOT_EMPTY;
    case NOT_OWNER;
    case SAME_COORDINATES;
    case WRONG_COORDINATES;
    case NOT_DIAGONAL;
    case NOT_VALID_WAY;
    case WITHOUT_EATING;
    case COLLEAGUE_EATING;
    case TOO_FAR;
    case TOO_MUCH_EATINGS;
    case BLOCKED_PIECE;
    case NULL;

    public function isNull(): bool
    {
        return $this === self::NULL;
    }
}