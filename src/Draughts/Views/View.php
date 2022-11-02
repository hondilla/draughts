<?php declare(strict_types=1);

namespace Hondilla\Draughts\Views;

use Hondilla\Draughts\Controllers\ControllersVisitor;
use Hondilla\Draughts\Controllers\Logic;

abstract class View implements ControllersVisitor
{
    public function interact(Logic $logic): void
    {
        do {
            $controller = $logic->getController();
            if ($controller !== null) {
                $controller->accept($this);
            }
        } while ($controller !== null);
    }
}
