<?php

declare(strict_types=1);

namespace Hondilla\Utils\Views;

use Hondilla\Utils\Models\ClosedInterval;

class YesNoDialog
{

	private static string $AFFIRMATIVE = 'y';
	private static string $NEGATIVE = 'n';
	private static string $SUFFIX = "? (" .
		YesNoDialog::$AFFIRMATIVE . "/" .
		YesNoDialog::$NEGATIVE . "): ";
	private static string $MESSAGE = 'The value must be "' .
		YesNoDialog::$AFFIRMATIVE . '" or "' .
		YesNoDialog::$NEGATIVE . "'";
	private string $answer;

	public function read(String $message): void
	{
		do {
            Console::getInstance()->write($message);
			$this->answer = Console::getInstance()->readString(self::$SUFFIX);
			$ok = $this->isAffirmative() || $this->isNegative();
			if (!$ok) {
                Console::getInstance()->writeln(self::$MESSAGE);
			}
		} while (!$ok);
	}

	public function isAffirmative(): bool
	{
		return $this->getAnswer() === self::$AFFIRMATIVE;
	}

	private function getAnswer(): string
	{
		return strtolower($this->answer)[0];
	}

	public function isNegative(): bool
	{
		return $this->getAnswer() === self::$NEGATIVE;
	}
}
