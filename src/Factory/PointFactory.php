<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Point\EastPoint;
use App\Model\Point\NorthPoint;
use App\Model\Point\PointInterface;
use App\Model\Point\SouthPoint;
use App\Model\Point\WestPoint;

class PointFactory
{
    private const DIRECTIONS_MAPPING = [
        'N' => NorthPoint::class,
        'W' => WestPoint::class,
        'S' => SouthPoint::class,
        'E' => EastPoint::class,
    ];

    public static function create(int $x, int $y, string $direction): PointInterface
    {
        if (!\array_key_exists($direction, self::DIRECTIONS_MAPPING)) {
            throw new \Exception(
                \sprintf(
                    'Invalid direction: %s, allowed are: %s',
                    $direction,
                    implode(', ', \array_keys(self::DIRECTIONS_MAPPING))
                )
            );
        }

        $pointClass = self::DIRECTIONS_MAPPING[$direction];

        return new $pointClass($x, $y);
    }
}
