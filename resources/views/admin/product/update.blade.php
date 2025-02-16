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
                <h4 class="card-title mb-0">Edit Data Pembelian</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('purchase.update', $purchase->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier<small class="text-danger">*</small></label>
                            <select class="select2 form-control @error('supplier_id') is-invalid @enderror"
                                name="supplier_id">
                                <option selected disabled>Pilih Supplier...</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control @error('tgl_beli') is-invalid @enderror"
                                name="tgl_beli" value="{{ old('tgl_beli', $purchase->tgl_beli) }}">
                            @error('tgl_beli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <h5>Data Produk</h5>
                    @foreach ($purchase->purchaseDetails as $detail)
                        <input type="hidden" name="details[{{ $loop->index }}][id]" value="{{ $detail->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Produk<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="details[{{ $loop->index }}][name]"
                                    value="{{ old('details.' . $loop->index . '.name', $detail->product->name) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori<small class="text-danger">*</small></label>
                                <select class="select2 form-control" name="details[{{ $loop->index }}][category_id]">
                                    <option selected disabled>Pilih Kategori...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $detail->product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat (Gram)<small class="text-danger">*</small></label>
                                <input type="number" class="form-control" name="details[{{ $loop->index }}][weight]"
                                    value="{{ old('details.' . $loop->index . '.weight', $detail->product->weight) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga<small class="text-danger">*</small></label>
                                <input type="number" class="form-control" name="details[{{ $loop->index }}][price]"
                                    value="{{ old('details.' . $loop->index . '.price', $detail->product->price) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok<small class="text-danger">*</small></label>
                                <input type="number" class="form-control" name="details[{{ $loop->index }}][stock]"
                                    value="{{ old('details.' . $loop->index . '.stock', $detail->product->stock) }}">
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($purchase->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $purchase->image) }}" alt="Gambar Produk"
                                            width="150">
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="details[{{ $loop->index }}][description]" rows="3">
                                    {{ old('details.' . $loop->index . '.description', $detail->product->description) }}
                                </textarea>
                            </div>

                        </div>
                        <hr>
                    @endforeach

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success px-4" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });
        });
    </script>
@endsection
