<?php

namespace App\Model\Rover;

class RoverSlow extends Rover
{
    public function getForwardStep(): int
    {
        return 1;
    }

    public function getBackwardStep(): int
    {
        return 1;
    }
}
