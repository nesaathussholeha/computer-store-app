<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Product;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
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
    public function store(StorePurchaseRequest $request)
    {
        // $request->validate([
        //     'products' => 'required|array',
        //     'products.*.name' => 'required|string',
        //     'products.*.category_id' => 'required|exists:categories,id',
        //     'products.*.weight' => 'required|numeric',
        //     'products.*.price' => 'required|numeric',
        //     'products.*.stock' => 'required|integer',
        // ]);


        DB::beginTransaction();

        try {
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'tgl_beli' => $request->tgl_beli,
                'total' => 0,
            ]);

            $totalHarga = 0;

            foreach ($request->products as $productData) {
                $product = Product::create([
                    'category_id' => $productData['category_id'],
                    'name' => $productData['name'],
                    'description' => $productData['description'] ?? null,
                    'weight' => $productData['weight'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'image' => $productData['image'] ?? null,
                ]);

                $subTotal = $productData['price'] * $productData['stock'];
                $totalHarga += $subTotal;

                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->id,
                    'jumlah_beli' => $productData['stock'],
                    'sub_total' => $subTotal,
                ]);
            }

            $purchase->update(['total' => $totalHarga]);

            DB::commit();

            return redirect()->route('product.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
