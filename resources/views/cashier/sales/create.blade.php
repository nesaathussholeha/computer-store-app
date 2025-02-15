@extends('cashier.layouts.app')
@section('content')
    <form action="{{ route('sale.store') }}" method="POST">
        @csrf

        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">Data Produk</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Member</label>
                            <select name="member_id" class="select2 form-select">
                                <option value="">Bukan Member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->user->name }}</option>
                                @endforeach
                            </select>
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
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Jumlah<small class="text-danger">*</small></label>
                                        <input type="number" name="products[][quantity]"
                                            class="form-control quantity-input" min="1" value="1">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Harga</label>
                                        <input type="number" class="form-control price-input" name="products[][price]"
                                            placeholder="Masukkan harga produk" readonly>
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
                                placeholder="Total harga" readonly>

                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Uang yang dibayarkan<small class="text-danger">*</small></label>
                            <input type="number" class="form-control" name="amount_paid" id="amount-paid"
                                placeholder="Masukkan uang yang dibayarkan">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kembalian</label>
                            <input type="number" class="form-control" name="change_amount" id="change-amount"
                                placeholder="Kembalian" readonly>
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
            function updatePriceAndTotal() {
                let totalPrice = 0;
                let isMember = document.querySelector("select[name='member_id']").value !== "";

                document.querySelectorAll('.repeater-item').forEach(function(row) {
                    let productSelect = row.querySelector('.product-select');
                    let quantityInput = row.querySelector('.quantity-input');
                    let priceInput = row.querySelector('.price-input');

                    if (productSelect && quantityInput && priceInput) {
                        let selectedOption = productSelect.options[productSelect.selectedIndex];
                        let productPrice = selectedOption.dataset.price ? parseFloat(selectedOption.dataset
                            .price) : 0;
                        let quantity = parseInt(quantityInput.value) || 1;
                        let totalItemPrice = productPrice * quantity;

                        priceInput.value = totalItemPrice;
                        totalPrice += isNaN(totalItemPrice) ? 0 : totalItemPrice;
                    }
                });

                // Jika member dipilih, berikan diskon 10%
                if (isMember) {
                    totalPrice *= 0.9;
                }

                document.getElementById('total-price').value = totalPrice.toFixed(2);
                updateChangeAmount();
            }

            function updateChangeAmount() {
                let totalPrice = parseFloat(document.getElementById('total-price').value) || 0;
                let amountPaid = parseFloat(document.getElementById('amount-paid').value) || 0;
                let changeAmount = amountPaid - totalPrice;
                document.getElementById('change-amount').value = Math.max(changeAmount, 0).toFixed(2);
            }

            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('product-select') || event.target.classList.contains(
                        'quantity-input') || event.target.name === 'member_id') {
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
