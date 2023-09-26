<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyExchangeRequest;
use App\Objects\Money;
use App\Services\CurrencyService;
use Illuminate\Routing\Controller as BaseController;

class CurrencyController extends BaseController
{
    private $currencyService;
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function exchange(CurrencyExchangeRequest $request)
    {
        $source = $request->input("source");
        $target = $request->input("target");
        $formattedAmount = $request->input("amount");

        $money = Money::createFromFormat($formattedAmount, $source);
        $exchangedMoney = $this->currencyService->exchange($money, $target);

        return response()->json([
            "msg" => "success",
            "amount" => $exchangedMoney->toFormat()
        ]);
    }
}
