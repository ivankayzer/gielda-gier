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
        $this->value = (float)$value;
    }

    public function __toString(): string
    {
        return str_replace('.', ',', money_format('%.2n', $this->value / 100));
    }

    public static function createForDatabase($price)
    {
        $price = str_replace(' ', '', $price);

        if (strpos($price, '.') !== false) {
            $newPrice = explode('.', $price);
            return $newPrice[0] . ((strlen($newPrice[1]) === 2) ? $newPrice[1] : ($newPrice[1] . '0'));
        }

        if (strpos($price, ',') !== false) {
            $newPrice = explode(',', $price);
            return $newPrice[0] . ((strlen($newPrice[1]) === 2) ? $newPrice[1] : ($newPrice[1] . '0'));
        }

        return $price * 100;
    }
}