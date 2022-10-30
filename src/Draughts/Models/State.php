<?php

namespace Hondilla\Draughts\Models;

class State
{
    private StateValue $stateValue;

    public function next(): void
    {
        assert($this->stateValue !== StateValue::EXIT);
		$this->stateValue = StateValue::cases()[$this->stateValue->ordinal() + 1];
    }
}