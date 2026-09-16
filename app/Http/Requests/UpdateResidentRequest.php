<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateResidentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nik' => [
                'required',
                'max:20',
                Rule::unique('residents')->ignore($this->resident),
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],

            'gender' => [
                'required',
                'in:male,female',
            ],

            'address' => [
                'nullable',
                'max:255',
            ],

            'occupation' => [
                'nullable',
                'max:255',
            ],

            'ktp_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'remove_ktp_photo' => [
                'nullable',
                'boolean',
            ],

            'resident_status' => [
                'required',
                'in:permanent,contract',
            ],

            'is_married' => [
                'required',
                'boolean',
            ],
        ];
    }
}
