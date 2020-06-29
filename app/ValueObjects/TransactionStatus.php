<?php

namespace App\ValueObjects;

class TransactionStatus
{
    const PENDING = 1;

    const DECLINED = 2;

    const IN_PROGRESS = 3;

    const COMPLETED = 4;

    const CANCELED = 5;

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    private function getColors()
    {
        return [
            self::PENDING     => 'yellow',
            self::DECLINED    => 'red',
            self::IN_PROGRESS => 'yellow',
            self::COMPLETED   => 'green',
            self::CANCELED    => 'red',
        ];
    }

    private function getTexts()
    {
        return [
            self::PENDING     => __('transactions.pending'),
            self::DECLINED    => __('transactions.declined'),
            self::IN_PROGRESS => __('transactions.in_progress'),
            self::COMPLETED   => __('transactions.completed'),
            self::CANCELED    => __('transactions.canceled'),
        ];
    }

    public function isPending()
    {
        return $this->status === self::PENDING;
    }

    public function isInProgress()
    {
        return $this->status === self::IN_PROGRESS;
    }

    /**
     * @throws \Throwable
     *
     * @return string
     */
    public function getLabel()
    {
        $color = array_get($this->getColors(), $this->status);
        $text = array_get($this->getTexts(), $this->status);

        return view('chunks.transaction_status', ['color' => $color, 'text' => $text])->render();
    }
}
