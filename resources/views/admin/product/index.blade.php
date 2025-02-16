@extends('admin.layouts.app')
@section('style')
    <style>
        .category-selector .dropdown-menu {
            position: absolute;
            z-index: 1050;
            transform: translate3d(0, 0, 0);
        }

        .select2 {
            width: 100% !important;
        }

        .select2-selection__rendered {
            width: 100%;
            height: 36px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .select2-selection {
            height: fit-content !important;
            color: #555 !important;
            background-color: #fff !important;
            background-image: none !important;
            border: 1px solid #ccc !important;
            border-radius: 4px !important;
        }
    </style>
@endsection
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Produk</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="{{ route('admin.dashboard') }}">Beranda</a>
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
        <div class="col-sm-auto mb-0">
            <form action="{{ route('product.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari produk..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>


        <div class="col-sm-auto d-flex align-items-center mt-0">
            <a href="{{ route('product.create') }}" type="button"
                class="btn btn-success add-btn d-flex align-items-center justify-content-center text-center w-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="me-1">
                    <path fill="currentColor"
                        d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                </svg>
                Tambah
            </a>

        </div>

    </div>


    <div class="table-responsive rounded-2 mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">No</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Supplier</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Produk</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Harga</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Stok</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $index => $purchase)
                    @php $rowspan = $purchase->products->count(); @endphp
                    @if ($rowspan > 0)
                        @foreach ($purchase->products as $key => $product)
                            <tr>
                                @if ($key == 0)
                                    <td rowspan="{{ $rowspan }}">{{ $index + 1 }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $purchase->supplier->name }}</td>
                                @endif
                                <td>{{ $product->name }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                @if ($key == 0)
                                    <td rowspan="{{ $rowspan }}">
                                        <a href="{{ route('purchase.show', $purchase->id) }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('purchase.edit', $purchase->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('purchase.destroy', $purchase->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $purchase->supplier->name }}</td>
                            <td colspan="2" class="text-center">Tidak ada produk</td>
                            <td>
                                <a href="{{ route('purchase.show', $purchase->id) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('purchase.edit', $purchase->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('purchase.destroy', $purchase->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pembelian</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <div class="d-flex justify-content-end mt-3">
            <x-pagination :paginator="$purchases" />
        </div>
    </div>

    @include('components.delete-modal')
@endsection
