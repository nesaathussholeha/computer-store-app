@extends('member.layouts.app')
@section('content')
    <h4>Detail Transaksi</h4>
    <p><strong>Tanggal:</strong> {{ $sale->created_at->format('d M Y') }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($sale->total_price, 0, ',', '.') }}</p>

    <table class="table">
        <thead>
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
@endsection
