<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $purchases = Purchase::with(['supplier', 'products'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('supplier', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('products', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.product.index', compact('purchases'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('admin.product.create', compact('products', 'categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request  $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
            ->paginate(10);
        return view('cashier.product.index', compact('products'));
    }

    public function productMember(Request $request)
    {
        // Mendapatkan query pencarian dari parameter request
        $search = $request->input('search');

        // Jika ada pencarian, filter produk berdasarkan nama
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
            // Menambahkan pagination, 10 produk per halaman
            ->paginate(10);

        return view('member.product.index', compact('products'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
