<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required','string', 'max:255'],
            'email' => ['required','email', 'max:255', 'email:rfc,dns'],
            'nik' => ['required', 'min:6'],
            'phone' => ['required', 'min:11'],
            'division_id' => ['required'],
            'role' => ['required'],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'password_confirmation' => ['nullable'],
            'position' => ['required', 'string']
        ];
    }
}
