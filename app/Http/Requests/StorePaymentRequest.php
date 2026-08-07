<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    return [
        'house_id' => [
            'required',
            'exists:houses,id',
        ],

        'payment_type_id' => [
            'required',
            'exists:payment_types,id',
        ],

        'month' => [
            'required',
            'integer',
            'between:1,12',
        ],

        'year' => [
            'required',
            'integer',
            'digits:4',
        ],

        'amount' => [
            'required',
            'numeric',
            'min:0',
        ],

        'paid_at' => [
            'nullable',
            'date',
        ],

        'status' => [
            'required',
            'in:paid,unpaid',
        ],

        'notes' => [
            'nullable',
            'string',
        ],
    ];
}
}
