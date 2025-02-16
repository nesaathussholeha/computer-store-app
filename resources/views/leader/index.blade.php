@extends('leader.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle overflow-hidden me-6">
                                    <img src="{{ asset('assets/dist/images/profile/empty-user.jpg') }}" alt=""
                                        width="40" height="40">
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">Selamat Datang, Pimpinan {{ auth()->user()->name }}!</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <p>Selamat datang di halaman Pimpinan! Kelola dan pantau kegiatan operasional tim dengan
                                    mudah.</p>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/welcome-bg.svg"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-cart.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="sales-two" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">{{ $salesCount }}<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Penjualan</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-info rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-bar.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="growth" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">{{ $purchaseCount }}<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Pembelian</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12 col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Penjualan Hari Ini</h5>
                        </div>
                        <div class="mb-3 mb-sm-0">
                            <p class="card-title fw-semibold fs-3">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">No</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah Terjual</th>
                                    <th scope="col">Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @forelse ($groupedSales as $sale)
                                    <tr>
                                        <td class="ps-0">
                                            <h6 class="fw-semibold mb-1">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h6 class="fw-semibold mb-1">{{ $sale['product']->name }}</h6>
                                                    <p class="fs-2 mb-0 text-muted">{{ $sale['product']->category->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 fs-3 text-dark">{{ $sale['quantity'] }}</p>
                                        </td>
                                        <td>
                                            <p class="fs-3 text-dark mb-0">Rp. {{ number_format($sale['subtotal'], 0, ',', '.') }}</p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data penjualan untuk hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
