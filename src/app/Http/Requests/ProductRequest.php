<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sku' => 'required|max:255|unique:products,sku',
            'name' => 'required|max:255',
            'price' => 'required|min:0|integer',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|string',
        ];
    }
}
