

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
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

                <?php if(auth()->guard()->guest()): ?>
                <div class="mt-4 d-flex justify-content-center gap-3">
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </a>
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-eye me-2"></i> Lihat Koleksi
                    </a>
                </div>
                <?php else: ?>
                <div class="mt-4">
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
                    </a>
                </div>
                <?php endif; ?>
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
            <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="<?php echo e($product->image_url ?: 'https://via.placeholder.com/800x800/cccccc/000000?text=No+Image'); ?>" class="card-img-top product-image" alt="<?php echo e($product->name); ?>">
                        <span class="badge badge-condition">
                            <?php echo e($product->condition); ?>

                        </span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo e($product->brand); ?></h6>
                        <h5 class="card-title"><?php echo e($product->name); ?></h5>
                        <p class="card-text fw-bold" style="color: var(--primary-color);">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                        <div class="mt-auto">
                            <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-shopping-cart me-1"></i> Beli Sekarang
                            </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-sign-in-alt me-1"></i> Login untuk Beli
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">
                <i class="fas fa-arrow-right me-2"></i> Lihat Semua Produk
            </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\thrift-shop\thrift-shop\resources\views/home.blade.php ENDPATH**/ ?>