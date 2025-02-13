<div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createProductForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="name" class="form-label">Nama Produk<small class="text-danger fs-1">*</small></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Masukkan nama produk" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div>
                                <label for="category_id" class="form-label">Kategori<small class="text-danger fs-1">*</small></label>
                                <select class="select2 select2-create @error('category_id') is-invalid @enderror"
                                    name="category_id">
                                    <option selected disabled>Pilih Kategori...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div>
                                <label for="weight" class="form-label">Berat <small class="text-danger fs-1">* Satuan Gram</small></label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                    name="weight" placeholder="Masukkan berat produk" value="{{ old('weight') }}">
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div>
                                <label for="price" class="form-label">Harga<small class="text-danger fs-1">*</small></label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" placeholder="Masukkan harga produk" value="{{ old('price') }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div>
                                <label for="stock" class="form-label">Stok<small class="text-danger fs-1">*</small></label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                    name="stock" placeholder="Masukkan stok produk" value="{{ old('stock') }}">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div>
                                <label for="image" class="form-label">Foto</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-12">
                            <div>
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    name="description" rows="3" placeholder="Masukkan deskripsi produk...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div><!--end row-->
                </form>
            </div>

            <!-- Footer dengan tombol Simpan dan Tutup -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="createProductForm">Simpan</button>
            </div>
        </div>
    </div>
</div>
