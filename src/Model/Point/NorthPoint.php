<?php

declare(strict_types=1);

namespace App\Model\Point;

use App\Factory\PointFactory;

class NorthPoint extends Point implements PointInterface
{
    public function getDirection(): string
    {
        return 'N';
    }

    public function afterForward(int $step): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY() + $step, 'N');
    }

    public function afterBackward(int $step): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY() - $step, 'N');
    }

    public function afterLeft(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'W');
    }

    public function afterRight(): PointInterface
    {
        return PointFactory::create($this->getX(), $this->getY(), 'E');
    }
}
