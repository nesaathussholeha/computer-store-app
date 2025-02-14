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
            {{-- <button type="button"
                class="btn btn-success add-btn d-flex align-items-center justify-content-center text-center w-100"
                data-bs-toggle="modal" id="create-btn" data-bs-target="#createProduct">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="me-1">
                    <path fill="currentColor"
                        d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                </svg>
                Tambah
            </button> --}}

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
        <table class="table border text-nowrap customize-table mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">No</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Kategori</h6>
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
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->iteration - 1 }}</td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">{{ $product->name }}</h6>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $product->category->name }}</p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $product->price }}</p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $product->stock }}</p>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning btn-edit" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock }}" data-weight="{{ $product->weight }}">Edit</button>

                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                data-id="{{ $product->id }}">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data Tidak Ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">
            <x-pagination :paginator="$products" />
        </div>
    </div>

    @include('admin.product.widgets.create')
    @include('admin.product.widgets.update')
    @include('components.delete-modal')
@endsection

{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#createProduct')
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-edit').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var stock = $(this).data('stock');
                var weight = $(this).data('weight');


                $('#nameEdit').val(name);
                $('#priceEdit').val(price);
                $('#stockEdit').val(stock);
                $('#weightEdit').val(weight);


                $('#updateProductForm').attr('action', `{{ route('supplier.update', '') }}/${id}`);

                $('#updateProduct').modal('show');
            });


            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                $('#formDelete').attr('action', `{{ route('supplier.destroy', '') }}/${id}`);
                $('#modalDelete').modal('show');
            });
        });
    </script>
@endsection --}}
