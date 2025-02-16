@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle overflow-hidden me-6">
                                    <img src="{{ asset('assets/dist/images/profile/empty-user.jpg') }}" alt=""
                                        width="40" height="40">
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">Selamat Datang {{ auth()->user()->name }}!</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <p>Selamat datang di halaman admin! Kelola data, pantau aktivitas, dan optimalkan sistem
                                    dengan mudah dan efisien.</p>
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

    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                        <div
                            class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-brand-superhuman">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M16 12l4 3l-8 7l-8 -7l4 -3" />
                                <path d="M12 3l-8 6l8 6l8 -6z" />
                                <path d="M12 15h8" />
                            </svg>
                        </div>
                        <div class="ms-3 align-self-center">
                            <h3 class="mb-0 fs-6">{{ $productsCount }}</h3>
                            <span class="text-muted">Produk</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                        <div
                            class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-info">
                            <i class="ti ti-users fs-6"></i>
                        </div>
                        <div class="ms-3 align-self-center">
                            <h3 class="mb-0 fs-6">{{ $suppliersCount }}</h3>
                            <span class="text-muted">Supplier</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                        <div
                            class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 4h6v6h-6z" />
                                <path d="M4 14h6v6h-6z" />
                                <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            </svg>
                        </div>
                        <div class="ms-3 align-self-center">
                            <h3 class="mb-0 fs-6">{{ $categoriesCount }}</h3>
                            <span class="text-muted">Kategori</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                        <div
                            class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-basket-down">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 10l-2 -6" />
                                <path d="M7 10l2 -6" />
                                <path
                                    d="M12 20h-4.756a3 3 0 0 1 -2.965 -2.544l-1.255 -7.152a2 2 0 0 1 1.977 -2.304h13.999a2 2 0 0 1 1.977 2.304l-.349 1.989" />
                                <path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M19 16v6" />
                                <path d="M22 19l-3 3l-3 -3" />
                            </svg>
                        </div>
                        <div class="ms-3 align-self-center">
                            <h3 class="mb-0 fs-6">{{ $purchaseCount }}</h3>
                            <span class="text-muted">Pembelian</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection
