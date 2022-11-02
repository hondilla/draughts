<?php declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Controllers\PlayController;
use Hondilla\Draughts\Views\Message;

class PlayView
{
    public function interact(PlayController $playController): void
    {
        do {
            $playerView = new PlayerView($playController);
            $playerView->interact();
            $playController->next();
            $boardView = new BoardView();
            $boardView->write($playController);
        } while (!$playController->isFinished());
        $message = Message::DRAW;
        if ($playController->isWinner()) {
            $message = Message::PLAYER_WIN;
        }
        $messageView = new MessageView();
        $messageView->writeln($message);
        $playController->nextState();
    }
}
