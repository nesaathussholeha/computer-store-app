@extends('admin.layouts.app')

@section('style')
    <style>
        body,
        html {
            overflow-x: hidden;
            width: 100%;
        }

        .card-body {
            overflow-x: auto;
        }

        .select2-container--default .select2-selection--single {
            width: 100% !important;
            height: calc(2.25rem + 2px);
            padding-top: 0.375rem;
            padding-bottom: 0.375rem;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Data Produk</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier<small class="text-danger">*</small></label>
                            <select class="select2 form-control @error('supplier_id') is-invalid @enderror"
                                name="supplier_id">
                                <option selected disabled>Pilih Supplier...</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control @error('tgl_beli') is-invalid @enderror"
                                name="tgl_beli" value="{{ old('tgl_beli', now()->format('Y-m-d')) }}">
                            @error('tgl_beli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="email-repeater mb-3">
                        <div data-repeater-list="products">
                            <div data-repeater-item class="row mb-3 repeater-item">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Produk<small class="text-danger">*</small></label>
                                    <input type="text"
                                        class="form-control @error('products.*.name') is-invalid @enderror" name="[name]"
                                        value="{{ old('products.0.name') }}" placeholder="Masukkan nama produk">

                                    @error('products.0.name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kategori<small class="text-danger">*</small></label>
                                    <select class="select2 form-control category-select" name="[category_id]">
                                        <option selected disabled>Pilih Kategori...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>


                                    @error('products.0.category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Berat (Gram)<small class="text-danger">*</small></label>
                                    <input type="number"
                                        class="form-control @error('products.0.weight') is-invalid @enderror"
                                        name="[weight]" placeholder="Masukkan berat produk"
                                        value="{{ old('products.0.weight') }}">
                                    @error('products.0.weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga<small class="text-danger">*</small></label>
                                    <input type="number"
                                        class="form-control @error('products.0.price') is-invalid @enderror" name="[price]"
                                        placeholder="Masukkan harga produk" value="{{ old('products.0.price') }}">
                                    @error('products.0.price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stok<small class="text-danger">*</small></label>
                                    <input type="number"
                                        class="form-control @error('products.0.stock') is-invalid @enderror" name="[stock]"
                                        placeholder="Masukkan stok produk" value="{{ old('products.0.stock') }}">
                                    @error('products.0.stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="[description]" rows="1" placeholder="Masukkan deskripsi produk...">{{ old('products.0.description') }}</textarea>
                                </div>
                                <div class="col-md-11 d-flex align-items-center">
                                    <div class="w-100">
                                        <label class="form-label">Foto</label>
                                        <input class="form-control" type="file" name="[image]">
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button data-repeater-delete class="btn btn-danger" type="button">
                                        <i class="ti ti-circle-x fs-5"></i>
                                    </button>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-repeater-create class="btn btn-info">
                            Tambah Barang <i class="ti ti-circle-plus ms-1 fs-5"></i>
                        </button>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success px-4" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada elemen yang sudah ada
            $('.select2').select2({
                width: '100%'
            });

            // Reinitialize Select2 setelah elemen baru ditambahkan
            $('body').on('click', '[data-repeater-create]', function() {
                setTimeout(function() {
                    $('.email-repeater .category-select').each(function() {
                        if (!$(this).hasClass("select2-hidden-accessible")) {
                            $(this).select2({
                                width: '100%'
                            });
                        }
                    });
                }, 100);
            });
        });
    </script>
@endsection
