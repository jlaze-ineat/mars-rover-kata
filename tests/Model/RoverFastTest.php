<?php

namespace App\Tests\Rover;

use App\Factory\PointFactory;
use App\Model\Rover\RoverFast;
use PHPUnit\Framework\TestCase;

class RoverFastTest extends TestCase
{
    public function testInvalidDirection(): void
    {
        $this->expectExceptionMessage( 'Invalid direction: invalid, allowed are: N, W, S, E');
        new RoverFast(PointFactory::create(0, 0, 'invalid'));
    }

    /**
     * @dataProvider provideTestMovementData
     */
    public function testMovement(
        string $method,
        int $startX,
        int $startY,
        string $startDirection,
        int $expectedX,
        int $expectedY,
        string $expectedDirection
    ): void
    {
        $expectedPoint = PointFactory::create($expectedX, $expectedY, $expectedDirection);
        $rover = new RoverFast(PointFactory::create($startX, $startY, $startDirection));
        $rover->$method();
        $this->assertEquals($rover->getPoint(), $expectedPoint);
    }

    public function provideTestMovementData(): array
    {
        return [
            // forward from origin
            ['forward', 0, 0, 'N', 0, 3, 'N'],
            ['forward', 0, 0, 'S', 0, -3, 'S'],
            ['forward', 0, 0, 'E', 3, 0, 'E'],
            ['forward', 0, 0, 'W', -3, 0, 'W'],

            // forward from (10, -3)
            ['forward', 10, -3, 'N', 10, 0, 'N'],
            ['forward', 10, -3, 'S', 10, -6, 'S'],
            ['forward', 10, -3, 'E', 13, -3, 'E'],
            ['forward', 10, -3, 'W', 7, -3, 'W'],

            // backward from origin
            ['backward', 0, 0, 'N', 0, -2, 'N'],
            ['backward', 0, 0, 'S', 0, 2, 'S'],
            ['backward', 0, 0, 'E', -2, 0, 'E'],
            ['backward', 0, 0, 'W', 2, 0, 'W'],

            // backward from (10, -3)
            ['backward', 10, -3, 'N', 10, -5, 'N'],
            ['backward', 10, -3, 'S', 10, -1, 'S'],
            ['backward', 10, -3, 'E', 8, -3, 'E'],
            ['backward', 10, -3, 'W', 12, -3, 'W'],

            // left from origin
            ['left', 0, 0, 'N', 0, 0, 'W'],
            ['left', 0, 0, 'S', 0, 0, 'E'],
            ['left', 0, 0, 'E', 0, 0, 'N'],
            ['left', 0, 0, 'W', 0, 0, 'S'],

            // left from (10, -3)
            ['left', 10, -3, 'N', 10, -3, 'W'],
            ['left', 10, -3, 'S', 10, -3, 'E'],
            ['left', 10, -3, 'E', 10, -3, 'N'],
            ['left', 10, -3, 'W', 10, -3, 'S'],

            // right from origin
            ['right', 0, 0, 'N', 0, 0, 'E'],
            ['right', 0, 0, 'S', 0, 0, 'W'],
            ['right', 0, 0, 'E', 0, 0, 'S'],
            ['right', 0, 0, 'W', 0, 0, 'N'],

            // right from (10, -3)
            ['right', 10, -3, 'N', 10, -3, 'E'],
            ['right', 10, -3, 'S', 10, -3, 'W'],
            ['right', 10, -3, 'E', 10, -3, 'S'],
            ['right', 10, -3, 'W', 10, -3, 'N'],
        ];
    }
}
