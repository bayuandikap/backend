<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Payment;

class UpdatePaymentRequest extends FormRequest
{
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

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {

            if (
                !$this->house_id ||
                !$this->payment_type_id ||
                !$this->month ||
                !$this->year
            ) {
                return;
            }

            $payment = $this->route('payment');

            $exists = Payment::where(
                'house_id',
                $this->house_id
            )
                ->where(
                    'payment_type_id',
                    $this->payment_type_id
                )
                ->where(
                    'month',
                    $this->month
                )
                ->where(
                    'year',
                    $this->year
                )
                ->when(
                    $payment,
                    function ($query) use ($payment) {
                        $query->where('id', '!=', $payment->id);
                    }
                )
                ->exists();

            if ($exists) {

                $validator->errors()->add(
                    'payment',
                    'A payment for this house, payment type, month and year already exists.'
                );
            }
        });
    }
}
