<?php

declare(strict_types=1);

namespace Hondilla\Utils\Views;

use Hondilla\Utils\Models\ClosedInterval;

class BoundedIntDialog
{
	private ClosedInterval $LIMITS;
	private static string $ERROR_MESSAGE = 'Invalid number';

	public function __construct(int $min, int $max)
	{
		$this->LIMITS = new ClosedInterval($min, $max);
	}

	public function read(string $message): int
	{
		do {
			$value = Console::getInstance()->readInt($message . '? ' . $this->LIMITS->toString() . ': ');
			$ok = $this->LIMITS->isIncluded($value);
			if (!$ok) {
				Console::getInstance()->writeln(self::$ERROR_MESSAGE);
			}
		} while (!$ok);
		return $value;
	}
}
