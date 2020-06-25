<?php

namespace App\ValueObjects;


class Platform
{
    public static function availablePlatforms()
    {
        return [
            9 => 'PlayStation 3',
            15 => 'PC',
            12 => 'Xbox 360',
            48 => 'Playstation 4',
            49 => 'Xbox One',
            130 => 'Nintendo Switch',
        ];
    }

    public static function getLabelById($id)
    {
        return data_get(self::availablePlatforms(), $id);
    }
}
