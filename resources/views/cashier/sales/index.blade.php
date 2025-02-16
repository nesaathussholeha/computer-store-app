@extends('cashier.layouts.app')
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Penjualan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="{{ route('cashier.dashboard') }}">Beranda</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Penjualan</li>
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
            <a href="{{ route('sale.create') }}" type="button"
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
                    <th><h6 class="fs-4 fw-semibold mb-0">No</h6></th>
                    <th><h6 class="fs-4 fw-semibold mb-0">Nomor Transaksi</h6></th>
                    <th><h6 class="fs-4 fw-semibold mb-0">Nama Member</h6></th>
                    <th><h6 class="fs-4 fw-semibold mb-0">Total Harga</h6></th>
                    <th><h6 class="fs-4 fw-semibold mb-0">Jumlah Dibayar</h6></th>
                    <th><h6 class="fs-4 fw-semibold mb-0">Kembalian</h6></th>
                    <th><h6 class="fs-4 fw-semibold mb-0">Tanggal Transaksi</h6></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $index => $sale)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">#{{ $sale->id }}</h6>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">
                                {{ $sale->member ? $sale->member->user->name : '-' }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">Rp {{ number_format($sale->paid_amount, 0, ',', '.') }}</p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">Rp {{ number_format($sale->change_amount, 0, ',', '.') }}</p>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $sale->created_at->format('d M Y H:i') }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">
            <x-pagination :paginator="$sales" />
        </div>
    </div>

@endsection
