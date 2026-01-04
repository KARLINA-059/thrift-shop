@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                    @php
                    $placeholders = [
                        'https://images.unsplash.com/photo-1540574163026-643ea20ade25?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=1200&q=80',
                    ];
                    $img = $product->image_url ?: $placeholders[$product->id % count($placeholders)];
                    @endphp
                <img src="{{ $img }}" alt="{{ $product->name }}" class="product-show-image">
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @php
                        $condClass = $product->condition == 'baru' ? 'badge-new' : ($product->condition == 'bekas bagus' ? 'badge-used' : 'badge-other');
                    @endphp
                    <span class="badge-condition {{ $condClass }} mb-3">{{ $product->condition }}</span>
                    
                    <h1 class="fw-bold mb-3">{{ $product->name }}</h1>
                    <h3 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Merk:</strong> {{ $product->brand }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Ukuran:</strong> {{ $product->size }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Kondisi:</strong> {{ $product->condition }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Stok:</strong> {{ $product->stock }} item</p>
                        </div>
                    </div>
                    
                    <h5 class="mb-3">Deskripsi Produk</h5>
                    <p class="text-muted mb-5">{{ $product->description }}</p>
                    
                    @if($product->stock > 0)
                    <form action="{{ route('cart.store', $product) }}" method="POST" class="row g-3 align-items-center">
                        @csrf
                        <div class="col-auto">
                            <label for="quantity" class="form-label">Jumlah:</label>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <button type="button" class="quantity-btn minus" onclick="decrementQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control quantity-input mx-2" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                                <button type="button" class="quantity-btn plus" onclick="incrementQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-cart me-2"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-4">
                        <a href="{{ route('orders.checkout') }}" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-bolt me-2"></i> Checkout Sekarang
                        </a>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i> Produk ini sedang habis
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function incrementQuantity() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (value < {{ $product->stock }}) {
            input.value = value + 1;
        }
    }
    
    function decrementQuantity() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        }
    }
</script>
@endsection
@endsection