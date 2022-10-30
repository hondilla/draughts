<?php declare(strict_types=1);

namespace Hondilla\Utils\Models;

interface Coordinate {
  public function isNull(): bool;
  public function getDirection(Coordinate $coordinate): Direction;
  public function inHorizontal(Coordinate $coordinate): bool;
  public function inVertical(Coordinate $coordinate): bool;
  public function inMainDiagonal(Coordinate $coordinate): bool;
  public function mainDiagonal(): int;
  public function inInverseDiagonal(Coordinate $coordinate): bool;
  public function inverseDiagonal(): int;
}
