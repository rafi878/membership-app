<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Membership App')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --type-a-color: #4cc9f0;
            --type-b-color: #4361ee;
            --type-c-color: #f72585;
        }
        
        .auth-bg {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: white;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .social-btn.google:hover {
            border-color: #DB4437;
            color: #DB4437;
        }
        
        .social-btn.facebook:hover {
            border-color: #4267B2;
            color: #4267B2;
        }
        
        .membership-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .badge-type-a {
            background-color: rgba(76, 201, 240, 0.2);
            color: var(--type-a-color);
            border: 2px solid var(--type-a-color);
        }
        
        .badge-type-b {
            background-color: rgba(67, 97, 238, 0.2);
            color: var(--type-b-color);
            border: 2px solid var(--type-b-color);
        }
        
        .badge-type-c {
            background-color: rgba(247, 37, 133, 0.2);
            color: var(--type-c-color);
            border: 2px solid var(--type-c-color);
        }
        
        .progress-bar-type-a {
            background-color: var(--type-a-color);
        }
        
        .progress-bar-type-b {
            background-color: var(--type-b-color);
        }
        
        .progress-bar-type-c {
            background-color: var(--type-c-color);
        }
        
        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }
        
        .content-card:hover {
            transform: translateY(-5px);
        }
        
        .user-info-card {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navigation untuk Guest -->
    @if(!auth()->check() && !request()->routeIs('login') && !request()->routeIs('register'))
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-crown me-2"></i>MembershipApp
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#membership">Plans</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif
    
    <!-- Navigation untuk User yang sudah login -->
    @if(auth()->check() && !request()->routeIs('home'))
        @include('layouts.navbar')
    @endif
    
    <main>
        @yield('content')
    </main>
    
    @if(session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show" role="alert">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto"><i class="fas fa-check-circle"></i> Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
    
    @if(session('error'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show" role="alert">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto"><i class="fas fa-exclamation-circle"></i> Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>