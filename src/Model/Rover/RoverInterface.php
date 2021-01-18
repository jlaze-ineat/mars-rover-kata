<?php

namespace App\Model\Rover;

use App\Model\Point\PointInterface;

interface RoverInterface
{
    public function forward(): void;

    public function backward(): void;

    public function left(): void;

    public function right(): void;

    public function getPoint(): PointInterface;
}
