@extends('admin.layouts.app')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-9">
                <h4 class="fw-semibold mb-8">{{ $purchase->supplier->name }}</h4>
            </div>

            <div class="col-12 col-md-3 text-md-end text-center">
                <p class="mb-0"><strong>Tanggal Pembelian:</strong>
                    {{ \Carbon\Carbon::parse($purchase->tgl_beli)->locale('id')->isoFormat('D MMMM YYYY') }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><strong>Total:</strong> Rp {{ number_format($purchase->total, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-bold">Detail Produk:</h4>
        <div class="text-end ">
            <a href="{{ route('product.index') }}" class="btn btn-primary">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M5 12l4 4" />
                        <path d="M5 12l4 -4" />
                    </svg>
                </span>
                Kembali
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Jumlah Beli</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchase->purchaseDetails as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->product->description ?? 'Tidak ada deskripsi' }}</td>
                        <td>
                            @if ($detail->product->image)
                                <img src="{{ Storage::url($detail->product->image) }}" alt="Image"
                                    style="width: 80px; height: 80px; object-fit: cover; max-width: 100%;">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>{{ $detail->product->category->name ?? 'Tidak ada kategori' }}</td>
                        <td>{{ $detail->product->weight ?? 'Tidak ada berat' }} g</td>
                        <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                        <td>{{ $detail->product->stock }}</td>
                        <td>{{ $detail->jumlah_beli }}</td>
                        <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada produk dalam pembelian ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>



    </div>
@endsection
