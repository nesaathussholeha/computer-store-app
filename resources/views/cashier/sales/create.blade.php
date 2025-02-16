@extends('cashier.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-bold">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</h4>
        <div class="text-end">
            <h4>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('HH:mm') }}</h4>
        </div>
    </div>



    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('sale.store') }}" method="POST">
        @csrf

        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">Data Produk</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <label class="form-label">Member<small class="text-danger">*</small></label>
                            <select name="member_id" class="select2 form-select @error('member_id') is-invalid @enderror">
                                <option value="">Bukan Member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}"
                                        {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="email-repeater mb-3">
                        <div data-repeater-list="products">
                            <div data-repeater-item class="row mb-3 repeater-item">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Produk<small class="text-danger">*</small></label>
                                        <select name="products[][product_id]" class="select2 form-select product-select">
                                            <option selected>Pilih Produk...</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                    {{ old('products.*.product_id') == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('products.*.product_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Jumlah<small class="text-danger">*</small></label>
                                        <input type="number" name="products[][quantity]"
                                            class="form-control quantity-input" min="1"
                                            value="{{ old('products.*.quantity', 1) }}">
                                        @error('products.*.quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Harga</label>
                                        <input type="number" class="form-control price-input" placeholder="Harga"
                                            name="products[][price]" disabled>
                                    </div>

                                    <div class="col-md-1 d-flex align-items-end">
                                        <button data-repeater-delete class="btn btn-danger mt-4" type="button">
                                            <i class="ti ti-circle-x fs-5"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-repeater-create class="btn btn-info">
                            Tambah Barang <i class="ti ti-circle-plus ms-1 fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">Total Pembelian</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Total</label>
                            <input type="number" class="form-control" name="total_price" id="total-price"
                                placeholder="Total harga" disabled>

                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Uang yang dibayarkan<small class="text-danger">*</small></label>
                            <input type="number" class="form-control" name="amount_paid" id="amount-paid"
                                placeholder="Masukkan uang yang dibayarkan" value="{{ old('amount_paid') }}">
                            @error('amount_paid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kembalian</label>
                            <input type="number" class="form-control" name="change_amount" id="change-amount"
                                placeholder="Kembalian" disabled>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success px-4" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function formatNumber(number) {
                // Format angka sesuai dengan format Indonesia
                return new Intl.NumberFormat('id-ID').format(number);
            }

            function updatePriceAndTotal() {
                let totalPrice = 0;
                let isMember = document.querySelector("select[name='member_id']").value !== "";

                document.querySelectorAll('.repeater-item').forEach(function(row) {
                    let productSelect = row.querySelector('.product-select');
                    let quantityInput = row.querySelector('.quantity-input');
                    let priceInput = row.querySelector('.price-input');

                    if (productSelect && quantityInput && priceInput) {
                        let selectedOption = productSelect.options[productSelect.selectedIndex];
                        let productPrice = selectedOption.dataset.price ? parseFloat(selectedOption.dataset.price) : 0;
                        let quantity = parseInt(quantityInput.value) || 1;
                        let totalItemPrice = productPrice * quantity;

                        priceInput.value = formatNumber(totalItemPrice.toFixed(0)); // Membulatkan harga produk dan format
                        totalPrice += isNaN(totalItemPrice) ? 0 : totalItemPrice;
                    }
                });

                // Jika member dipilih, berikan diskon 10%
                if (isMember) {
                    totalPrice *= 0.9;
                }

                document.getElementById('total-price').value = formatNumber(totalPrice.toFixed(0)); // Membulatkan total harga dan format
                updateChangeAmount();
            }

            function updateChangeAmount() {
                let totalPrice = parseFloat(document.getElementById('total-price').value.replace(/\./g, '')) || 0;
                let amountPaid = parseFloat(document.getElementById('amount-paid').value.replace(/\./g, '')) || 0;
                let changeAmount = amountPaid - totalPrice;
                document.getElementById('change-amount').value = formatNumber(Math.max(changeAmount, 0).toFixed(0)); // Format kembalian
            }

            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('product-select') || event.target.classList.contains('quantity-input') || event.target.name === 'member_id') {
                    updatePriceAndTotal();
                } else if (event.target.id === 'amount-paid') {
                    updateChangeAmount();
                }
            });

            document.addEventListener('keyup', function(event) {
                if (event.target.id === 'amount-paid') {
                    updateChangeAmount();
                }
            });

            document.querySelector("[data-repeater-create]").addEventListener("click", function() {
                setTimeout(updatePriceAndTotal, 100);
            });

            document.addEventListener("click", function(event) {
                if (event.target.closest("[data-repeater-delete]")) {
                    setTimeout(updatePriceAndTotal, 100);
                }
            });
        });
    </script>

@endsection
