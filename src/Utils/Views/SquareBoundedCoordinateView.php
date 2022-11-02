<?php

declare(strict_types=1);

namespace Hondilla\Utils\Views;

use Hondilla\Utils\Models\Coordinate;
use Hondilla\Utils\Models\SquareBoundedCoordinate;

abstract class SquareBoundedCoordinateView
{
    public function read(string $message): SquareBoundedCoordinate
    {
        do {
            $coordinateView = new CoordinateView();
            $coordinate = $coordinateView->read($message);
            $squareBoundedCoordinate = $this->createCoordinate($coordinate);

            $error = !$squareBoundedCoordinate->isValid();
            if ($error) {
                Console::getInstance()->writeln($this->getErrorMessage());
            }
        } while ($error);
        return $squareBoundedCoordinate;
    }

    abstract public function createCoordinate(Coordinate $coordinate): SquareBoundedCoordinate;

    abstract public function getErrorMessage(): string;
}
