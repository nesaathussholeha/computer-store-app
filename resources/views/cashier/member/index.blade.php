@extends('cashier.layouts.app')
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Member</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="{{ route('cashier.dashboard') }}">Beranda</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Member</li>
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
            <form action="{{ route('member.index') }}" method="GET" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari member..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>


        <div class="col-sm-auto d-flex align-items-center mt-0">
            <button type="button"
                class="btn btn-success add-btn d-flex align-items-center justify-content-center text-center w-100"
                data-bs-toggle="modal" id="create-btn" data-bs-target="#addMemberModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="me-1">
                    <path fill="currentColor"
                        d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                </svg>
                Tambah
            </button>
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
                        <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Telepon</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Alamat</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">{{ $member->user->name }}</h6>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $member->user->email }}</p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $member->telp }}</p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $member->address }}</p>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning btn-edit" data-id="{{ $member->id }}"
                                data-name="{{ $member->user->name }}" data-email="{{ $member->user->email }}"
                                data-address="{{ $member->address }}" data-telp="{{ $member->telp }}">
                                Edit
                            </button>


                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                data-id="{{ $member->id }}">Hapus</button>
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
            <x-pagination :paginator="$members" />
        </div>
    </div>



    @include('cashier.member.widgets.create')
    @include('cashier.member.widgets.update')
    @include('components.delete-modal')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-edit').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var address = $(this).data('address');
                var telp = $(this).data('telp');

                // Set nilai input pada modal edit
                $('#nameEdit').val(name);
                $('#emailEdit').val(email);
                $('#addressEdit').val(address);
                $('#telpEdit').val(telp);

                // Set action form untuk update data
                $('#editMemberForm').attr('action', `{{ route('member.update', '') }}/${id}`);

                // Tampilkan modal edit
                $('#editMemberModal').modal('show');
            });

            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                $('#formDelete').attr('action', `{{ route('category.destroy', '') }}/${id}`);
                $('#modalDelete').modal('show');
            });

            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                var actionUrl = "{{ route('member.destroy', ':id') }}".replace(':id', id);

                $('#formDelete').attr('action', actionUrl);
                $('#modalDelete').modal('show');
            });
        });
    </script>
@endsection
