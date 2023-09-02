<?php

namespace App\Objects;

class Money
{   
    private $amount;
    private $currency;
    private $presentPrecision = 2;
    

    public function __construct(Float $amount, String $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function createFromFormat(string $formattedAmount, String $currency)
    {
        $amount = floatval(str_replace([",", "$"], '', $formattedAmount));
        return new self($amount, $currency);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function toFormat()
    {
        $amount = round($this->amount, $this->presentPrecision);
        return "$" . number_format($amount, $this->presentPrecision, '.', ',');
    }
}