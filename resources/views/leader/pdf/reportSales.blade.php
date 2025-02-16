<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
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
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    <p>Periode:
        {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '-' }}
        -
        {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '-' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Member</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Tanggal Dibeli</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $index => $sale)
                @foreach ($sales as $sale)
                    @foreach ($sale->saleDetails as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->member->user->name ?? 'No Name' }}</td>
                            <td>{{ $detail->product->name }}</td>
                            <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                @endforeach

                <!-- Baris subtotal untuk setiap transaksi -->
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold;">Subtotal:</td>
                    <td colspan="2" style="font-weight: bold;">Rp
                        {{ number_format($sale->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right; font-weight: bold;">Total Pendapatan:</td>
                <td colspan="2" style="font-weight: bold;">Rp {{ number_format($total_revenue, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
