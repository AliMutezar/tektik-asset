<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReturnRequest extends FormRequest
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
            'return_code' => ['required', 'unique:asset_returns,return_code'],
            'loan_id' => ['required'],
            // 'signature_returner' => ['nullable', 'string'],
            // 'admin_user_id' => ['required']
            // 'signature_admin' => ['nullable', 'string'],
            'date_returned' => ['required', 'date'],
            'photo_returned' => ['required', 'image', 'max:1048'],
        ];
    }
}
