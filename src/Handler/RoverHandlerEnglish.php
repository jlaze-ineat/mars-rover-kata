<?php

namespace App\Handler;

class RoverHandlerEnglish extends RoverHandler
{
    public function getInstructionsMapping(): array
    {
        return [
            'b' => 'backward',
            'f' => 'forward',
            'l' => 'left',
            'r' => 'right',
        ];
    }
}
