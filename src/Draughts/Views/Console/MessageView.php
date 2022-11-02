<?php

declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Views\Message;
use Hondilla\Utils\Views\Console;

class MessageView
{
    public function write(Message $message): void
    {
        Console::getInstance()->write($message->value);
    }

    public function writeln(Message $message, string $player = ''): void
    {
        if ($player === '') {
            Console::getInstance()->writeln($message);
        } else {
            Console::getInstance()->writeln(str_replace("#player", "" . $player, $message->value));
        }
    }
}
