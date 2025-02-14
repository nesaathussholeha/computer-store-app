<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id', // Pastikan category_id ada dalam tabel categories
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'weight' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validasi file gambar
            'stock' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori produk yang dipilih tidak valid.',
            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk maksimal 255 karakter.',
            'description.string' => 'Deskripsi produk harus berupa teks.',
            'description.max' => 'Deskripsi produk maksimal 1000 karakter.',
            'weight.required' => 'Berat produk wajib diisi.',
            'weight.integer' => 'Berat produk harus berupa angka.',
            'weight.min' => 'Berat produk tidak boleh kurang dari 1.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.integer' => 'Harga produk harus berupa angka.',
            'price.min' => 'Harga produk tidak boleh kurang dari 1.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus bertipe JPG, PNG, JPEG, atau GIF.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'stock.required' => 'Jumlah stok produk wajib diisi.',
            'stock.integer' => 'Jumlah stok produk harus berupa angka.',
            'stock.min' => 'Jumlah stok produk tidak boleh kurang dari 0.',
        ];
    }
}
