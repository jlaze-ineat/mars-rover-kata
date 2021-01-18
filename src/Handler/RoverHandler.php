<?php

namespace App\Handler;

use App\Model\Rover\RoverInterface;

abstract class RoverHandler
{
    private $rover;

    public function __construct(RoverInterface $rover)
    {
        $this->rover = $rover;
    }

    abstract public function getInstructionsMapping(): array;

    public function getRover(): RoverInterface
    {
        return $this->rover;
    }

    public function sendInstructions(array $instructions): void
    {
        $mapping = $this->getInstructionsMapping();

        foreach ($instructions as $instruction) {
            if (!\array_key_exists($instruction, $mapping)) {
                throw new \Exception(\sprintf(
                    'Unexpected instruction: %s, allowed are: %s',
                    $instruction,
                    implode(', ', \array_keys($mapping))
                ));
            }

            $method = $mapping[$instruction];
            $this->rover->$method();
        }
    }

    public function __toString()
    {
        return <<<EOF
Position-x: {$this->rover->getPoint()->getX()}
Position-y: {$this->rover->getPoint()->getY()}
Direction: {$this->rover->getPoint()->getDirection()}

EOF;
    }
}
