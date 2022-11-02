<?php

declare(strict_types=1);

namespace Hondilla\Utils\Views;

use Hondilla\Utils\Models\Coordinate;

class CoordinateView
{
    public static string $row = 'row: ';
	public static string $column = 'column: ';

    public function read(string $title): Coordinate
    {
        $console = Console::getInstance();
        $console->writeln($title);
        $row = $console->readInt(self::$row) - 1;
        $column = $console->readInt(self::$column) - 1;
        return new Coordinate($row, $column);
    }
}
