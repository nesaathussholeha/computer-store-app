@extends('member.layouts.app')

@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Riwayan Pembelian</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="{{ route('member.dashboard') }}">Beranda</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Riwayat Pembelian</li>
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

    <!-- Filter Tanggal -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('member.transaction') }}" method="GET">
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="start_date" class="form-label">Dari Tanggal</label>
                        <input type="date" id="start_date" name="start_date" class="form-control"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="end_date" class="form-label">Hingga Tanggal</label>
                        <input type="date" id="end_date" name="end_date" class="form-control"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse ($sales as $date => $transactions)
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">
                        {{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded-2 mb-4">
                        <table class="table border text-nowrap customize-table mb-0 align-middle">
                            <thead class="text-dark fs-4 bg-light-primary">
                                <tr>
                                    <th class="text-dark fs-4 bg-light-primary">
                                        <h6 class="fs-4 fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="text-dark fs-4 bg-light-primary">
                                        <h6 class="fs-4 fw-semibold mb-0">Total Harga</h6>
                                    </th>
                                    <th class="text-dark fs-4 bg-light-primary">
                                        <h6 class="fs-4 fw-semibold mb-0">Dibayar</h6>
                                    </th>
                                    <th class="text-dark fs-4 bg-light-primary">
                                        <h6 class="fs-4 fw-semibold mb-0">Kembalian</h6>
                                    </th>
                                    <th class="text-dark fs-4 bg-light-primary">
                                        <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($transactions as $index => $sale)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <h6 class="fs-4 fw-semibold mb-0">Rp
                                                {{ number_format($sale->total_price, 0, ',', '.') }}</h6>
                                        </td>
                                        <td>
                                            <p class="mb-0 fw-normal fs-4">Rp
                                                {{ number_format($sale->paid_amount, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 fw-normal fs-4">Rp
                                                {{ number_format($sale->change_amount, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('sale.show', ['id' => $sale->id]) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data Tidak Ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>Data Tidak Ditemukan untuk tanggal yang dipilih.</p>
        </div>
    @endforelse

    </div>

@endsection
