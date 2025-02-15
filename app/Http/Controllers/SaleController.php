<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Member;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cashier.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        $products = Product::all();
        return view('cashier.sales.create', compact('members', 'products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'nullable|exists:members,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'amount_paid' => 'required|integer|min:0',
        ]);

        // Cek apakah ada member (jika iya, dapat diskon 10%)
        $isMember = !empty($request->member_id);
        $discountRate = $isMember ? 0.10 : 0.00;

        $totalPrice = 0;

        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $subtotal = $product->price * $productData['quantity'];
            $totalPrice += $subtotal;
        }

        // Terapkan diskon jika member
        if ($isMember) {
            $discount = $totalPrice * $discountRate;
            $totalPrice -= $discount;
        }

        // Simpan transaksi penjualan
        $sale = Sale::create([
            'member_id' => $request->member_id,
            'total_price' => $totalPrice, // Sudah dihitung sebelum insert
            'paid_amount' => $request->amount_paid,
            'change_amount' => max($request->amount_paid - $totalPrice, 0), // Pastikan tidak negatif
        ]);

        // Simpan detail transaksi & kurangi stok
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $subtotal = $product->price * $productData['quantity'];

            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $productData['quantity'],
                'subtotal' => $subtotal,
            ]);

            // Kurangi stok produk
            $product->decrement('stock', $productData['quantity']);
        }

        return redirect()->route('sale.create')->with([
            'success' => 'Transaksi berhasil!',
            'total' => $totalPrice,
            'change' => max($request->amount_paid - $totalPrice, 0),
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
