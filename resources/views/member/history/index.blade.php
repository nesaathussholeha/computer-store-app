@extends('member.layouts.app')
@section('content')
    <h3>Riwayat Pembelian</h3>
   @foreach ($sales as $date => $transactions)
    <h5 class="mt-3">{{ $date }}</h5> <!-- Menampilkan tanggal transaksi -->

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Total Harga</th>
                <th>Dibayar</th>
                <th>Kembalian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $sale)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($sale->paid_amount, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($sale->change_amount, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('sale.show', ['id' => $sale->id]) }}" class="btn btn-info">Detail</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

@endsection
