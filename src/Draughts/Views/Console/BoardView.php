<?php

declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Controllers\Controller;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Views\Message;
use Hondilla\Utils\Views\Console;

class BoardView
{

    public function write(Controller $controller): void
    {
        $messageView = new MessageView();
        for ($i = 0; $i < Coordinate::$dimension; $i++) {
            $messageView->write(Message::VERTICAL_LINE);
            for ($j = 0; $j < Coordinate::$dimension; $j++) {
                Console::getInstance()->write($controller->getCode(new Coordinate($i, $j)));
                $messageView->write(Message::VERTICAL_LINE);
            }
            Console::getInstance()->writeln();
        }
    }

}
