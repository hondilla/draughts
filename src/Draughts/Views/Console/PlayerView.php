<?php declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Controllers\PlayController;
use Hondilla\Draughts\Types\Coordinate;
use Hondilla\Draughts\Types\Error;
use Hondilla\Draughts\Views\Message;

class PlayerView
{
    public function __construct(private readonly PlayController $playController)
    {
    }

    public function interact(): void
    {
        do {
            $origin = $this->getCoordinate(Message::COORDINATE_TO_REMOVE);
            $error = $this->getOriginMoveTokenError($origin);
        } while ($error !== Error::NULL);
        do {
            $target = $this->getCoordinate(Message::COORDINATE_TO_MOVE);
            $error = $this->getTargetMoveTokenError($origin, $target);
        } while ($error !== Error::NULL);
        $this->playController->movePiece($origin, $target);
    }

    public function getCoordinate(Message $message): Coordinate
    {
        return (new CoordinateView())->read($message->value);
    }

    private function getOriginMoveTokenError(Coordinate $origin): Error
    {
        $error = $this->playController->getOriginError($origin);
        $errorView = new ErrorView();
        $errorView->writeln($error);
        return $error;
    }

    private function getTargetMoveTokenError(Coordinate $origin, Coordinate $target): Error
    {
        $error = $this->playController->getTargetError($origin, $target);
        $errorView = new ErrorView();
        $errorView->writeln($error);
        return $error;
    }
}
