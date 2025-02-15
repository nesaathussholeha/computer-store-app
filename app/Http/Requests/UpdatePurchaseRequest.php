<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
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
            'tgl_beli' => 'required|date',
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',

        ];
    }


    public function messages()
    {
        return [
            'supplier_id.required' => 'Supplier wajib diisi.',
            'supplier_id.exists' => 'Supplier tidak valid.',
            'tgl_beli.date' => 'Tanggal beli harus berupa format tanggal yang valid.',
            'products.required' => 'Minimal harus ada satu produk.',
            'products.array' => 'Format produk tidak valid.',
            'products.*.id.required' => 'Produk harus dipilih.',
            'products.*.id.exists' => 'Produk tidak valid.',
            'products.*.category_id.required' => 'Kategori produk wajib diisi.',
            'products.*.category_id.exists' => 'Kategori produk tidak valid.',
            'products.*.name.required' => 'Nama produk wajib diisi.',
            'products.*.name.max' => 'Nama produk maksimal 255 karakter.',
            'products.*.description.string' => 'Deskripsi harus berupa teks.',
            'products.*.weight.required' => 'Berat produk wajib diisi.',
            'products.*.weight.numeric' => 'Berat produk harus berupa angka.',
            'products.*.weight.min' => 'Berat produk minimal 0.',
            'products.*.price.required' => 'Harga produk wajib diisi.',
            'products.*.price.numeric' => 'Harga produk harus berupa angka.',
            'products.*.price.min' => 'Harga produk minimal 0.',
            'products.*.stock.required' => 'Stok produk wajib diisi.',
            'products.*.stock.integer' => 'Stok produk harus berupa angka.',
            'products.*.stock.min' => 'Stok produk minimal 1.',
            'products.*.image.image' => 'File harus berupa gambar.',
            'products.*.image.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'products.*.image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
