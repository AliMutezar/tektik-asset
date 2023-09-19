<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'loan_code' => ['required', 'unique:loans,loan_code'],
            'asset_id' => ['required', 'array'],
            'asset_id.*' => 'exists:assets,id',
            'serial_number' => ['nullable', 'array'],
            'unit_borrowed' => ['required', 'array'],
            'unit_borrowed.*' => 'numeric|min:0',
            'loan_user_id' => ['required', 'integer'],
            'date_receipt' => ['required', 'date'],
            'photo_receipt' => ['required', 'image', 'max:1048'],
        ];
    }
}
