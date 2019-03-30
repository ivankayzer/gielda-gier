<?php

namespace App;

use App\ValueObjects\TransactionStatus;
use Illuminate\Database\Eloquent\Model;
use Krossroad\UnionPaginator\UnionPaginatorTrait;

class Transaction extends Model
{
    use UnionPaginatorTrait;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('updated_at', 'desc');
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

    public function offer()
    {
        return $this->belongsTo(Offer::class);
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

    public function scopeToRate($query, $type)
    {
        $column = "{$type}_comment";

        return $query->whereIn('status_id', [TransactionStatus::COMPLETED])->where($column, false);
    }

    public function status()
    {
        return new TransactionStatus($this->status_id);
    }

    public function otherPerson()
    {
        if ($this->seller->id === auth()->user()->id) {
            return $this->buyer();
        }

        return $this->seller();
    }

    public function otherPersonType()
    {
        if ($this->seller->id === auth()->user()->id) {
            return __('transactions.buyer');
        }

        return __('transactions.seller');
    }

    public function isSeller()
    {
        return $this->seller->id === auth()->user()->id;
    }

    public function isBuyer()
    {
        return !$this->isSeller();
    }

    public function isTrade()
    {
        return in_array($this->status_id, [
            TransactionStatus::PENDING,
            TransactionStatus::DECLINED
        ]);
    }

    public function game()
    {
        return $this->offer->game;
    }
}
