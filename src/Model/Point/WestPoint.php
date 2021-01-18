<?php

declare(strict_types=1);

namespace App\Model\Point;

use App\Factory\PointFactory;

class WestPoint extends Point implements PointInterface
{
    public function getDirection(): string
    {
        return 'W';
    }

    public function afterForward(int $step): PointInterface
    {
        return PointFactory::create($this->getX() - $step, $this->getY(), 'W');
    }

    public function afterBackward(int $step): PointInterface
    {
        return PointFactory::create($this->getX() + $step, $this->getY(), 'W');
    }

    public function afterLeft(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'S');
    }

    public function afterRight(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'N');
    }
}
