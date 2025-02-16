<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaderDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data penjualan hari ini
        $sales = Sale::whereDate('created_at', Carbon::today())
            ->with('saleDetails.product') // Mengambil relasi saleDetails dan product
            ->get();

        // Gabungkan barang yang sama
        $groupedSales = $sales->flatMap(function ($sale) {
            return $sale->saleDetails->map(function ($detail) use ($sale) {
                return [
                    'product' => $detail->product,
                    'quantity' => $detail->quantity,
                    'subtotal' => $detail->subtotal,
                    'paid_amount' => $sale->paid_amount,  // Nilai pembayaran dari transaksi penjualan
                    'total_price' => $sale->total_price,  // Nilai total harga dari transaksi penjualan
                ];
            });
        })->groupBy('product.id')->map(function ($group) {
            return [
                'product' => $group->first()['product'],
                'quantity' => $group->sum('quantity'),
                'subtotal' => $group->sum('subtotal'),
                'paid_amount' => $group->first()['paid_amount'],  // Mengambil nilai pertama
                'total_price' => $group->first()['total_price'],  // Mengambil nilai pertama
            ];
        });

        $salesCount = Sale::count();
        $purchaseCount = Purchase::count();

        return view('leader.index', compact('groupedSales', 'salesCount', 'purchaseCount'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
