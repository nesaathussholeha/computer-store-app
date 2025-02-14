<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseDetailRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:255',
            'products.*.category_id' => 'required|exists:categories,id',
            'products.*.weight' => 'required|integer|min:1',
            'products.*.price' => 'required|integer|min:1',
            'products.*.stock' => 'required|integer|min:1',
            'products.*.description' => 'nullable|string',
            'products.*.image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
