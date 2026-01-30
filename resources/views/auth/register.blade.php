@extends('layouts.app')

@section('title', 'Register - Membership App')

@section('content')
<div class="auth-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="auth-card">
                    <!-- Header -->
                    <div class="auth-header">
                        <h1 class="display-6 fw-bold"><i class="fas fa-user-plus me-2"></i>Join MembershipApp</h1>
                        <p class="mb-0">Create your account and choose your membership plan</p>
                    </div>
                    
                    <!-- Body -->
                    <div class="p-5">
                        <!-- Social Registration -->
                        <div class="mb-4">
                            <p class="text-center text-muted mb-3">Register quickly with your social account</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('auth.google') }}" class="social-btn google">
                                        <i class="fab fa-google me-2"></i> Register with Google
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('auth.facebook') }}" class="social-btn facebook">
                                        <i class="fab fa-facebook me-2"></i> Register with Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Divider -->
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                        </div>
                        
                        <!-- Manual Registration Form -->
                        <div class="mb-4">
                            <p class="text-center text-muted mb-3">Register with your email</p>
                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" placeholder="John Doe" 
                                                   value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   id="password" name="password" placeholder="Create a password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" 
                                                   id="password_confirmation" name="password_confirmation" 
                                                   placeholder="Confirm password" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Membership Selection -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Select Membership Type</label>
                                    <div class="row g-3">
                                        @php
                                            $membershipTypes = [
                                                'A' => ['name' => 'Basic', 'price' => 'Free', 'features' => ['3 Articles', '3 Videos']],
                                                'B' => ['name' => 'Standard', 'price' => '$9.99/month', 'features' => ['10 Articles', '10 Videos', 'Premium Content']],
                                                'C' => ['name' => 'Premium', 'price' => '$19.99/month', 'features' => ['Unlimited Articles', 'Unlimited Videos', 'All Premium Content']]
                                            ];
                                        @endphp
                                        
                                        @foreach($membershipTypes as $key => $type)
                                        <div class="col-md-4">
                                            <div class="card h-100">
                                                <div class="card-body text-center">
                                                    <div class="mb-3">
                                                        <span class="membership-badge badge-type-{{ strtolower($key) }}">
                                                            {{ $type['name'] }}
                                                        </span>
                                                    </div>
                                                    <h5 class="card-title">{{ $type['price'] }}</h5>
                                                    <ul class="list-unstyled mb-3">
                                                        @foreach($type['features'] as $feature)
                                                        <li class="mb-2 small">{{ $feature }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" 
                                                               name="membership_type" value="{{ $key }}" 
                                                               id="type{{ $key }}" 
                                                               {{ old('membership_type', 'A') == $key ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="type{{ $key }}">
                                                            Select Plan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('membership_type')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Terms and Conditions -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror" 
                                               type="checkbox" id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a> 
                                            and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                        </label>
                                        @error('terms')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login here</a>
                            </p>
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