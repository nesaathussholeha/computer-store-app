@extends('leader.layouts.app')
@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Laporan Penjualan</h4>
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
            <form action="{{ route('report.sale') }}" method="GET" class="d-flex gap-2">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
        <div class="col-sm-auto d-flex align-items-center mt-0">
            <form action="{{ route('sales.download') }}" method="GET">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <button type="submit" class="btn btn-success d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="me-2" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                        <path d="M17 18h2" />
                        <path d="M20 15h-3v6" />
                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                    </svg>
                    Download PDF
                </button>
            </form>
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
                        <h6 class="fs-4 fw-semibold mb-0">Member</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Produk</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Harga</h6>
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Jumlah Dibeli</h6> <!-- Kolom Jumlah Dibeli -->
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Total</h6> <!-- Kolom Total -->
                    </th>
                    <th>
                        <h6 class="fs-4 fw-semibold mb-0">Tanggal Transaksi</h6> <!-- Kolom Tanggal Transaksi -->
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $index => $sale)
                    @php $rowspan = $sale->saleDetails->count(); @endphp
                    @if ($rowspan > 0)
                        @foreach ($sale->saleDetails as $key => $detail)
                            <tr>
                                @if ($key == 0)
                                    <td rowspan="{{ $rowspan }}">{{ $index + 1 }}</td>
                                    <td rowspan="{{ $rowspan }}">
                                        {{ $sale->member->user->name ?? 'No Name' }}
                                        <!-- Add a fallback in case 'user' is null -->
                                    </td>
                                @endif
                                <td>{{ $detail->product->name }}</td>
                                <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                @if ($key == 0)
                                    <td rowspan="{{ $rowspan }}">
                                        {{ \Carbon\Carbon::parse($sale->created_at)->format('d M Y H:i') }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sale->member->user->name ?? 'No Name' }}</td>
                            <td colspan="5" class="text-center">Tidak ada produk</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        {{-- <div class="d-flex justify-content-end mt-3">
            <x-pagination :paginator="$purchases" />
        </div> --}}
    </div>
@endsection
