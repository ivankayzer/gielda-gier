<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class City extends Model
{
    use Searchable;

    public $timestamps = false;

    public function searchableAs()
    {
        return 'cities';
    }
}
