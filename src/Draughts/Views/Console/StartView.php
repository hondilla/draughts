<?php declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Controllers\StartController;
use Hondilla\Draughts\Views\Message;

class StartView
{
    public function interact(StartController $startController): void
    {
        $messageView = new MessageView();
        $messageView->writeln(Message::TITLE);
        $boardView = new BoardView();
        $boardView->write($startController);
        $startController->nextState();
    }
}
