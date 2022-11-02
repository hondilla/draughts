<?php

namespace Hondilla\Draughts\Views;

enum Message: string
{
    case TITLE = '     ------- Draughts -------';
    case VERTICAL_LINE = ' | ';
    case ENTER_COORDINATE_TO_PUT = 'Enter a coordinate to put a token:';
    case COORDINATE_TO_PUT = 'Coordinate to put';
    case COORDINATE_TO_REMOVE = 'Origin coordinate to move';
    case COORDINATE_TO_MOVE = 'Target coordinate to move';
    case PLAYER_WIN = '#player player: You win!!! :-)';
    case DRAW = 'It`s a draw!!!!!!! :-O';
    case RESUME = 'Do you want to continue?';
}
