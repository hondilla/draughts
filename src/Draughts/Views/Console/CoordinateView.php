<?php

declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;
use Hondilla\Utils\Models\SquareBoundedCoordinate;
use Hondilla\Utils\Views\SquareBoundedCoordinateView;

class CoordinateView extends SquareBoundedCoordinateView
{
    public function getErrorMessage(): string
    {
        return (new ErrorView())->getErrorMessage(Error::WRONG_COORDINATES);
    }

    public function createCoordinate(Coordinate $coordinate): SquareBoundedCoordinate
    {
        return new SquareBoundedCoordinate($coordinate->getRow(), $coordinate->getColumn());
    }

}
