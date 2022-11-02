<?php

declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Types\Error;
use Hondilla\Utils\Views\Console;

class ErrorView
{
    public function writeln(Error $error): void
    {
        Console::getInstance()->writeln($this->getErrorMessage($error));
    }

    public function getErrorMessage(Error $error): string
    {
        return match ($error) {
            Error::NOT_EMPTY => 'The square is not empty',
            Error::NOT_OWNER => 'There is not a token of yours',
            Error::SAME_COORDINATES => 'The origin and target squares are the same',
            Error::WRONG_COORDINATES => 'The coordinates are wrong',
            Error::NOT_DIAGONAL => 'The coordinates are not in diagonal',
            Error::NOT_VALID_WAY => 'Your pawn cannot move in this direction',
            Error::WITHOUT_EATING => 'You have to eat the opponent`s piece!!!',
            Error::COLLEAGUE_EATING => 'You cannot eat your pieces',
            Error::TOO_FAR => 'You are trying to move too far',
            Error::TOO_MUCH_EATINGS => 'You cannot eat more than one piece',
            Error::BLOCKED_PIECE => 'This piece is blocked',
        };
    }
}
