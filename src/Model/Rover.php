<?php

namespace App\Model;

abstract class Rover implements RoverInterface
{
    private $point;
    private $direction;
    private const DIRECTIONS = ['N', 'W', 'S', 'E'];

    public function __construct(Point $point, string $direction)
    {
        $this->point = $point;
        $this->setDirection($direction);
    }

    public function getPoint(): Point
    {
        return $this->point;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setPoint(Point $point): self
    {
        $this->point = $point;

        return $this;
    }

    public function setDirection(string $direction): self
    {
        if (!\in_array($direction, self::DIRECTIONS)) {
            throw new \Exception(
                \sprintf(
                    'Invalid direction: %s, allowed are: %s',
                    $direction,
                    implode(', ', self::DIRECTIONS)
                )
            );
        }

        $this->direction = $direction;

        return $this;
    }

    public function forward(): void
    {
        switch ($this->direction) {
            case 'N':
                $this->point->incY($this->getForwardStep());
                break;
            case 'S':
                $this->point->decY($this->getBackwardStep());
                break;
            case 'E':
                $this->point->incX($this->getForwardStep());
                break;
            case 'W':
                $this->point->decX($this->getBackwardStep());
                break;
        }
    }

    public function backward(): void
    {
        switch ($this->direction) {
            case 'N':
                $this->point->decY($this->getBackwardStep());
                break;
            case 'S':
                $this->point->incY($this->getForwardStep());
                break;
            case 'E':
                $this->point->decX($this->getBackwardStep());
                break;
            case 'W':
                $this->point->incX($this->getForwardStep());
                break;
        }
    }

    public function left(): void
    {
        $actualIndex = \array_search($this->direction, self::DIRECTIONS);
        $newIndex = $actualIndex === 3 ? 0 : $actualIndex + 1;
        $this->setDirection(self::DIRECTIONS[$newIndex]);
    }

    public function right(): void
    {
        $actualIndex = \array_search($this->direction, self::DIRECTIONS);
        $newIndex = $actualIndex === 0 ? 3 : $actualIndex - 1;
        $this->setDirection(self::DIRECTIONS[$newIndex]);
    }

    abstract public function getForwardStep(): int;
    abstract public function getBackwardStep(): int;
}
