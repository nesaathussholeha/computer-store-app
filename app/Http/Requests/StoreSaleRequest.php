<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'member_id' => 'nullable|exists:members,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'amount_paid' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Minimal satu produk harus dipilih.',
            'products.*.product_id.required' => 'Produk harus dipilih.',
            'products.*.product_id.exists' => 'Produk yang dipilih tidak valid.',
            'products.*.quantity.required' => 'Jumlah produk harus diisi.',
            'products.*.quantity.integer' => 'Jumlah produk harus berupa angka.',
            'products.*.quantity.min' => 'Jumlah produk minimal 1.',
            'amount_paid.required' => 'Jumlah yang dibayar harus diisi.',
            'amount_paid.integer' => 'Jumlah yang dibayar harus berupa angka.',
            'amount_paid.min' => 'Jumlah yang dibayar tidak boleh negatif.',
        ];
    }
}
