<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
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
        DB::beginTransaction();

        try {
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'tgl_beli' => $request->tgl_beli ?? now()->toDateString(),
                'total' => 0,
            ]);

            $totalHarga = 0;

            foreach ($request->products as $productData) {
                // Menyimpan gambar jika ada
                $imagePath = null;
                if (!empty($productData['image']) && $productData['image']->isValid()) {
                    $imagePath = $productData['image']->store('products', 'public');
                }

                $product = Product::create([
                    'category_id' => $productData['category_id'],
                    'name' => $productData['name'],
                    'description' => $productData['description'] ?? null,
                    'weight' => $productData['weight'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'image' => $imagePath, // Simpan path gambar ke database
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
    public function edit($id)
    {
        $purchase = Purchase::with('purchaseDetails.product')->findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();

        // Cek apakah ada product terkait
        $product = optional($purchase->purchaseDetails->first())->product;

        return view('admin.product.update', compact('purchase', 'suppliers', 'categories', 'product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->update([
                'supplier_id' => $request->supplier_id,
                'tgl_beli' => $request->tgl_beli ?? now()->toDateString(),
            ]);

            $totalHarga = 0;
            $purchase->purchaseDetails()->delete();

            // Cek apakah $request->products ada dan tidak kosong
            if (!empty($request->products) && is_array($request->products)) {
                foreach ($request->products as $productData) {
                    $product = Product::findOrFail($productData['id']);

                    // Update data produk
                    $imagePath = $product->image;
                    if (!empty($productData['image']) && $productData['image']->isValid()) {
                        $imagePath = $productData['image']->store('products', 'public');
                    }

                    $product->update([
                        'category_id' => $productData['category_id'],
                        'name' => $productData['name'],
                        'description' => $productData['description'] ?? null,
                        'weight' => $productData['weight'],
                        'price' => $productData['price'],
                        'stock' => $productData['stock'],
                        'image' => $imagePath,
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
            } else {
                return redirect()->back()->with('error', 'Tidak ada produk yang dikirim.');
            }

            $purchase->update(['total' => $totalHarga]);

            DB::commit();

            return redirect()->route('product.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
