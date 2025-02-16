@extends('member.layouts.app')
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Produk</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="{{ route('member.dashboard') }}">Beranda</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Produk</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/dist/images/breadcrumb/ChatBc.png') }}" alt=""
                            class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-3 d-flex justify-content-between align-items-center">
        <div class="col-sm-auto">
            <!-- Form Pencarian -->
            <form action="{{ route('product.member.show') }}" method="GET" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse ($products as $product)
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
        @empty
            <div class="col-12">
                <p class="text-center text-muted">Tidak ada produk yang tersedia.</p>
            </div>
        @endforelse
    </div>


    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endsection
