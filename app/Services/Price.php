<?php

namespace App\Services;

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
        return str_replace('.', ',', sprintf('%01.2f', $this->value / 100));
    }

    public static function createForDatabase($price)
    {
        $price = str_replace(' ', '', $price);

        foreach (['.', ','] as $delimiter) {
            if (strpos($price, $delimiter) !== false) {
                $newPrice = explode($delimiter, $price);
                return $newPrice[0] . ((strlen($newPrice[1]) === 2) ? $newPrice[1] : ($newPrice[1] . '0'));
            }
        }

        return $price * 100;
    }
}