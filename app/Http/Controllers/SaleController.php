<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Member;
use App\Models\Product;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('member.user')->latest()->paginate(10);
        return view('cashier.sales.index', compact('sales'));
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
    public function store(StoreSaleRequest $request)
    {
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
            'total_price' => $totalPrice,
            'paid_amount' => $request->amount_paid,
            'change_amount' => max($request->amount_paid - $totalPrice, 0), // Pastikan tidak negatif
        ]);

        // Simpan detail transaksi & kurangi stok
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $subtotal = $product->price * $productData['quantity'];

            // Cek apakah stok mencukupi
            if ($product->stock < $productData['quantity']) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk produk ' . $product->name);
            }

            // Simpan detail transaksi
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


    public function history()
    {
        $user = Auth::user(); // Ambil user yang login

        // Cek apakah user memiliki data member
        if (!$user->member) {
            return back()->with('error', 'Anda bukan member.');
        }

        $memberId = $user->member->id; // Ambil ID member dari user yang login

        $sales = Sale::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($sale) {
                return $sale->created_at->format('Y-m-d'); // Kelompokkan berdasarkan tanggal transaksi
            });

        return view('member.history.index', compact('sales'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sale = Sale::with('saleDetails.product')->findOrFail($id);
        return view('member.history.detail', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function reportSales(Request $request)
    {
        $query = Sale::with(['saleDetails.product', 'member.user']);

        // Filter berdasarkan tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filter berdasarkan nama member
        if ($request->filled('member_name')) {
            $query->whereHas('member.user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->member_name . '%');
            });
        }

        // Filter berdasarkan rentang total harga
        if ($request->filled('min_total')) {
            $query->where('total_price', '>=', $request->min_total);
        }
        if ($request->filled('max_total')) {
            $query->where('total_price', '<=', $request->max_total);
        }

        $sales = $query->latest()->paginate(10);

        return view('leader.sales.index', compact('sales', 'request'));
    }



    public function downloadReport(Request $request)
    {
        $query = Sale::with(['member.user', 'saleDetails.product']);

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Filter berdasarkan tanggal
        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $sales = $query->get();

        // Hitung subtotal untuk setiap penjualan
        foreach ($sales as $sale) {
            // Menghitung subtotal berdasarkan saleDetails
            $sale->subtotal = $sale->saleDetails->sum('subtotal');
        }

        // Hitung total pendapatan untuk semua penjualan
        $total_revenue = $sales->sum('subtotal');

        // Generate PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('leader.pdf.reportSales', compact('sales', 'start_date', 'end_date', 'total_revenue'));
        return $pdf->download('laporan_penjualan.pdf');
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
