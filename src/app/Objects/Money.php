<?php

namespace App\Objects;

class Money
{   
    private $amount;
    private $currency;
    private $presentPrecision = 2;
    private $currencyExchangeMap = [];

    private function __construct(Float $amount, String $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $json_data = '
        {
            "currencies": {
                "TWD": {
                    "TWD": 1,
                    "JPY": 3.669,
                    "USD": 0.03281
                },
                "JPY": {
                    "TWD": 0.26956,
                    "JPY": 1,
                    "USD": 0.00885
                },
                "USD": {
                    "TWD": 30.444,
                    "JPY": 111.801,
                    "USD": 1
                }
            }
        }';
        $this->currencyExchangeMap = json_decode($json_data, True);
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

    public function exchange(String $targetCurrency)
    {
        $rate = (float)$this->currencyExchangeMap["currencies"][$this->currency][$targetCurrency];

        $this->amount = $rate * $this->amount;
        $this->currency = $targetCurrency;
    }
}