<?php

require_once __DIR__.'/../vendor/autoload.php';

$handlers = [
    'e' => \App\Handler\RoverHandlerEnglish::class,
    'f' => \App\Handler\RoverHandlerFrench::class,
];

$rovers = [
    's' => \App\Model\RoverSlow::class,
    'f' => \App\Model\RoverFast::class,
];

$lang = null;
while (!\in_array($lang, ['e', 'f'])) {
    $lang = readline('Language (e/f)? ');
}

$type = null;
while (!\in_array($type, ['s', 'f'])) {
    echo "Choose the type\ns for slow rover : forward = 1, backward = 1\nf for fast rover : forward = 3, backward = 2\n";
    $type = readline('Type (s/f)? ');
}

$x = null;
while (!\is_numeric($x)) {
    $x = (int) readline('Start X-position? ');
}

$y = null;
while (!\is_numeric($y)) {
    $y = (int) readline('Start Y-position? ');
}

$direction = null;
while (!\in_array($direction, ['N', 'E', 'S', 'W'])) {
    $direction = readline('Direction (N/S/E/W)? ');
}

$handler = new $handlers[$lang](new $rovers[$type](new \App\Model\Point($x, $y), $direction));
$start = (string) $handler;
$finished = false;

while ($finished === false) {
    try {
        $instructions = readline('Enter instructions: ');
        $handler->sendInstructions(str_split($instructions));
        $finished = true;
    } catch (\Exception $e) {
        echo "Error: ".$e->getMessage()."\n";
    }
}

echo "------------------- START STATE -------------------\n";
echo $start;
echo "------------------- END STATE -------------------\n";
echo $handler;
