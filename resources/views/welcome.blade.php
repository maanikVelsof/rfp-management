<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RFP Management System</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <style>
            .hero-section {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset("assets/images/hero-bg.jpg") }}');
                background-size: cover;
                background-position: center;
                min-height: 500px;
                color: white;
            }
            .feature-card {
                transition: transform 0.3s ease;
            }
            .feature-card:hover {
                transform: translateY(-10px);
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="navbar-brand mx-auto text-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" height="40" class="me-2">
                    RFP Management System
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section d-flex align-items-center text-center">
            <div class="container">
                <h2 class="text-white mb-3">RFP Management System</h2>
                <h1 class="display-4 mb-4">Streamline Your RFP Process</h1>
                <p class="lead mb-4">Efficiently manage, track, and respond to Request for Proposals in one centralized platform</p>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Get Started</a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Our Features</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 feature-card border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-file-contract fa-3x text-primary mb-3"></i>
                                <h3 class="h4 card-title">Efficient RFP Management</h3>
                                <p class="card-text">Streamline your RFP process with our intuitive platform. Create, manage, and track proposals effortlessly.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 feature-card border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                <h3 class="h4 card-title">Vendor Management</h3>
                                <p class="card-text">Easily manage and communicate with vendors. Track responses and evaluate proposals in one place.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 feature-card border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                                <h3 class="h4 card-title">Analytics & Reporting</h3>
                                <p class="card-text">Get valuable insights with comprehensive analytics and reporting tools. Make data-driven decisions.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-dark text-light py-4">
            <div class="container text-center">
                <p class="mb-0">&copy; {{ date('Y') }} RFP Management System. All rights reserved.</p>
            </div>
        </footer>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
