<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'products' => 'required|array',
            'products.*.name' => 'required|string',
            'products.*.category_id' => 'required|exists:categories,id',
            'products.*.weight' => 'required|numeric',
            'products.*.price' => 'required|numeric',
            'products.*.stock' => 'required|integer',
            'products.*.description' => 'nullable|string',
            'products.*.image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => 'Supplier wajib diisi.',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid.',

            'purchase_date.required' => 'Tanggal pembelian wajib diisi.',
            'purchase_date.date' => 'Format tanggal pembelian tidak valid.',

            'products.required' => 'Minimal satu produk harus ditambahkan.',
            'products.array' => 'Format produk tidak valid.',

            'products.*.name.required' => 'Nama produk wajib diisi.',
            'products.*.name.string' => 'Nama produk harus berupa teks.',
            'products.*.name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'products.*.category_id.required' => 'Kategori produk wajib diisi.',
            'products.*.category_id.exists' => 'Kategori produk yang dipilih tidak valid.',

            'products.*.weight.required' => 'Berat produk wajib diisi.',
            'products.*.weight.integer' => 'Berat produk harus berupa angka.',
            'products.*.weight.min' => 'Berat produk minimal 1 gram.',

            'products.*.price.required' => 'Harga produk wajib diisi.',
            'products.*.price.integer' => 'Harga produk harus berupa angka.',
            'products.*.price.min' => 'Harga produk minimal 1.',

            'products.*.stock.required' => 'Stok produk wajib diisi.',
            'products.*.stock.integer' => 'Stok produk harus berupa angka.',
            'products.*.stock.min' => 'Stok produk minimal 1.',

            'products.*.description.string' => 'Deskripsi produk harus berupa teks.',

            'products.*.image.image' => 'File harus berupa gambar.',
            'products.*.image.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'products.*.image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
    }
}
