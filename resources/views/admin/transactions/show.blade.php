@extends('layouts.app')

@section('content')
<div class="container px-4 py-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color: var(--muted);">
            <i class="fas fa-receipt me-2"></i>Transaction #{{ $transaction->id }}
        </h1>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Transactions
        </a>
    </div>

    <!-- Transaction Info Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">
                        <i class="fas fa-user me-2"></i>Customer Information
                    </h5>
                    <div class="row">
                        <div class="col-sm-4"><strong>Name:</strong></div>
                        <div class="col-sm-8">{{ $transaction->customer?->name ?? 'N/A' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Email:</strong></div>
                        <div class="col-sm-8">{{ $transaction->customer?->email ?? 'N/A' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Phone:</strong></div>
                        <div class="col-sm-8">{{ $transaction->customer?->phone ?? 'N/A' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Address:</strong></div>
                        <div class="col-sm-8">{{ $transaction->customer?->address ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success mb-3">
                        <i class="fas fa-info-circle me-2"></i>Transaction Details
                    </h5>
                    <div class="row">
                        <div class="col-sm-4"><strong>Transaction ID:</strong></div>
                        <div class="col-sm-8"><code>{{ $transaction->id }}</code></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Status:</strong></div>
                        <div class="col-sm-8">
                            <span class="badge bg-success">{{ ucfirst($transaction->status) }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Total Amount:</strong></div>
                        <div class="col-sm-8">
                            <span class="h5 text-success fw-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Transaction Date:</strong></div>
                        <div class="col-sm-8">
                            {{ $transaction->transaction_date ? $transaction->transaction_date->format('d F Y, H:i:s') : $transaction->created_at->format('d F Y, H:i:s') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Created At:</strong></div>
                        <div class="col-sm-8">{{ $transaction->created_at->format('d F Y, H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Details -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0 text-primary">
                <i class="fas fa-shopping-bag me-2"></i>Products Purchased ({{ $transaction->transactionDetails->count() }} items)
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Size</th>
                            <th>Condition</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->transactionDetails as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $detail->product?->name ?? 'Product Deleted' }}</strong>
                            </td>
                            <td>{{ $detail->product?->brand ?? 'N/A' }}</td>
                            <td>{{ $detail->product?->size ?? 'N/A' }}</td>
                            <td>
                                @if($detail->product)
                                    <span class="badge
                                        @if($detail->product->condition == 'baru') bg-success
                                        @elseif($detail->product->condition == 'bekas bagus') bg-warning text-dark
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($detail->product->condition) }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $detail->quantity }}</span>
                            </td>
                            <td class="text-end">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="7" class="text-end fw-bold">Total:</td>
                            <td class="text-end fw-bold text-success h5">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">Transaction Summary</h6>
                    <p class="mb-0">
                        <strong>Transaction #{{ $transaction->id }}</strong> -
                        Customer: {{ $transaction->customer?->name ?? 'N/A' }} -
                        Total: <span class="text-success fw-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span> -
                        Date: {{ $transaction->transaction_date ? $transaction->transaction_date->format('d F Y') : $transaction->created_at->format('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
