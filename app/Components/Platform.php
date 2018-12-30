<?php

namespace App\Components;


class Platform
{
    public static function availablePlatforms()
    {
        return [
            9 => 'PlayStation 3',
            12 => 'Xbox 360',
            48 => 'Playstation 4',
            49 => 'Xbox One',
            130 => 'Nintendo Switch',
        ];
    }
}