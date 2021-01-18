<?php

namespace App\Model\Rover;

class RoverFast extends Rover
{
    public function getForwardStep(): int
    {
        return 3;
    }

    public function getBackwardStep(): int
    {
        return 2;
    }
}
