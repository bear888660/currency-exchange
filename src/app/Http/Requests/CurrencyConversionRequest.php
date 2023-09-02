<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyConversionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'source' => [
                'required',
                Rule::in(['USD', 'TWD', 'JPY'])
            ],
            'target' => [
                'required',
                Rule::in(['USD', 'TWD', 'JPY'])
            ],
            'amount' => [
                'required',
                'regex:/^\$\d{1,3}(,\d{3})*$/'
            ]
        ];
    }
}