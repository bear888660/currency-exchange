<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Objects\Money;

class MoneyTest extends TestCase
{
    public function test_money_can_be_created_from_construct(): void
    {
        $money = Money::createFromFormat(1525, "USD");

        $this->assertEquals("USD", $money->getCurrency());
        $this->assertEquals("1525", $money->getAmount());
    }

    public function test_money_can_be_created_from_formatted_string(): void
    {
        $money = Money::createFromFormat("$1,525", "USD");

        $this->assertEquals("USD", $money->getCurrency());
        $this->assertEquals("1525", $money->getAmount());
    }  
    
    public function test_money_can_be_formatted()
    {
        $money = Money::createFromFormat("$1,525", "USD");

        $amount = $money->toFormat();

        $this->assertEquals("$1,525.00", $amount);
    }

    public function test_money_with_point_can_be_formatted_and_rounded()
    {
        $money = Money::createFromFormat("$1,525.571", "USD");
        $truncateAmount = $money->toFormat();
        $this->assertEquals("$1,525.57", $truncateAmount);

        $money = Money::createFromFormat("$1,525.576", "USD");
        $roundupAmount = $money->toFormat();
        $this->assertEquals("$1,525.58", $roundupAmount);
    }
}