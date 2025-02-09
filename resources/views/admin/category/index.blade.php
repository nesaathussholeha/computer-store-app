@extends('admin.layouts.app')
@section('subcontent')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Kategori</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Kategori</a></li>
                    <li class="breadcrumb-item active">Barang</li>
                </ol>
            </div>

        </div>
    </div>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Daftar Kategori</h4>
            </div>
            <div class="card-body">
                <div class="row g-4 mb-3 d-flex justify-content-between align-items-center">
                    <!-- Form Pencarian Kategori di Kiri -->
                    <div class="col-sm-auto">
                        <form action="{{ route('category.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari kategori..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>

                    <!-- Tombol Tambah di Kanan -->
                    <div class="col-sm-auto">
                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                            data-bs-target="#createCategory"><i class="ri-add-line align-bottom me-1"></i> Tambah</button>
                    </div>
                </div>

                <div class="table-responsive table-card mt-2 mb-3 ">
                    <table class="table table-nowrap table-striped-columns mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="fw-semibold">{{ $categories->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning btn-edit"
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}">Edit</button>

                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $category->id }}">Hapus</button>

                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <x-pagination :paginator="$categories" />
                </div>
            </div>
        </div>
        <!-- end col -->

        @include('admin.category.widgets.create')
        @include('admin.category.widgets.update')
        @include('components.delete-modal')
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-edit').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#nameEdit').val(name);

                $('#formEdit').attr('action', `{{ route('category.update', '') }}/${id}`);

                $('#updateCategory').modal('show');
            });

            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                $('#formDelete').attr('action', `{{ route('category.destroy', '') }}/${id}`);
                $('#modalDelete').modal('show');
            });
        });
    </script>
@endsection
