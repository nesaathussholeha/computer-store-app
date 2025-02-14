<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetail;
use App\Http\Requests\StorePurchaseDetailRequest;
use App\Http\Requests\UpdatePurchaseDetailRequest;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseDetailRequest $request)
    {
        DB::beginTransaction();
        try {
            // Simpan data pembelian ke tabel `purchases`
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'total' => 0, // Akan dihitung ulang nanti
                'purchase_date' => $request->purchase_date,
            ]);

            $total = 0;
            foreach ($request->products as $productData) {
                // Simpan produk ke tabel `products`
                $product = Product::create([
                    'category_id' => $productData['category_id'],
                    'name' => $productData['name'],
                    'description' => $productData['description'] ?? null,
                    'weight' => $productData['weight'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'image' => $productData['image'] ?? null, // Jika ada gambar
                ]);

                // Simpan ke `purchase_details`
                $subtotal = $productData['stock'] * $productData['price'];
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->id,
                    'purchased_quantity' => $productData['stock'],
                    'sub_total' => $subtotal,
                ]);

                // Tambahkan subtotal ke total keseluruhan
                $total += $subtotal;
            }

            // Update total pembelian
            $purchase->update(['total' => $total]);

            DB::commit();
            return redirect()->back()->with('success', 'Pembelian berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseDetailRequest $request, PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        //
    }
}
