<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsCount = Product::count();
        $suppliersCount = Supplier::count();
        $categoriesCount = Category::count();
        $purchaseCount = Purchase::count();

        return view('admin.index', compact('productsCount', 'suppliersCount', 'categoriesCount', 'purchaseCount'));
    }

}
