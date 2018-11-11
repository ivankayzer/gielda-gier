<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Krossroad\UnionPaginator\UnionPaginatorTrait;

class Transaction extends Model
{
    use UnionPaginatorTrait;

    protected $casts = [
        'seller_value' => 'array',
        'buyer_value' => 'array'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class);
    }
}
