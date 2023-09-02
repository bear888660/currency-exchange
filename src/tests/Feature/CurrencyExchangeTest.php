<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class CurrencyExchangeTest extends TestCase
{
    public function test_exchange_from_USD_to_JPY_correctly()
    {
        $response =$this->json("get", '/currency/exchange?source=USD&target=JPY&amount=$1,525');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where("msg", 'success')
                 ->where("amount", "$170,496.53")
        );
        $response->assertStatus(200);
    }

    public function test_response_is_422_if_source_is_not_provided()
    {
        $response = $this->json("get", '/currency/exchange?target=JPY&amount=$1,525');
        $response->assertStatus(422);
    }

    public function test_response_is_422_if_target_is_not_provided()
    {
        $response = $this->json("get", '/currency/exchange?source=USD&amount=$1,525');
        $response->assertStatus(422);
    }

    public function test_response_is_422_if_amount_is_not_provided()
    {
        $response = $this->json("get", '/currency/exchange?source=USD&target=JPY');
        $response->assertStatus(422);
    }

    public function test_response_is_422_if_currency_is_not_supported()
    {
        $response = $this->json("get", '/currency/exchange?source=ABCDE&target=JPY&amount=$1,525');
        $response->assertStatus(422);
        $response = $this->json("get", '/currency/exchange?source=USD&target=ABCDE&amount=$1,525');
        $response->assertStatus(422);
    }

    public function test_response_is_422_if_amount_format_is_not_correctly()
    { 
        //$1,525vvvvv => 1525xxxx
        $response = $this->json("get", '/currency/exchange?source=USD&target=JPY&amount=1525');
        $response->assertStatus(422);
    }
}