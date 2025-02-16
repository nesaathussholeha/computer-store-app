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
use Illuminate\Support\Facades\Storage;


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

    public function purchaseReport(Request $request)
    {
        $query = Purchase::with(['supplier', 'purchaseDetails.product']);

        // Filter berdasarkan tanggal hanya jika start_date dan end_date diisi
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_beli', [$request->start_date, $request->end_date]);
        }

        $purchases = $query->get();
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        return view('leader.purchase.index', compact('purchases', 'start_date', 'end_date'));
    }


    public function downloadReport(Request $request)
    {
        $query = Purchase::with(['supplier', 'purchaseDetails.product']);

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $query->whereBetween('tgl_beli', [$start_date, $end_date]);
        }

        $purchases = $query->get();

        // Hitung subtotal untuk setiap pembelian
        foreach ($purchases as $purchase) {
            $purchase->subtotal = $purchase->purchaseDetails->sum('sub_total');
        }

        // Hitung total semua pembelian
        $total = $purchases->sum('subtotal');

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('leader.pdf.reportPurchase', compact('purchases', 'start_date', 'end_date', 'total'));
        return $pdf->download('laporan_pembelian.pdf');
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
    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
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
        ]);

        #Update data purchase
        if ($request->hasFile('image')) {
            if ($purchase->image) {
                Storage::delete($purchase->image);
            }
            $validated['image'] = $request->file('image')->store('uploads/products');
        }

        $purchase->update([
            'supplier_id' => $validated['supplier_id'],
            'tgl_beli' => $validated['tgl_beli'],
            'image' => $validated['image'] ?? $purchase->image,
        ]);

        #Perhitungan ulang total
        $total = 0;

        foreach ($request->details as $detail) {
            $purchaseDetail = PurchaseDetail::find($detail['id']);

            if ($purchaseDetail) {
                #Update produk & subtotal
                $product = Product::updateOrCreate(
                    ['id' => $purchaseDetail->product_id],
                    [
                        'name' => $detail['name'],
                        'category_id' => $detail['category_id'],
                        'weight' => $detail['weight'],
                        'price' => $detail['price'],
                        'stock' => $detail['stock'],
                        'description' => $detail['description'] ?? null,
                    ]
                );

                #Update purchase detail & subtotal
                $purchaseDetail->update([
                    'product_id' => $product->id,
                    'jumlah_beli' => $detail['stock'], // Update jumlah beli dari stok
                    'sub_total' => $detail['price'] * $detail['stock'], // Perhitungan ulang subtotal
                ]);

                // **Tambahkan ke total**
                $total += $purchaseDetail->sub_total;
            } else {
                // **Tambah produk baru**
                $product = Product::create([
                    'name' => $detail['name'],
                    'category_id' => $detail['category_id'],
                    'weight' => $detail['weight'],
                    'price' => $detail['price'],
                    'stock' => $detail['stock'],
                    'description' => $detail['description'] ?? null,
                ]);

                // **Tambah purchase detail baru**
                $purchaseDetail = PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->id,
                    'jumlah_beli' => $detail['stock'], // Sesuai jumlah beli
                    'sub_total' => $detail['price'] * $detail['stock'], // Perhitungan subtotal
                ]);

                // **Tambahkan ke total**
                $total += $purchaseDetail->sub_total;
            }
        }

        // **Update total di purchases**
        $purchase->update(['total' => $total]);

        return redirect()->route('product.index')->with('success', 'Data pembelian berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        // Ambil semua product_id yang terkait sebelum menghapus purchase details
        $productIds = $purchase->purchaseDetails()->pluck('product_id');

        // Hapus semua detail pembelian terkait
        $purchase->purchaseDetails()->delete();

        // Hapus produk yang sudah tidak memiliki detail pembelian terkait
        Product::whereIn('id', $productIds)->delete();

        // Hapus gambar jika ada
        if ($purchase->image) {
            Storage::delete($purchase->image);
        }

        // Hapus data pembelian utama
        $purchase->delete();

        return redirect()->route('product.index')->with('success', 'Data pembelian dan produk terkait berhasil dihapus!');
    }
}
