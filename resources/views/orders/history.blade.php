@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Riwayat Pesanan</h1>
    
    @if($orders->count() > 0)
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Item Pesanan</th>
                            <th>Total Harga</th>
                            <th>Status Pengiriman</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->order_code }}</strong>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @foreach($order->items as $item)
                                <div>{{ $item->product->name }} ({{ $item->quantity }})</div>
                                @endforeach
                            </td>
                            <td class="fw-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusClass = 'status-pending';
                                    if($order->status == 'processing') $statusClass = 'status-processing';
                                    elseif($order->status == 'shipped') $statusClass = 'status-shipped';
                                    elseif($order->status == 'completed') $statusClass = 'status-completed';
                                @endphp
                                <span class="order-status {{ $statusClass }}">
                                    @if($order->status == 'pending')
                                        Menunggu
                                    @elseif($order->status == 'processing')
                                        Diproses
                                    @elseif($order->status == 'shipped')
                                        Dikirim
                                    @else
                                        Selesai
                                    @endif
                                </span>
                            </td>
                            <td>
                                @php
                                    $payment = $order->payment;
                                    if($payment) {
                                        $paymentClass = 'payment-' . $payment->status;
                                        $paymentText = $payment->status == 'verified' ? 'Paid' : ($payment->status == 'rejected' ? 'Rejected' : 'Pending');
                                        echo '<span class="payment-status ' . $paymentClass . '">' . $paymentText . '</span>';
                                    } else {
                                        echo '<span class="payment-status" style="background: var(--border); color: var(--text);">Not Paid</span>';
                                    }
                                @endphp
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-history display-1 text-muted mb-4"></i>
        <h3>Belum ada riwayat pesanan</h3>
        <p class="text-muted mb-4">Yuk, mulai belanja produk thrift impianmu!</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
        </a>
    </div>
    @endif
</div>
@endsection