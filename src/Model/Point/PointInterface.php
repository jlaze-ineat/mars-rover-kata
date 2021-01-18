<?php

declare(strict_types=1);

namespace App\Model\Point;

interface PointInterface
{
    public function getDirection(): string;

    public function afterForward(int $step): self;

    public function afterBackward(int $step): self;

    public function afterLeft(): self;

    public function afterRight(): self;
}
