<?php

namespace App\Model;

class Point
{
    private $x;
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function incX(int $step): void
    {
        $this->x += $step;
    }

    public function incY(int $step): void
    {
        $this->y += $step;
    }

    public function decX(int $step): void
    {
        $this->x -= $step;
    }

    public function decY(int $step): void
    {
        $this->y -= $step;
    }
}
