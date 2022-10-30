<?php

namespace Hondilla\Draughts\Models;

use Hondilla\Draughts\Types\Coordinate;

class Game
{
    private Board $board;
    private Turn $turn;

    public function __construct()
    {
		$this->board = new Board();
		$this->turn = new Turn($this->board);
	}

    public function getCode(Coordinate $coordinate): string
    {
		return $this->board->getCode($coordinate);
    }
}