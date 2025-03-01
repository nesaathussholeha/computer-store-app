@extends('member.layouts.app')
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
                            <p>Selamat datang di akun member Anda! Nikmati promo eksklusif, akses mudah ke produk terbaru,
                                dan berbagai keuntungan lainnya hanya di Toko Komputer kami!</p>
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

    <h4 class="mb-3">Produk Terbaru Kami</h4>

    <div class="row">
        @foreach ($products->take(3) as $product)
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top img-fluid"
                        src="{{ asset($product->image ? 'storage/' . $product->image : 'assets/dist/images/empty/images-empty.png') }}"
                        alt="Card image cap" style="object-fit: cover; width: 100%; height: 200px;" />

                    <div class="card-body">
                        <div class="d-flex no-block align-items-center mb-3">
                            <span class="d-flex align-items-center">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>

                            <div class="ms-auto d-flex align-items-center">
                                <a href="javascript:void(0)" class="link text-muted d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-stack-back">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 8l8 4l8 -4l-8 -4z" />
                                        <path d="M12 16l-4 -2l-4 2l8 4l8 -4l-4 -2l-4 2z" fill="currentColor" />
                                        <path d="M8 10l-4 2l4 2m8 0l4 -2l-4 -2" />
                                    </svg>
                                    <span class="ms-2">{{ $product->stock }} pcs</span>
                                </a>
                            </div>
                        </div>
                        <h3 class="fs-6">
                            {{ $product->name }}
                        </h3>
                        <span class="mb-0 mt-2 text-muted">
                            {{ $product->category->name }}
                        </span>
                        <p class="mb-0 mt-2 text-muted">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($products->count() > 3)
        <div class="text-center mt-4">
            <a href="{{ route('member.index') }}" class="btn btn-outline-primary">Lihat Produk Lainnya</a>
        </div>
    @endif

@endsection
