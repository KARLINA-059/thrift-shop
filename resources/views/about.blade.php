@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col">
            <h1 class="fw-bold text-center mb-4">Tentang ThriftStyle</h1>
            <p class="lead text-center text-muted">
                Kami adalah platform e-commerce thrift shop yang berkomitmen untuk menyediakan pakaian bekas berkualitas dengan harga terjangkau.
            </p>
        </div>
    </div>
    
    <!-- Mission & Vision -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="display-4 text-primary mb-4">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Misi Kami</h3>
                    <p class="text-muted">
                        Mendorong sustainable fashion dengan memperpanjang siklus hidup pakaian, mengurangi limbah tekstil, dan menyediakan pilihan fashion berkualitas dengan harga yang terjangkau bagi semua kalangan.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="display-4 text-primary mb-4">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Visi Kami</h3>
                    <p class="text-muted">
                        Menjadi platform thrift shop terdepan di Indonesia yang menginspirasi gaya hidup ramah lingkungan melalui fashion berkelanjutan, dengan fokus pada kualitas, keaslian, dan kepuasan pelanggan.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Values -->
    <div class="row mb-5">
        <div class="col">
            <h2 class="fw-bold text-center mb-5">Nilai-Nilai Kami</h2>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <div class="display-3 text-primary mb-3">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Sustainable</h4>
                        <p class="text-muted">Mengurangi dampak lingkungan melalui fashion berkelanjutan</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <div class="display-3 text-primary mb-3">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Quality</h4>
                        <p class="text-muted">Setiap produk melalui kurasi ketat untuk menjamin kualitas</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <div class="display-3 text-primary mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Community</h4>
                        <p class="text-muted">Membangun komunitas pecinta fashion berkelanjutan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Team -->
    <div class="row">
        <div class="col">
            <h2 class="fw-bold text-center mb-5">Tim Kami</h2>
            
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                 class="rounded-circle mb-3" width="100" height="100" alt="Team Member">
                            <h5 class="fw-bold mb-2">Andi Wijaya</h5>
                            <p class="text-muted mb-3">Founder & CEO</p>
                            <p class="text-muted small">Penggiat sustainable fashion dengan pengalaman 10 tahun di industri retail</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                 class="rounded-circle mb-3" width="100" height="100" alt="Team Member">
                            <h5 class="fw-bold mb-2">Sari Dewi</h5>
                            <p class="text-muted mb-3">Head of Operations</p>
                            <p class="text-muted small">Ahli dalam manajemen operasional dan logistik dengan fokus pada efisiensi</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                 class="rounded-circle mb-3" width="100" height="100" alt="Team Member">
                            <h5 class="fw-bold mb-2">Rudi Santoso</h5>
                            <p class="text-muted mb-3">Creative Director</p>
                            <p class="text-muted small">Bertanggung jawab atas kurasi produk dan pengembangan brand</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection