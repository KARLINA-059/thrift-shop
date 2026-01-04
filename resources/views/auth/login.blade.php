@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card payment-card">
                <div class="payment-card-header">
                    <h3 class="mb-0">Login ke Akun Anda</h3>
                    <p class="mb-0">Masuk untuk mulai berbelanja</p>
                </div>
                
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}" class="mt-3">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="mb-3 form-group">
                            <label for="email" class="form-label form-label-custom">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="password" class="form-label form-label-custom">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <a href="{{ route('about') }}" class="text-muted small">Lupa password?</a>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="small">Belum punya akun? <a href="{{ route('register') }}" style="color: var(--primary-color);" class="fw-bold">Daftar di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection