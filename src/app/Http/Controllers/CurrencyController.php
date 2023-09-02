<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConversionRequest;
use App\Objects\Money;
use Illuminate\Routing\Controller as BaseController;

class CurrencyController extends BaseController
{
    public function exchange(CurrencyConversionRequest $request)
    {
        $source = $request->input("source");
        $target = $request->input("target");
        $formattedAmount = $request->input("amount");

        $money = Money::createFromFormat( $formattedAmount, $source);
        $money->exchange($target);

        return response()->json([
            "msg" => "success",
            "amount" => $money->toFormat()
        ]);
    }
}