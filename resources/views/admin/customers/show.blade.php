@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="mb-0" style="font-family: 'Playfair Display', serif; font-size:28px; color:var(--muted);">Detail Customer</h1>
            <p class="text-muted small mb-0">{{ $customer->name }}</p>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <style>
        .chart-card{ background: linear-gradient(180deg,#fffaf0,#f9f5ea); border-radius:12px; padding:18px; border:1px solid rgba(59,58,54,0.04); box-shadow:0 8px 20px rgba(59,58,54,0.03); }
    </style>

    <!-- Customer Info -->
    <div class="chart-card mb-4">
        <h3 class="mb-3">Informasi Customer</h3>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nama:</strong> {{ $customer->name }}</p>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $customer->address ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Jumlah Transaksi:</strong> {{ $customer->transactions->count() }}</p>
                <p><strong>Total Belanja:</strong> Rp {{ number_format($customer->transactions->sum('total'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="chart-card">
        <h3 class="mb-3">Transaksi Terbaru</h3>
        @if($customer->transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                            <td>
                                @if($transaction->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning">{{ $transaction->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Belum ada transaksi.</p>
        @endif
    </div>
</div>
@endsection