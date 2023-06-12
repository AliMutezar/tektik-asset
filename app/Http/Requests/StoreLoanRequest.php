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
            'asset_id' => ['required', 'integer'],
            'asset_id*' => ['distinct'],
            
            'unit_asset_received' => ['required', 'integer'],
            'loan_user_id' => ['required', 'integer'],
            'signature_loan' => ['nullable', 'string'],
            'admin_user_id' => ['required', 'integer'],
            'signature_admin' => ['nullable', 'string'],
            'date_receipt' => ['required', 'date'],
            'photo_receipt' => ['image', 'max:1048'],
            'status' => ['required', 'boolean'],
            'return_code' => ['nullable', 'unique:loans,return_code']
        ];
    }
}
