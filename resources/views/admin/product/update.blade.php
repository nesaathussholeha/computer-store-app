@extends('admin.layouts.app')
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
                <h4 class="card-title mb-0">Edit Produk</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('purchase.update', $purchase->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supplier<small class="text-danger">*</small></label>
                            <select class="select2 form-control select-edit @error('supplier_id') is-invalid @enderror"
                                name="supplier_id">
                                <option selected disabled>Pilih Supplier...</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('supplier_id', $purchase->supplier_id) == $supplier->id ? 'selected' : '' }}>
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
                                name="tgl_beli"
                                value="{{ old('tgl_beli', \Carbon\Carbon::parse($purchase->tgl_beli)->format('Y-m-d')) }}">


                            @error('tgl_beli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Produk<small class="text-danger">*</small></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori<small class="text-danger">*</small></label>
                            <select class="select2 form-control @error('category_id') is-invalid @enderror"
                                name="category_id">
                                <option selected disabled>Pilih Kategori...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Berat (Gram)<small class="text-danger">*</small></label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight"
                                value="{{ old('weight', $product->weight ?? '') }}" placeholder="Masukkan berat produk">

                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga<small class="text-danger">*</small></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                value="{{ old('price', $product->price ?? '') }}" placeholder="Masukkan harga produk">

                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok<small class="text-danger">*</small></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                value="{{ old('stock', $product->stock ?? '') }}" placeholder="Masukkan stok produk">

                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="1" placeholder="Masukkan deskripsi produk...">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Foto</label>
                            <input class="form-control" type="file" name="image" id="image-input">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label><br>
                            <img id="image-preview"
                                src="{{ !empty($product->image) ? asset('storage/' . $product->image) : 'https://via.placeholder.com/200' }}"
                                alt="Foto Produk" class="img-thumbnail" width="200" style="display: block;">
                        </div>



                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success px-4" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        window.onload = function() {
            document.getElementById('image-input').addEventListener('change', function(event) {
                let file = event.target.files[0]; // Ambil file yang dipilih
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let preview = document.getElementById('image-preview');
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Pastikan gambar tampil
                    };
                    reader.readAsDataURL(file); // Konversi file ke Data URL
                }
            });
        };
    </script>
@endsection
