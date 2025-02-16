<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LeaderDashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CashierMiddleware;
use App\Http\Middleware\LeaderMiddleware;
use App\Http\Middleware\MemberMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login'); // Mengarahkan ke halaman login
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    Route::resource('category', CategoryController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('product', ProductController::class);
    Route::resource('purchase', PurchaseController::class);
});



Route::middleware(['auth', CashierMiddleware::class])->group(function () {
    Route::get('/cashier/dashboard', function () {
        return view('cashier.index');
    })->name('cashier.dashboard');

    Route::resource('member', MemberController::class);
    Route::resource('sale', SaleController::class);
    Route::get('list/product', [ProductController::class, 'show'])->name('product.list');
});


Route::middleware(['auth', LeaderMiddleware::class])->group(function () {

    Route::get('/leader/dashboard', [LeaderDashboardController::class, 'index'])->name('dashboard.leader');

    Route::get('report/purchase', [PurchaseController::class, 'purchaseReport'])->name('report.purchase');
    Route::get('/leader/purchase/download', [PurchaseController::class, 'downloadReport'])->name('purchase.download');

    Route::get('report/sales', [SaleController::class, 'reportSales'])->name('report.sale');
    Route::get('report/sales/download', [SaleController::class, 'downloadReport'])->name('sales.download');
});

Route::middleware(['auth', MemberMiddleware::class])->group(function () {

    Route::get('dashboard/member', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    Route::get('transaction/history', [SaleController::class, 'history'])->name('member.transaction');
    Route::get('/transaction/history/detail/{id}', [SaleController::class, 'show'])->name('sale.show');
    Route::get('/list/product/member', [ProductController::class, 'productMember'])->name('product.member.show');

});
