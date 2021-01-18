<?php

namespace App\Model\Rover;

use App\Model\Point\PointInterface;

abstract class Rover implements RoverInterface
{
    private $point;

    public function __construct(PointInterface $point)
    {
        $this->point = $point;
    }

    public function getPoint(): PointInterface
    {
        return $this->point;
    }

    public function forward(): void
    {
        $this->point = $this->point->afterForward($this->getForwardStep());
    }

    public function backward(): void
    {
        $this->point = $this->point->afterBackward($this->getBackwardStep());
    }

    public function left(): void
    {
        $this->point = $this->point->afterLeft();
    }

    public function right(): void
    {
        $this->point = $this->point->afterRight();
    }

    abstract public function getForwardStep(): int;
    abstract public function getBackwardStep(): int;
}
