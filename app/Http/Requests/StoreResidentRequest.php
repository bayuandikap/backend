<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreResidentRequest extends FormRequest
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
            'nik' => [
                'required',
                'max:20',
                'unique:residents'
            ],

            'name' => [
                'required',
                'max:255'
            ],

            'phone' => [
                'nullable',
                'max:20'
            ],

            'email' => [
                'nullable',
                'email',
                'max:255'
            ],

            'birth_date' => [
                'nullable',
                'date'
            ],

            'ktp_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'resident_status' => [
                'required',
                'in:permanent,contract'
            ],

            'is_married' => [
                'required',
                'boolean'
            ],
        ];
    }
}
