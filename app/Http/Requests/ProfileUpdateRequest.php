<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:255'],
            'email' => ['required','email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id), 'ends_with:com,id'],
            'nik' => ['required', 'min:6'],
            'phone' => ['required', 'min:11'],
            'division_id' => ['required'],
            'role' => ['required'],
            'image' => ['image', 'max:1048'],
            'position' => ['required', 'string']
        ];
    }
}
