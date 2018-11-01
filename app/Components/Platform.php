<?php

namespace App\Components;


class Platform
{
    public static function availablePlatforms()
    {
        return [
            'ps4' => 'Playstation 4',
            'xboxone' => 'Xbox One',
            'pc' => 'PC',
        ];
    }
}