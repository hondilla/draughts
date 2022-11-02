<?php declare(strict_types=1);

namespace Hondilla\Draughts\Views\Console;

use Hondilla\Draughts\Controllers\ResumeController;
use Hondilla\Draughts\Views\Message;
use Hondilla\Utils\Views\YesNoDialog;

class ResumeView
{
    public function interact(ResumeController $resumeController): bool
    {
        $isResumed = new YesNoDialog();
        $isResumed->read(Message::RESUME->value);
        if ($isResumed->isAffirmative()) {
            $resumeController->reset();
        } else {
            $resumeController->nextState();
        }
        return $isResumed->isAffirmative();
    }
}
