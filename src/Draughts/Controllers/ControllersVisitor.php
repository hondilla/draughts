<?php

namespace Hondilla\Draughts\Controllers;

interface ControllersVisitor
{
    public function visitStartController(StartController $startController): void;

    public function visitPlayController(PlayController $playController): void;

    public function visitResumeController(ResumeController $resumeController): bool;
}