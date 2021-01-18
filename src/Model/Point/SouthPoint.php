<?php

declare(strict_types=1);

namespace App\Model\Point;

use App\Factory\PointFactory;

class SouthPoint extends Point implements PointInterface
{
    public function getDirection(): string
    {
        return 'S';
    }

    public function afterForward(int $step): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY() - $step, 'S');
    }

    public function afterBackward(int $step): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY() + $step, 'S');
    }

    public function afterLeft(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'E');
    }

    public function afterRight(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'W');
    }
}
