<?php

namespace App\Model;

interface RoverInterface
{
    public function forward(): void;

    public function backward(): void;

    public function left(): void;

    public function right(): void;

    public function getPoint(): Point;

    public function getDirection(): string;
}
