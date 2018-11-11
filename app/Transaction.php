<?php

namespace App;

use App\ValueObjects\TransactionStatus;
use Illuminate\Database\Eloquent\Model;
use Krossroad\UnionPaginator\UnionPaginatorTrait;

class Transaction extends Model
{
    use UnionPaginatorTrait;

    protected $casts = [
        'seller_value' => 'array',
        'buyer_value' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', TransactionStatus::IN_PROGRESS);
    }

    public function scopePending($query)
    {
        return $query->where('status_id', TransactionStatus::PENDING);
    }

    public function scopeCompleted($query)
    {
        return $query->whereIn('status_id', [TransactionStatus::CANCELED, TransactionStatus::COMPLETED, TransactionStatus::DECLINED]);
    }

    public function status()
    {
        return new TransactionStatus($this->status_id);
    }

    public function isTrade()
    {
        return in_array($this->status_id, [
            TransactionStatus::PENDING,
            TransactionStatus::DECLINED
        ]);
    }
}
