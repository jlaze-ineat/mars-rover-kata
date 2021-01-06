<?php

namespace App\Handler;

class RoverHandlerFrench extends RoverHandler
{
    public function getInstructionsMapping(): array
    {
        return [
            'r' => 'backward',
            'a' => 'forward',
            'g' => 'left',
            'd' => 'right',
        ];
    }
}
