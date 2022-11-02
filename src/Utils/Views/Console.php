<?php

declare(strict_types=1);

namespace Hondilla\Utils\Views;

class Console
{
	private static Console $instance;

	public static function getInstance(): Console
	{
        if (self::$instance === null) {
            self::$instance = new self();
        }
		return self::$instance;
	}

	public function readString(String $title): string
	{
		return readline($title);
	}

	public function readInt(String $title): int
	{
		return intVal(readline($title));
	}

	public function readChar(String $title): string
	{
		return $this->readString($title)[0];
	}

	public function write($value): void
	{
		echo $value;
	}

	public function writeln($value = ''): void
	{
		$this->write($value);
		$this->write('\n');
	}

	public function writeError(String $format): void
	{
		$this->write('FORMAT ERROR! Enter a ' . $format . ' formatted value.');
	}
}
