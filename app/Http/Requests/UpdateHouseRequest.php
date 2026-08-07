<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'house_number' => [
                'required',
                'max:20',
                Rule::unique('houses')
                    ->ignore($this->route('house')),
            ],

            'block' => [
                'nullable',
                'max:10',
            ],

            'status' => [
                'required',
                'in:occupied,vacant',
            ],
        ];
    }
}
