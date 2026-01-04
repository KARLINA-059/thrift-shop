<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrift Online Shop - @yield('title', 'Home')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <!-- Google Fonts for esthetic look -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary-color: #4FA3D1; /* biru utama */
            --primary-hover: #0F2A44; /* biru lebih tua */
            --bg-light: #F4F8FB; /* warna terang */
            --bg-dark: #0F2A44; /* warna gelap */
            --text-light: #ffffff; /* putih */
            --text-dark: #0F1E2E; /* hitam/abu gelap */
            --muted: #2F6DA1; /* muted untuk headings */
            --secondary: #2F6DA1; /* secondary biru */
            --accent: #4FA3D1; /* accent color */
            --card: #FFFFFF;
            --border: #D6E3EE; /* border/divider */
            --glass: rgba(255,255,255,0.7);
            --radius: 12px; /* increased for softer rounded */
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@400;600;700&display=swap');

        html,body{ height:100%; }

        body{
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial;
            background-color: var(--bg-light);
            color: var(--text-dark);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            line-height:1.7;
            padding-top: 0;
        }

        h1,h2,h3,h4,h5,h6{ 
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; 
            color: var(--muted); 
            margin-top:0; 
            font-weight: 700; 
        }

        /* Navbar */
        .navbar{ background: var(--bg-dark); box-shadow: 0 1px 8px rgba(0,0,0,0.08); padding: 1rem 0; }
        .navbar-brand{ font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; font-weight:700; letter-spacing:.6px; color:var(--text-light) !important; font-size:1.5rem; }
        .navbar-nav .nav-link{ color: var(--text-light) !important; padding: 0.75rem 1.25rem; transition: all 0.25s ease; border-radius: var(--radius); }
        .navbar-nav .nav-link:hover{ background: rgba(255,255,255,0.1); opacity: 1; text-decoration: none; }
        .navbar-nav .nav-link button{ color: var(--text-light) !important; background: none; border: none; padding: 0; font-size: inherit; cursor: pointer; }
        .navbar-nav .nav-link button:hover{ background: rgba(255,255,255,0.1); }

        /* Hero */
        .hero-section{ padding:8rem 0; background-size:cover; background-position:center; border-radius:var(--radius); position:relative; margin-bottom:3rem; color:#fff; overflow:hidden; }
        .hero-overlay{ position:absolute; inset:0; background: linear-gradient(180deg, rgba(15,42,68,0.4), rgba(15,42,68,0.6)); z-index:1; }
        .hero-content{ position:relative; z-index:2; }
        .hero-fashion{ background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1400&q=80'); }

        /* Cards */
        .card-product{ border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; background:var(--card); box-shadow: 0 4px 20px rgba(31,45,31,0.04); transition: all 0.3s ease; }
        .card-product:hover{ transform: translateY(-3px); box-shadow: 0 8px 30px rgba(31,45,31,0.08); }
        .product-image{ width:100%; aspect-ratio: 1; object-fit:cover; display:block; }
        .product-image{ width:100%; aspect-ratio: 1; object-fit:cover; display:block; }

        /* Product detail image */
        .product-show-image{ width:100%; max-height:500px; object-fit:cover; border-radius:8px; display:block; }

        /* Quantity controls */
        .quantity-btn{ background:transparent; border:1px solid rgba(45,40,35,0.08); padding:6px 10px; border-radius:8px; color:var(--text); }
        .quantity-btn:hover{ background:rgba(0,0,0,0.03); }
        .quantity-input{ width:70px; text-align:center; }

        /* Cart item */
        .cart-item{ margin-bottom:12px; }

        /* Card spacing */
        .card-body{ padding:1.25rem; }
        .card-footer{ padding:.75rem 1.25rem; }

        /* Badges for product conditions */
        .badge-new{ background:var(--primary-color); color:#fff; border-radius: var(--radius); padding: 4px 8px; }
        .badge-used{ background:var(--secondary); color:var(--text-dark); border-radius: var(--radius); padding: 4px 8px; }
        .badge-other{ background:var(--border); color:var(--text-dark); border-radius: var(--radius); padding: 4px 8px; }

        /* Small product thumbnail for lists/cart */
        .product-thumb{ width:100%; height:80px; object-fit:cover; display:block; border-radius:6px; }

        /* Forms */
        .form-control{ border-radius:var(--radius); border:1px solid var(--border); padding:12px 16px; background:var(--card); transition: all 0.25s ease; }
        .form-control:focus{ box-shadow: 0 4px 16px rgba(79,163,209,0.15); border-color: var(--primary-color); outline: none; }

        /* Buttons - Unified styling */
        .btn{ 
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; 
            font-weight: 600; 
            transition: all 0.25s ease; 
            border-radius: var(--radius); 
            text-transform: none; 
            letter-spacing: 0.5px; 
        }
        .btn-primary{ 
            background: var(--primary-color); 
            border: none; 
            color: #fff; 
            padding: 12px 24px; 
            border-radius: var(--radius); 
            box-shadow: 0 4px 16px rgba(79,163,209,0.2); 
        }
        .btn-primary:hover{ 
            background: var(--primary-hover); 
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(15,42,68,0.3); 
            color: #fff; 
        }
        .btn-secondary{ 
            background: var(--primary-color); 
            color: #fff; 
            border: none; 
            border-radius: var(--radius); 
            padding: 12px 24px; 
            box-shadow: 0 4px 16px rgba(79,163,209,0.2); 
        }
        .btn-secondary:hover{ 
            background: var(--primary-hover); 
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(15,42,68,0.3); 
            color: #fff; 
        }
        .btn-outline-primary{ 
            background: transparent; 
            color: var(--primary-color); 
            border: 2px solid var(--primary-color); 
            border-radius: var(--radius); 
            padding: 10px 20px; 
        }
        .btn-outline-primary:hover{ 
            background: var(--primary-color); 
            color: #fff; 
            border-color: var(--primary-color); 
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(15,42,68,0.3); 
        }
        .btn-link{ 
            color: var(--primary-color); 
            text-decoration: none; 
            font-weight: 600; 
            transition: all 0.25s ease; 
        }
        .btn-link:hover{ 
            color: var(--primary-hover); 
            text-decoration: underline; 
        }
        .btn-sm{ 
            padding: 8px 16px; 
            font-size: 0.875rem; 
        }
        .btn-lg{ 
            padding: 14px 28px; 
            font-size: 1.125rem; 
        }

        /* white text utility for hero */
        .text-white{ color:#fff !important; }
        .text-white-90{ color: rgba(255,255,255,0.95) !important; }
        .text-white-85{ color: rgba(255,255,255,0.9) !important; }

        /* Alerts & badges */
        .alert{ border-radius:8px; }
        .badge-condition{ background: rgba(45,40,35,0.06); color: var(--muted); border-radius: 18px; padding: 6px 10px; font-weight:600; }

        /* Footer */
        .footer{ background: var(--bg-dark); color: var(--text-light); padding: 40px 0; }

        /* Auth forms */
        .payment-card{ border: none; box-shadow: 0 8px 32px rgba(15,42,68,0.08); }
        .payment-card-header{ background: linear-gradient(135deg, var(--primary-color), var(--secondary)); color: white; padding: 2rem; text-align: center; border-radius: var(--radius) var(--radius) 0 0; }
        .payment-card-header h3{ font-weight: 700; margin-bottom: 0.5rem; }
        .payment-card-header p{ opacity: 0.9; margin-bottom: 0; }
        .form-label-custom{ font-weight: 600; color: var(--muted); margin-bottom: 0.5rem; }
        .form-actions{ margin-top: 2rem; }
        .form-group{ margin-bottom: 1.5rem; }

        /* Order status badges */
        .order-status{ display:inline-block; padding:6px 12px; border-radius:20px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; }
        .status-pending{ background: var(--border); color: var(--text); }
        .status-processing{ background: var(--secondary); color: var(--text); }
        .status-shipped{ background: var(--primary); color: #fff; }
        .status-completed{ background: #28a745; color: #fff; }
        .status-cancelled{ background: #dc3545; color: #fff; }

        /* Payment status badges */
        .payment-status{ display:inline-block; padding:4px 8px; border-radius:12px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; }
        .payment-pending{ background: var(--secondary); color: var(--text); }
        .payment-verified{ background: var(--primary); color: #fff; }
        .payment-rejected{ background: #dc3545; color: #fff; }

        /* Status timeline */
        .status-timeline{ position:relative; padding-left:30px; }
        .status-timeline::before{ content:''; position:absolute; left:15px; top:0; bottom:0; width:2px; background: var(--border); }
        .status-item{ position:relative; margin-bottom:30px; display:flex; align-items:flex-start; }
        .status-item.active .status-icon{ background: var(--primary); color: #fff; }
        .status-item.active::before{ content:''; position:absolute; left:-22px; top:15px; width:10px; height:10px; background: var(--primary); border-radius:50%; }
        .status-icon{ width:30px; height:30px; border-radius:50%; background: var(--border); color: var(--text); display:flex; align-items:center; justify-content:center; margin-right:15px; z-index:1; position:relative; }
        .status-content h6{ margin:0 0 5px 0; font-weight:600; color: var(--text); }
        .status-content p{ margin:0; color: var(--muted); font-size:14px; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="fas fa-recycle me-2"></i>
                <span>ThriftStyle</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">
                            <i class="fas fa-store me-1"></i> Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i> Daftar
                        </a>
                    </li>
                    @endguest
                    @auth
                        @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">
                                <i class="fas fa-box me-1"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-tags me-1"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.transactions.index') }}">
                                <i class="fas fa-list me-1"></i> Transactions
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="fas fa-store me-1"></i> Shop
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i> Cart
                                @if(auth()->user()->carts->count() > 0)
                                    <span class="badge bg-danger rounded-pill">{{ auth()->user()->carts->count() }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.history') }}">
                                <i class="fas fa-history me-1"></i> Orders
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link border-0 bg-transparent" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash messages -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    @yield('content')

    @if(!View::hasSection('footer'))
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-4">Kontak Kami</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Thrift Style No. 123, Jakarta</p>
                    <p><i class="fas fa-phone me-2"></i> +62 812 3456 7890</p>
                    <p><i class="fas fa-envelope me-2"></i> info@thriftstyle.com</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-4">Jam Operasional</h5>
                    <p>Senin - Jumat: 09:00 - 21:00</p>
                    <p>Sabtu - Minggu: 10:00 - 22:00</p>
                    <p>Hari Libur: 10:00 - 18:00</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-4">Ikuti Kami</h5>
                    <p><a href="#" class="text-light text-decoration-none"><i class="fab fa-facebook me-2"></i> Facebook</a></p>
                    <p><a href="#" class="text-light text-decoration-none"><i class="fab fa-instagram me-2"></i> Instagram</a></p>
                    <p><a href="#" class="text-light text-decoration-none"><i class="fab fa-twitter me-2"></i> Twitter</a></p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <div class="text-center pt-3">
                <p>&copy; 2024 ThriftStyle. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @endif

    @yield('footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Alert timeout
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
        
        // Quantity increment/decrement
        document.querySelectorAll('.quantity-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                let value = parseInt(input.value);
                
                if (this.classList.contains('minus')) {
                    if (value > 1) {
                        input.value = value - 1;
                    }
                } else if (this.classList.contains('plus')) {
                    input.value = value + 1;
                }
                
                // Trigger change event
                input.dispatchEvent(new Event('change'));
            });
        });
    </script>
    @yield('scripts')
</body>
</html>