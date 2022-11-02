<?php

namespace Hondilla\Draughts\Models;

class State
{
    private StateValue $stateValue;

    public function next(): void
    {
        $this->stateValue = StateValue::cases()[$this->stateValue->ordinal() + 1];
    }

    public function reset(): void
    {
        $this->stateValue = StateValue::INITIAL;
    }

    public function getValueState(): StateValue
    {
        return $this->stateValue;
    }
}
