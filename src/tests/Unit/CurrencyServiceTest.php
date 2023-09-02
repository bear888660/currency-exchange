<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Objects\Money;
use App\Services\CurrencyService;

class CurrencyServiceTest extends TestCase
{
    public function test_money_can_be_exchanged_to_target_currency()
    {
        $money = Money::createFromFormat("$1,525", "USD");

        $currencyService = New CurrencyService();
        $exchangedMoney = $currencyService->exchange($money, "JPY");

        $this->assertEquals("170496.525", $exchangedMoney->getAmount());
        $this->assertEquals("JPY", $exchangedMoney->getCurrency());
    }
}