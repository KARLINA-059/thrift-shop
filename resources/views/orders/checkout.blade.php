@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Checkout</h1>
    
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Alamat Pengiriman</h5>

                        <div class="mb-3 form-group">
                            <label for="shipping_address" class="form-label form-label-custom">Alamat Lengkap</label>
                            <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required>{{ auth()->user()->address }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label form-label-custom">Nama Penerima</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label form-label-custom">No. HP</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Metode Pembayaran</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" id="transfer_bank" value="transfer_bank" checked>
                                    <label class="form-check-label" for="transfer_bank">
                                        <i class="fas fa-university me-2"></i> Transfer Bank
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" id="e_wallet" value="e_wallet">
                                    <label class="form-check-label" for="e_wallet">
                                        <i class="fas fa-wallet me-2"></i> E-Wallet
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="bank-info" class="mt-3">
                            <p class="text-muted small">
                                <i class="fas fa-info-circle me-2"></i>
                                Transfer ke rekening BCA 1234567890 a.n. ThriftStyle
                            </p>
                        </div>

                        <div id="ewallet-info" class="mt-3" style="display: none;">
                            <p class="text-muted small">
                                <i class="fas fa-info-circle me-2"></i>
                                Pembayaran via OVO, GoPay, Dana, atau LinkAja
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Detail Pesanan</h5>
                        
                        @foreach($carts as $cart)
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <p class="mb-0">{{ $cart->product->name }}</p>
                                <small class="text-muted">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</small>
                            </div>
                            <span>Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkos Kirim</span>
                            <span>Rp 15.000</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total Pembayaran</strong>
                            <strong style="color: var(--primary-color);">Rp {{ number_format($total + 15000, 0, ',', '.') }}</strong>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-check-circle me-2"></i> Buat Pesanan
                        </button>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('cart.index') }}" style="color: var(--primary-color);">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const transferBank = document.getElementById('transfer_bank');
        const eWallet = document.getElementById('e_wallet');
        const bankInfo = document.getElementById('bank-info');
        const ewalletInfo = document.getElementById('ewallet-info');
        
        function togglePaymentInfo() {
            if (transferBank.checked) {
                bankInfo.style.display = 'block';
                ewalletInfo.style.display = 'none';
            } else {
                bankInfo.style.display = 'none';
                ewalletInfo.style.display = 'block';
            }
        }
        
        transferBank.addEventListener('change', togglePaymentInfo);
        eWallet.addEventListener('change', togglePaymentInfo);
        
        togglePaymentInfo();
    });
</script>
@endsection
@endsection