@extends('layouts.app')

@section('title', 'Membership App - Premium Content Access')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <section class="hero-section" style="
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        color: white;
        padding: 100px 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
    ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Premium Content for Every Level</h1>
                    <p class="lead mb-4">Access exclusive articles and videos tailored to your membership level. Start with our free tier or upgrade for unlimited content.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3">
                            <i class="fas fa-user-plus me-2"></i>Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Login to Account
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             class="img-fluid rounded shadow-lg" alt="Membership Benefits">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold">Why Choose Our Platform</h2>
                    <p class="text-muted">We offer the best content for developers and tech enthusiasts</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="feature-icon mx-auto" style="
                            width: 50px;
                            height: 50px;
                            background: linear-gradient(135deg, #4361ee 0%, #4cc9f0 100%);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-bottom: 20px;
                        ">
                            <i class="fas fa-lock text-white fs-4"></i>
                        </div>
                        <h4 class="mt-3">Secure Authentication</h4>
                        <p class="text-muted">Login with Google, Facebook or traditional email/password. Your data is always secure.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="feature-icon mx-auto" style="
                            width: 50px;
                            height: 50px;
                            background: linear-gradient(135deg, #4361ee 0%, #4cc9f0 100%);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-bottom: 20px;
                        ">
                            <i class="fas fa-layer-group text-white fs-4"></i>
                        </div>
                        <h4 class="mt-3">Tiered Membership</h4>
                        <p class="text-muted">Choose from three membership levels with different content access limits.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="feature-icon mx-auto" style="
                            width: 50px;
                            height: 50px;
                            background: linear-gradient(135deg, #4361ee 0%, #4cc9f0 100%);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-bottom: 20px;
                        ">
                            <i class="fas fa-video text-white fs-4"></i>
                        </div>
                        <h4 class="mt-3">Premium Content</h4>
                        <p class="text-muted">Access high-quality articles and video tutorials created by industry experts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Plans -->
    <section id="membership" class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold">Choose Your Membership Plan</h2>
                    <p class="text-muted">Select the plan that best fits your learning needs</p>
                </div>
            </div>
            <div class="row g-4">
                <!-- Basic Plan -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm membership-card" style="
                        transition: transform 0.3s;
                        border-top: 5px solid #4cc9f0 !important;
                    ">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title text-uppercase text-muted fw-bold">Basic</h5>
                            <h2 class="fw-bold my-4">Free</h2>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Access 3 Articles</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Access 3 Videos</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>No Premium Content</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>No Download Access</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Get Started</a>
                        </div>
                    </div>
                </div>
                
                <!-- Standard Plan -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm membership-card" style="
                        transition: transform 0.3s;
                        border-top: 5px solid #4361ee !important;
                    ">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title text-uppercase text-muted fw-bold">Standard</h5>
                            <h2 class="fw-bold my-4">$9.99<span class="fs-6 text-muted">/month</span></h2>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Access 10 Articles</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Access 10 Videos</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Premium Content</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Limited Downloads</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-primary w-100">Choose Plan</a>
                        </div>
                    </div>
                </div>
                
                <!-- Premium Plan -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm membership-card" style="
                        transition: transform 0.3s;
                        border-top: 5px solid #f72585 !important;
                    ">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title text-uppercase text-muted fw-bold">Premium</h5>
                            <h2 class="fw-bold my-4">$19.99<span class="fs-6 text-muted">/month</span></h2>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Unlimited Articles</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Unlimited Videos</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>All Premium Content</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Unlimited Downloads</li>
                            </ul>
                            <a href="{{ route('register') }}" class="btn btn-warning w-100">Choose Premium</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-crown me-2"></i>MembershipApp</h5>
                    <p class="mt-3">Providing premium content for tech enthusiasts since 2023. Learn, grow, and master new skills with our curated content.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}" class="text-white text-decoration-none">Register</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Connect With Us</h5>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fs-4"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fs-4"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fs-4"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-github fs-4"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-white my-4">
            <div class="text-center">
                <p>&copy; 2023 MembershipApp. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>

<style>
    .membership-card:hover {
        transform: translateY(-10px);
    }
    
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
</style>
@endsection