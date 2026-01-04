@extends('layouts.app')

@section('title', 'Bukti Pembayaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card payment-card">
                <div class="payment-card-header">
                    <h3 class="mb-0">Upload Bukti Pembayaran</h3>
                    <p class="mb-0">Order ID: {{ $order->order_code }}</p>
                </div>
                
                <div class="card-body p-5">
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Silakan transfer sesuai total pembayaran dan upload bukti transfer di bawah ini.
                    </div>
                    
                    <form method="POST" action="{{ route('orders.process-payment', $order) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label form-label-custom">Order ID</label>
                                    <input type="text" class="form-control" value="{{ $order->order_code }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label form-label-custom">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_owner" class="form-label form-label-custom">Nama Pemilik Rekening</label>
                                    <input type="text" class="form-control @error('account_owner') is-invalid @enderror" 
                                           id="account_owner" name="account_owner" value="{{ old('account_owner') }}" required>
                                    @error('account_owner') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="form-label form-label-custom">Jumlah Transfer</label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" name="amount" value="{{ old('amount', $order->total_amount) }}" min="{{ $order->total_amount }}" required>
                                    @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <small class="text-muted">Minimal: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="bank" class="form-label form-label-custom">Bank Tujuan</label>
                            <select class="form-select @error('bank') is-invalid @enderror" id="bank" name="bank" required>
                                <option value="">Pilih Bank</option>
                                <option value="BCA" {{ old('bank') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                <option value="Mandiri" {{ old('bank') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                <option value="BNI" {{ old('bank') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                <option value="BRI" {{ old('bank') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                <option value="CIMB" {{ old('bank') == 'CIMB' ? 'selected' : '' }}>CIMB Niaga</option>
                                <option value="Permata" {{ old('bank') == 'Permata' ? 'selected' : '' }}>Permata</option>
                                <option value="OVO" {{ old('bank') == 'OVO' ? 'selected' : '' }}>OVO</option>
                                <option value="GoPay" {{ old('bank') == 'GoPay' ? 'selected' : '' }}>GoPay</option>
                                <option value="Dana" {{ old('bank') == 'Dana' ? 'selected' : '' }}>Dana</option>
                            </select>
                            @error('bank') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4 form-group">
                            <label for="proof_image" class="form-label form-label-custom">Bukti Transfer</label>
                            <input type="file" class="form-control @error('proof_image') is-invalid @enderror" 
                                   id="proof_image" name="proof_image" accept="image/*" required>
                            @error('proof_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted">Format: JPG, PNG, GIF (Maks. 2MB)</small>

                            <div id="image-preview" class="mt-3" style="display: none;">
                                <img id="preview" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-upload me-2"></i> Upload Bukti Pembayaran
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('orders.checkout') }}" class="text-primary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Checkout
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('proof_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endsection
@endsection