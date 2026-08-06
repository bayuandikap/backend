<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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

            'house_resident_id' => [
                'required',
                'exists:house_residents,id'
            ],

            'payment_type_id' => [
                'required',
                'exists:payment_types,id'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'payment_date' => [
                'required',
                'date'
            ],

            'status' => [
                'required',
                'in:paid,unpaid'
            ],

            'notes' => [
                'nullable',
                'string'
            ]

        ];
    }
}
