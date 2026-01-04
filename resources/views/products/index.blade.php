@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="container py-5">
    <!-- Search Bar -->
    <div class="row mb-5">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('products.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" name="search" placeholder="Cari produk thrift..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="price_min" class="form-label">Harga Min</label>
                            <input type="number" class="form-control" id="price_min" name="price_min" value="{{ request('price_min') }}" placeholder="0">
                        </div>
                        <div class="col-md-3">
                            <label for="price_max" class="form-label">Harga Max</label>
                            <input type="number" class="form-control" id="price_max" name="price_max" value="{{ request('price_max') }}" placeholder="1000000">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Products -->
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Produk Thrift</h2>
            <p class="text-muted">Temukan pakaian thrift impianmu di sini</p>
        </div>
    </div>
    
    <div class="row">
        @if($products->count() > 0)
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                        <div class="position-relative">
                            @php
                                $placeholders = [
                                    'https://images.unsplash.com/photo-1540574163026-643ea20ade25?auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1543779506-9e4f0b0b8b7b?auto=format&fit=crop&w=800&q=80',
                                ];
                                $img = $product->image_url ?: $placeholders[$loop->index % count($placeholders)];
                            @endphp
                            <img src="{{ $img }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            <span class="badge badge-condition">
                                {{ $product->condition }}
                            </span>
                        </div>
                        <div class="card-body" style="min-height: 120px;">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $product->brand }}</h6>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text fw-bold" style="color: var(--primary-color);">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                    <div class="card-footer bg-white border-0 d-flex align-items-center justify-content-center">
                        <form action="{{ route('cart.store', $product) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-shopping-cart me-1"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            @php
                $demoProducts = \App\Models\Product::inRandomOrder()->take(4)->get();
                // If DB has no products, provide lightweight placeholders for demo
                if ($demoProducts->isEmpty()) {
                    $placeholders = [
                        (object)[ 'name' => 'Kaos Vintage Demo', 'brand' => 'Vintage Co', 'price' => 99000, 'size' => 'L', 'condition' => 'bekas bagus', 'image' => null ],
                        (object)[ 'name' => 'Jaket Demo Denim', 'brand' => 'Denim Lab', 'price' => 245000, 'size' => 'M', 'condition' => 'bekas normal', 'image' => null ],
                        (object)[ 'name' => 'Dress Floral Demo', 'brand' => 'Flora', 'price' => 179000, 'size' => 'S', 'condition' => 'baru', 'image' => null ],
                        (object)[ 'name' => 'Sneakers Demo', 'brand' => 'Sneak Co', 'price' => 210000, 'size' => '42', 'condition' => 'bekas bagus', 'image' => null ],
                    ];
                    $demoProducts = collect($placeholders);
                }
            @endphp

            @foreach($demoProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <a href="{{ isset($product->id) ? route('products.show', $product) : '#' }}" class="text-decoration-none text-dark">
                        <div class="position-relative">
                            @php
                                $placeImgs = [
                                    'https://images.unsplash.com/photo-1540574163026-643ea20ade25?auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1543779506-9e4f0b0b8b7b?auto=format&fit=crop&w=800&q=80',
                                ];
                                $img = (isset($product->image_url) && $product->image_url) ? $product->image_url : $placeImgs[array_rand($placeImgs)];
                            @endphp
                            <img src="{{ $img }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            <span class="badge badge-condition">
                                {{ $product->condition }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $product->brand }}</h6>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text fw-bold" style="color: var(--primary-color);">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                    <div class="card-footer bg-white border-0">
                        @if(isset($product->id))
                        <form action="{{ route('cart.store', $product) }}" method="POST" class="d-grid">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-shopping-cart me-1"></i> Tambah ke Keranjang
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-sm" disabled>Demo</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection