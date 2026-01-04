@extends('layouts.app')

@section('title', 'Status Pembayaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card payment-card">
                <div class="payment-card-header">
                    <h3 class="mb-0">Status Pembayaran</h3>
                </div>
                
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle display-1 text-success"></i>
                    </div>
                    
                    <h2 class="fw-bold mb-3">Pembayaran Berhasil!</h2>
                    <p class="text-muted mb-5">Terima kasih telah berbelanja di ThriftStyle. Pembayaran Anda telah berhasil diverifikasi.</p>
                    
                    <div class="card border-0 bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Rincian Pesanan</h5>
                            
                            <div class="row text-start">
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Order ID</p>
                                    <p class="fw-bold">{{ $order->order_code }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Tanggal Pemesanan</p>
                                    <p class="fw-bold">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Total Pembayaran</p>
                                    <p class="fw-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Status Pesanan</p>
                                    <span class="order-status status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                @if($order->payment)
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1 text-muted">Status Pembayaran</p>
                                    @php
                                        $paymentClass = 'payment-' . $order->payment->status;
                                        $paymentText = $order->payment->status == 'verified' ? 'Paid' : ($order->payment->status == 'rejected' ? 'Rejected' : 'Pending');
                                    @endphp
                                    <span class="payment-status {{ $paymentClass }}">
                                        {{ $paymentText }}
                                    </span>
                                </div>
                                @endif
                                
                                <div class="col-12">
                                    <p class="mb-1 text-muted">Alamat Pengiriman</p>
                                    <p class="fw-bold">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-3 col-md-8 mx-auto">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i> Kembali ke Beranda
                        </a>
                        
                        <a href="{{ route('orders.history') }}" class="btn btn-outline-primary">
                            <i class="fas fa-history me-2"></i> Lihat Pesanan
                        </a>
                    </div>
                    
                    <div class="mt-5">
                        <h5 class="mb-4">Riwayat Status</h5>
                        <div class="status-timeline">
                            <div class="status-item active">
                                <div class="status-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="status-content">
                                    <h6>Pesanan Dibuat</h6>
                                    <p class="text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            @if($order->payment)
                            <div class="status-item {{ in_array($order->status, ['processing', 'shipped', 'completed']) ? 'active' : '' }}">
                                <div class="status-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="status-content">
                                    <h6>Pembayaran {{ $order->payment->status == 'verified' ? 'Diverifikasi' : ($order->payment->status == 'pending' ? 'Menunggu Verifikasi' : 'Ditolak') }}</h6>
                                    <p class="text-muted small">{{ $order->payment->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            @endif

                            @if($order->status == 'processing' || $order->status == 'shipped' || $order->status == 'completed')
                            <div class="status-item {{ in_array($order->status, ['shipped', 'completed']) ? 'active' : '' }}">
                                <div class="status-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="status-content">
                                    <h6>Pesanan Diproses</h6>
                                    <p class="text-muted small">Pesanan sedang dipersiapkan</p>
                                </div>
                            </div>
                            @endif

                            @if($order->status == 'shipped' || $order->status == 'completed')
                            <div class="status-item {{ $order->status == 'completed' ? 'active' : '' }}">
                                <div class="status-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="status-content">
                                    <h6>Pesanan Dikirim</h6>
                                    <p class="text-muted small">Pesanan dalam perjalanan</p>
                                </div>
                            </div>
                            @endif

                            @if($order->status == 'completed')
                            <div class="status-item active">
                                <div class="status-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="status-content">
                                    <h6>Pesanan Selesai</h6>
                                    <p class="text-muted small">Terima kasih telah berbelanja!</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection