<?php

namespace App\Tests\Handler;

use App\Handler\RoverHandlerEnglish;
use App\Handler\RoverHandlerFrench;
use App\Model\RoverInterface;
use App\Model\Point;
use PHPUnit\Framework\TestCase;

class RoverHandlerTest extends TestCase
{
    private $mockRover;
    private $mockPoint;

    public function setUp(): void
    {
        $this->mockRover = $this->prophesize(RoverInterface::class);
        $this->mockPoint = $this->prophesize(Point::class);
    }

    public function testEnglishInvalidInstruction(): void
    {
        $this->expectExceptionMessage( 'Unexpected instruction: invalid key, allowed are: b, f, l, r');
        $handler = new RoverHandlerEnglish($this->mockRover->reveal());
        $handler->sendInstructions(['invalid key']);
    }

    public function testFrenchInvalidInstruction(): void
    {
        $this->expectExceptionMessage( 'Unexpected instruction: invalid key, allowed are: r, a, g, d');
        $handler = new RoverHandlerFrench($this->mockRover->reveal());
        $handler->sendInstructions(['invalid key']);
    }

    /**
     * @dataProvider provideSendInstructionsData
     */
    public function testSendInstructions(
        string $handlerClassName,
        array $instructions,
        int $nbCallForward,
        int $nbCallBackward,
        int $nbCallLeft,
        int $nbCallRight
    ): void
    {
        $handler = new $handlerClassName($this->mockRover->reveal());
        $handler->sendInstructions($instructions);

        if ($nbCallForward > 0) {
            $this->mockRover->forward()->shouldBeCalled($nbCallForward);
        } else {
            $this->mockRover->forward()->shouldNotBeCalled();
        }

        if ($nbCallBackward > 0) {
            $this->mockRover->backward()->shouldBeCalled($nbCallBackward);
        } else {
            $this->mockRover->backward()->shouldNotBeCalled();
        }

        if ($nbCallLeft > 0) {
            $this->mockRover->left()->shouldBeCalled($nbCallLeft);
        } else {
            $this->mockRover->left()->shouldNotBeCalled();
        }

        if ($nbCallRight > 0) {
            $this->mockRover->right()->shouldBeCalled($nbCallRight);
        } else {
            $this->mockRover->right()->shouldNotBeCalled();
        }
    }

    public function provideSendInstructionsData(): array
    {
        return [
            // english
            [RoverHandlerEnglish::class, [], 0, 0, 0, 0],
            [RoverHandlerEnglish::class, ['f'], 1, 0, 0, 0],
            [RoverHandlerEnglish::class, ['b'], 0, 1, 0, 0],
            [RoverHandlerEnglish::class, ['l'], 0, 0, 1, 0],
            [RoverHandlerEnglish::class, ['r'], 0, 0, 0, 1],
            [RoverHandlerEnglish::class, ['r', 'f', 'f', 'b', 'f', 'l', 'f', 'l', 'b'], 4, 2, 2, 1],

            // french
            [RoverHandlerFrench::class, [], 0, 0, 0, 0],
            [RoverHandlerFrench::class, ['a'], 1, 0, 0, 0],
            [RoverHandlerFrench::class, ['r'], 0, 1, 0, 0],
            [RoverHandlerFrench::class, ['g'], 0, 0, 1, 0],
            [RoverHandlerFrench::class, ['d'], 0, 0, 0, 1],
            [RoverHandlerFrench::class, ['d', 'a', 'a', 'r', 'a', 'g', 'a', 'g', 'r'], 4, 2, 2, 1],
        ];
    }
}
