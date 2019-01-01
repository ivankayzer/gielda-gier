<?php

namespace App\Components;

class Price
{
    /** @var string */
    private $value;

    /**
     * Price constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = (float) $value;
    }

    public function __toString(): string
    {
        return str_replace('.', ',', money_format('%.2n', $this->value / 100));
    }
}