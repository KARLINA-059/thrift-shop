@extends('layouts.app')

@section('content')
<div class="container px-4 py-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color: var(--muted);">
            <i class="fas fa-image me-2"></i>Test Product Images
        </h1>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Admin
        </a>
    </div>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>

                    @if($product->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; width: auto;">
                        </div>
                        <p class="text-muted small">Path: {{ $product->image }}</p>
                        <p class="text-success small">✅ Image loaded successfully</p>
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                             style="height: 200px;">
                            <i class="fas fa-image text-muted fa-3x"></i>
                        </div>
                        <p class="text-danger small">❌ No image found</p>
                    @endif

                    <p class="mb-1"><strong>Brand:</strong> {{ $product->brand ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Price:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="mb-0"><strong>Condition:</strong> {{ ucfirst($product->condition) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Debug Information</h6>
                </div>
                <div class="card-body">
                    <p><strong>Storage Link Status:</strong>
                        @if(file_exists(public_path('storage')))
                            <span class="text-success">✅ Active</span>
                        @else
                            <span class="text-danger">❌ Not found</span>
                        @endif
                    </p>
                    <p><strong>Products Folder:</strong>
                        @if(file_exists(public_path('storage/products')))
                            <span class="text-success">✅ Exists</span>
                        @else
                            <span class="text-danger">❌ Not found</span>
                        @endif
                    </p>
                    <p><strong>Total Products:</strong> {{ $products->count() }}</p>
                    <p><strong>Base URL:</strong> {{ url('/') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection