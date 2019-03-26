<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    public function getUrlParam()
    {
        return join(',', [$this->id, $this->slug]);
    }

    public static function getList()
    {
        return self::all()->pluck('name', 'slug');
    }
}
