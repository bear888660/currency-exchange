<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Objects\Money;

class MoneyTest extends TestCase
{
    public function test_construct(): void
    {
        $money = Money::createFromFormat("$1,525", "USD");

        $this->assertEquals("USD", $money->getCurrency());
        $this->assertEquals("1525", $money->getAmount());
    }
    
    public function test_to_format()
    {
        $money = Money::createFromFormat("$1,525", "USD");

        $amount = $money->toFormat();

        $this->assertEquals("$1,525.00", $amount);
    }

    public function test_money_with_point_to_rounded_format()
    {
        $money = Money::createFromFormat("$1,525.571", "USD");
        $truncateAmount = $money->toFormat();
        $this->assertEquals("$1,525.57", $truncateAmount);

        $money = Money::createFromFormat("$1,525.576", "USD");
        $roundupAmount = $money->toFormat();
        $this->assertEquals("$1,525.58", $roundupAmount);
    }

    public function test_exchange()
    {
        $money = Money::createFromFormat("$1,525", "USD");
        $money->exchange("JPY");
        $amount = $money->getAmount();

        $this->assertEquals("170496.525", $amount);
    }
}