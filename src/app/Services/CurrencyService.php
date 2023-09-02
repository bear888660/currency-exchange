<?php

namespace App\Services;

use App\Objects\Money;

class CurrencyService
{
    private $currencyExchangeMap = [];

    public function __construct()
    {
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
    
    public function exchange(Money $money, $target)
    {
        $rate = (float)$this->currencyExchangeMap["currencies"][$money->getCurrency()][$target];

        $exchangedAmount = $rate * $money->getAmount();

        return new Money($exchangedAmount, $target);
    }
}