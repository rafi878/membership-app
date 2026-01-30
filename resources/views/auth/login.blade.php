@extends('layouts.app')

@section('title', 'Login - Membership App')

@section('content')
<div class="auth-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-card">
                    <!-- Header -->
                    <div class="auth-header">
                        <h1 class="display-6 fw-bold"><i class="fas fa-crown me-2"></i>Welcome Back</h1>
                        <p class="mb-0">Sign in to access your membership content</p>
                    </div>
                    
                    <!-- Body -->
                    <div class="p-5">
                        <!-- Social Login -->
                        <div class="mb-4">
                            <p class="text-center text-muted mb-3">Login quickly with your social account</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('auth.google') }}" class="social-btn google">
                                        <i class="fab fa-google me-2"></i> Login with Google
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('auth.facebook') }}" class="social-btn facebook">
                                        <i class="fab fa-facebook me-2"></i> Login with Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Divider -->
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                        </div>
                        
                        <!-- Manual Login Form -->
                        <div class="mb-4">
                            <p class="text-center text-muted mb-3">Login with your email and password</p>
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" placeholder="you@example.com" 
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" placeholder="Enter your password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login to Account
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Registration Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Register here</a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Demo Accounts -->
                <div class="mt-4 p-4 bg-white rounded shadow-sm">
                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Demo Accounts</h6>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <small class="text-muted">Type A (Basic)</small><br>
                            <code>usera@demo.com / demo123</code>
                        </div>
                        <div class="col-md-4 mb-2">
                            <small class="text-muted">Type B (Standard)</small><br>
                            <code>userb@demo.com / demo123</code>
                        </div>
                        <div class="col-md-4 mb-2">
                            <small class="text-muted">Type C (Premium)</small><br>
                            <code>userc@demo.com / demo123</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endpush
@endsection