@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .fade-in { animation: fadeIn 1s ease-in; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
<!-- Hero Section -->
<section class="hero-section hero-fashion fade-in">
    <div class="hero-overlay" aria-hidden="true"></div>
    <div class="container hero-content">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center py-5">
                <h1 class="display-4 fw-bold mb-3 text-white">Temukan Gaya Vintage Anda</h1>
                <p class="lead mb-3 text-white-90">Koleksi thrift estetik — pakaian dengan cerita, tekstur yang hidup, dan gaya yang abadi.</p>
                <p class="mb-4 text-white-85 mx-auto" style="max-width:720px;">Jelajahi flat lay fashion kami: kaos vintage, denim klasik, dan kain dengan karakter unik.</p>

                @guest
                <div class="mt-4 d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-eye me-2"></i> Lihat Koleksi
                    </a>
                </div>
                @else
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
                    </a>
                </div>
                @endguest
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 section-light fade-in">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="fw-bold">Mengapa Memilih ThriftStyle?</h2>
                <p class="text-muted">Kelebihan berbelanja di platform kami</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center p-4 h-100">
                    <div class="card-body">
                        <div class="display-6 mb-3" style="color: var(--primary-color);">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h5 class="card-title">Ramah Lingkungan</h5>
                        <p class="card-text">Dengan membeli produk thrift, kamu turut mengurangi limbah fashion dan mendukung sustainable living.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center p-4 h-100">
                    <div class="card-body">
                        <div class="display-6 mb-3" style="color: var(--primary-color);">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h5 class="card-title">Harga Terjangkau</h5>
                        <p class="card-text">Dapatkan produk berkualitas dengan harga yang jauh lebih murah dibandingkan produk baru.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 text-center p-4 h-100">
                    <div class="card-body">
                        <div class="display-6 mb-3" style="color: var(--primary-color);">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="card-title">Kualitas Terjamin</h5>
                        <p class="card-text">Setiap produk melalui proses kurasi ketat untuk memastikan kualitas yang terbaik untuk kamu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5 section-soft fade-in">
    <div class="container">
        <div class="row mb-5">
            <div class="col">
                <h2 class="fw-bold text-center">Produk Unggulan</h2>
                <p class="text-muted text-center">Beberapa produk terbaik kami</p>
            </div>
        </div>
        
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="{{ $product->image_url ?: 'https://via.placeholder.com/800x800/cccccc/000000?text=No+Image' }}" class="card-img-top product-image" alt="{{ $product->name }}">
                        <span class="badge badge-condition">
                            {{ $product->condition }}
                        </span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted">{{ $product->brand }}</h6>
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text fw-bold" style="color: var(--primary-color);">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="mt-auto">
                            @auth
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-shopping-cart me-1"></i> Beli Sekarang
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-sign-in-alt me-1"></i> Login untuk Beli
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-right me-2"></i> Lihat Semua Produk
            </a>
        </div>
    </div>
</section>
@endsection

@section('footer')