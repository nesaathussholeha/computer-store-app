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
            'purchase_date' => 'nullable|date|before_or_equal:today',
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:255',
            'products.*.category_id' => 'required|exists:categories,id',
            'products.*.weight' => 'required|numeric|min:1|max:100000',
            'products.*.price' => 'required|numeric|min:1|max:100000000',
            'products.*.stock' => 'required|integer|min:1|max:10000',
            'products.*.description' => 'nullable|string|max:500', 
            'products.*.image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => 'Supplier wajib diisi.',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid.',

            'purchase_date.date' => 'Format tanggal pembelian tidak valid.',
            'purchase_date.before_or_equal' => 'Tanggal pembelian tidak boleh lebih dari hari ini.',

            'products.required' => 'Minimal satu produk harus ditambahkan.',
            'products.array' => 'Format produk tidak valid.',

            'products.*.name.required' => 'Nama produk wajib diisi.',
            'products.*.name.string' => 'Nama produk harus berupa teks.',
            'products.*.name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'products.*.category_id.required' => 'Kategori produk wajib diisi.',
            'products.*.category_id.exists' => 'Kategori produk yang dipilih tidak valid.',

            'products.*.weight.required' => 'Berat produk wajib diisi.',
            'products.*.weight.numeric' => 'Berat produk harus berupa angka.',
            'products.*.weight.min' => 'Berat produk minimal 1 gram.',
            'products.*.weight.max' => 'Berat produk maksimal 100 kg.',

            'products.*.price.required' => 'Harga produk wajib diisi.',
            'products.*.price.numeric' => 'Harga produk harus berupa angka.',
            'products.*.price.min' => 'Harga produk minimal 1.',
            'products.*.price.max' => 'Harga produk tidak boleh lebih dari 100 juta.',

            'products.*.stock.required' => 'Stok produk wajib diisi.',
            'products.*.stock.integer' => 'Stok produk harus berupa angka.',
            'products.*.stock.min' => 'Stok produk minimal 1.',
            'products.*.stock.max' => 'Stok produk maksimal 10.000.',

            'products.*.description.string' => 'Deskripsi produk harus berupa teks.',
            'products.*.description.max' => 'Deskripsi produk tidak boleh lebih dari 500 karakter.',

            'products.*.image.image' => 'File harus berupa gambar.',
            'products.*.image.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'products.*.image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
    }
}
