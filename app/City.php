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

    public function getScoutKey()
    {
        return $this->slug;
    }

    public function getUrlParam()
    {
        return join(',', [$this->id, $this->slug]);
    }
}
