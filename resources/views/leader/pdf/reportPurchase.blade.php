<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Pembelian</h2>
    <p>Periode:
        {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '-' }}
        -
        {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '-' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Supplier</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Tanggal Dibeli</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchases as $index => $purchase)
                @foreach ($purchase->purchaseDetails as $key => $detail)
                    <tr>
                        @if ($key == 0)
                            <td rowspan="{{ $purchase->purchaseDetails->count() }}">{{ $index + 1 }}</td>
                            <td rowspan="{{ $purchase->purchaseDetails->count() }}">{{ $purchase->supplier->name }}</td>
                        @endif
                        <td>{{ $detail->product->name }}</td>
                        <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah_beli }}</td>
                        <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                        @if ($key == 0)
                            <td rowspan="{{ $purchase->purchaseDetails->count() }}">
                                {{ \Carbon\Carbon::parse($purchase->tgl_beli)->format('d-m-Y') }}
                            </td>
                        @endif
                    </tr>
                @endforeach
                <!-- Baris subtotal untuk setiap transaksi -->
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold;">Subtotal:</td>
                    <td colspan="2" style="font-weight: bold;">Rp
                        {{ number_format($purchase->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right; font-weight: bold;">Total Keseluruhan:</td>
                <td colspan="2" style="font-weight: bold;">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
