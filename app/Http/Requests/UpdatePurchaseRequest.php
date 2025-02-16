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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'details.*.id' => 'nullable|exists:purchase_details,id',
            'details.*.name' => 'required|string|max:255',
            'details.*.category_id' => 'required|exists:categories,id',
            'details.*.weight' => 'required|integer|min:1',
            'details.*.price' => 'required|integer|min:0',
            'details.*.stock' => 'required|integer|min:0',
            'details.*.description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Supplier harus dipilih.',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid.',
            'tgl_beli.required' => 'Tanggal pembelian harus diisi.',
            'tgl_beli.date' => 'Tanggal pembelian harus berupa tanggal yang valid.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'details.*.id.exists' => 'Detail pembelian dengan ID yang diberikan tidak ditemukan.',
            'details.*.name.required' => 'Nama produk harus diisi.',
            'details.*.name.string' => 'Nama produk harus berupa string.',
            'details.*.name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'details.*.category_id.required' => 'Kategori produk harus dipilih.',
            'details.*.category_id.exists' => 'Kategori produk yang dipilih tidak valid.',
            'details.*.weight.required' => 'Berat produk harus diisi.',
            'details.*.weight.integer' => 'Berat produk harus berupa angka.',
            'details.*.weight.min' => 'Berat produk harus lebih dari atau sama dengan 1.',
            'details.*.price.required' => 'Harga produk harus diisi.',
            'details.*.price.integer' => 'Harga produk harus berupa angka.',
            'details.*.price.min' => 'Harga produk harus lebih dari atau sama dengan 0.',
            'details.*.stock.required' => 'Stok produk harus diisi.',
            'details.*.stock.integer' => 'Stok produk harus berupa angka.',
            'details.*.stock.min' => 'Stok produk harus lebih dari atau sama dengan 0.',
            'details.*.description.string' => 'Deskripsi produk harus berupa string.',
        ];
    }
}
