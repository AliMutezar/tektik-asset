<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssetRequest extends FormRequest
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
            'category_asset_id' => ['required', 'integer'],
            'vendor_id' => ['required', 'integer'],
            'asset_name' => ['required', 'string', 'max:255'],
            'condition' => ['required', Rule::in(['good', 'not bad', 'bad'])],
            'price_unit' => ['required', 'numeric', 'min:0'],
            'stock_unit' => ['required', 'integer', 'min:0']
        ];
    }
}
