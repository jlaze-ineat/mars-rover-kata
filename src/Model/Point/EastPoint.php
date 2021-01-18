<?php

declare(strict_types=1);

namespace App\Model\Point;

use App\Factory\PointFactory;

class EastPoint extends Point implements PointInterface
{
    public function getDirection(): string
    {
        return 'E';
    }

    public function afterForward(int $step): PointInterface
    {
        return PointFactory::create($this->getX() + $step, $this->getY(), 'E');
    }

    public function afterBackward(int $step): PointInterface
    {
        return PointFactory::create($this->getX() - $step, $this->getY(), 'E');
    }

    public function afterLeft(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'N');
    }

    public function afterRight(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'S');
    }
}
