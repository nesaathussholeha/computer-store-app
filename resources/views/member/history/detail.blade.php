@extends('member.layouts.app')

@section('content')
    <div class="text-end mb-4">
        <a href="{{ route('member.transaction') }}" class="btn btn-primary">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l4 4" />
                    <path d="M5 12l4 -4" />
                </svg></span>
            Kembali</a>
    </div>

    <div class="card bg-light-info shadow-none position-relative overflow-hidden mb-4 border border-info">
        <div class="card-body px-4 py-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-semibold mb-0">Detail Transaksi</h4>
                <p class="mb-0"><strong>Tanggal:</strong> {{ $sale->created_at->format('d M Y') }}</p>
            </div>
            <p><strong>Total Harga:</strong> Rp {{ number_format($sale->total_price, 0, ',', '.') }}</p>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive rounded-2">
                <table class="table border text-nowrap customize-table mb-0 align-middle">
                    <thead class="text-dark fs-4 bg-light-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->saleDetails as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detail->product->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
