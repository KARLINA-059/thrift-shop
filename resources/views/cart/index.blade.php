@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Keranjang Belanja</h1>
    
    @if($carts->count() > 0)
    <div class="row">
        <div class="col-lg-8">
            @foreach($carts as $cart)
            <div class="card card-product mb-3 cart-item">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                        @php
                            $placeholders = [
                                'https://images.unsplash.com/photo-1540574163026-643ea20ade25?auto=format&fit=crop&w=500&q=80',
                                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=500&q=80',
                            ];
                            $img = $cart->product->image_url ?: $placeholders[$loop->index % count($placeholders)];
                        @endphp
                        <img src="{{ $img }}" class="product-thumb" alt="{{ $cart->product->name }}">
                    </div>
                    
                    <div class="col-md-4">
                        <h5 class="mb-1">{{ $cart->product->name }}</h5>
                        <p class="text-muted mb-1">{{ $cart->product->brand }}</p>
                        <p class="text-muted mb-0">Ukuran: {{ $cart->product->size }}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <form action="{{ route('cart.update', $cart) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PUT')
                                <button type="button" class="quantity-btn minus" onclick="updateQuantity({{ $cart->id }}, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control quantity-input mx-2" id="quantity-{{ $cart->id }}" 
                                       name="quantity" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->stock }}" 
                                       onchange="updateCart({{ $cart->id }})">
                                <button type="button" class="quantity-btn plus" onclick="updateQuantity({{ $cart->id }}, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <h5 class="fw-bold" style="color: var(--primary-color);">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</h5>
                        <p class="text-muted small">Rp {{ number_format($cart->product->price, 0, ',', '.') }}/item</p>
                    </div>
                    
                    <div class="col-md-1 text-end">
                        <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Ringkasan Belanja</h5>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span>Ongkos Kirim</span>
                        <span>Rp 15.000</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total</strong>
                        <strong style="color: var(--primary-color);">Rp {{ number_format($total + 15000, 0, ',', '.') }}</strong>
                    </div>
                    
                    <a href="{{ route('orders.checkout') }}" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-shopping-bag me-2"></i> Proses Checkout
                    </a>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('products.index') }}" style="color: var(--primary-color);">
                            <i class="fas fa-arrow-left me-1"></i> Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    @php
        $demoProducts = \App\Models\Product::inRandomOrder()->take(3)->get();
        $demoCarts = collect();
        foreach ($demoProducts as $p) {
            $qty = rand(1,3);
            $demoCarts->push((object)[
                'product' => $p,
                'quantity' => $qty,
                'subtotal' => $p->price * $qty,
            ]);
        }
        $demoTotal = $demoCarts->sum('subtotal');
    @endphp

    <div class="row">
        <div class="col-lg-8">
            <p class="text-muted mb-3">Keranjang kosong — contoh item untuk demo tampilan (tidak tersimpan).</p>
            @foreach($demoCarts as $cart)
            <div class="card card-product mb-3 cart-item">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            @php
                                $placeholders = [
                                    'https://images.unsplash.com/photo-1540574163026-643ea20ade25?auto=format&fit=crop&w=500&q=80',
                                    'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=500&q=80',
                                ];
                                $img = $cart->product->image_url ?: $placeholders[$loop->index % count($placeholders)];
                            @endphp
                            <img src="{{ $img }}" class="product-thumb" alt="{{ $cart->product->name }}">
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-1">{{ $cart->product->name }}</h5>
                            <p class="text-muted mb-1">{{ $cart->product->brand }}</p>
                            <p class="text-muted mb-0">Ukuran: {{ $cart->product->size }}</p>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="quantity-btn" style="pointer-events:none">-</div>
                                <input type="number" class="form-control quantity-input mx-2" value="{{ $cart->quantity }}" readonly>
                                <div class="quantity-btn" style="pointer-events:none">+</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <h5 class="fw-bold" style="color: var(--primary-color);">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</h5>
                            <p class="text-muted small">Rp {{ number_format($cart->product->price, 0, ',', '.') }}/item</p>
                        </div>

                        <div class="col-md-1 text-end">
                            <button class="btn btn-link text-muted" disabled>
                                <i class="fas fa-lock"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Ringkasan Belanja (Demo)</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($demoTotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Ongkos Kirim</span>
                        <span>Rp 15.000</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total</strong>
                        <strong style="color: var(--primary-color);">Rp {{ number_format($demoTotal + 15000, 0, ',', '.') }}</strong>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-shopping-bag me-2"></i> Lanjutkan Belanja
                    </a>
                    <div class="text-center mt-3">
                        <small class="text-muted">Catatan: Item ini hanya untuk demo dan tidak akan ditambahkan ke keranjang Anda.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
    function updateQuantity(cartId, change) {
        const input = document.getElementById(`quantity-${cartId}`);
        let value = parseInt(input.value);
        const newValue = value + change;
        
        if (newValue >= 1) {
            input.value = newValue;
            updateCart(cartId);
        }
    }
    
    function updateCart(cartId) {
        const input = document.getElementById(`quantity-${cartId}`);
        const quantity = input.value;
        
        fetch(`/cart/${cartId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection 