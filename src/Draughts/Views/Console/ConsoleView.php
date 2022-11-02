<?php declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Controllers\PlayController;
use Hondilla\Draughts\Controllers\ResumeController;
use Hondilla\Draughts\Controllers\StartController;
use Hondilla\Draughts\Views\View;

class ConsoleView extends View
{
    public function __construct(
        private readonly StartView  $startView,
        private readonly PlayView   $playView,
        private readonly ResumeView $resumeView
    )
    {

    }

    public function visitStartController(StartController $startController): void
    {
        $this->startView->interact($startController);
    }

    public function visitPlayController(PlayController $playController): void
    {
        $this->playView->interact($playController);
    }

    public function visitResumeController(ResumeController $resumeController): bool
    {
        return $this->resumeView->interact($resumeController);
    }

}
