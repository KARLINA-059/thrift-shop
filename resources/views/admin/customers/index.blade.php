@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="mb-0" style="font-family: 'Playfair Display', serif; font-size:28px; color:var(--muted);">Customer Management</h1>
            <p class="text-muted small mb-0">Kelola data pelanggan</p>
        </div>
    </div>

    <style>
        .admin-stats{ display:flex; gap:18px; flex-wrap:wrap; margin-bottom:22px; }
        .stat-card{ flex:1 1 280px; background: linear-gradient(180deg, var(--card), #fbf7ee); border-radius:12px; padding:18px; border:1px solid rgba(59,58,54,0.04); box-shadow:0 8px 20px rgba(59,58,54,0.03); }
        .stat-label{ font-family: 'Playfair Display', serif; color:var(--muted); font-size:14px; margin-bottom:6px; }
        .stat-value{ font-size:28px; font-weight:700; color:var(--text); }
        .stat-sub{ color:rgba(59,58,54,0.6); font-size:13px; }

        .chart-card{ background: linear-gradient(180deg,#fffaf0,#f9f5ea); border-radius:12px; padding:18px; border:1px solid rgba(59,58,54,0.04); box-shadow:0 8px 20px rgba(59,58,54,0.03); }
        .chart-title{ font-family:'Playfair Display', serif; color:var(--muted); margin-bottom:10px; }

        @media(max-width:767px){ .chart-container{ height:260px; } .stat-value{ font-size:22px; } }
    </style>

    <!-- Search and Sort -->
    <div class="chart-card mb-4">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <label for="search" class="form-label">Search</label>
                <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nama atau Email">
            </div>
            <div class="col-md-4">
                <label for="sort" class="form-label">Sort By</label>
                <select class="form-select" id="sort" name="sort">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama</option>
                    <option value="transactions_count" {{ request('sort') == 'transactions_count' ? 'selected' : '' }}>Jumlah Transaksi</option>
                    <option value="transactions_sum_total" {{ request('sort') == 'transactions_sum_total' ? 'selected' : '' }}>Total Belanja</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    <!-- Customer List -->
    <div class="chart-card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Belanja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->transactions_count }}</td>
                        <td>Rp {{ number_format($customer->transactions_sum_total ?? 0, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data customer.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        {{ $customers->appends(request()->query())->links() }}
    </div>
</div>
@endsection