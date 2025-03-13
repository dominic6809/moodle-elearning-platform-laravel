<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'moodle') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --primary-dark: #3a0ca3;
            --secondary: #7209b7;
            --success: #06d6a0;
            --info: #4cc9f0;
            --warning: #f9c74f;
            --danger: #ef476f;
            --light: #f8f9fa;
            --dark: #212529;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            color: var(--gray-800);
        }

        /* Navbar Styles */
        .navbar {
            padding: 0.75rem 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white !important;
            font-size: 1.3rem;
        }

        .navbar-light .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .navbar-light .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Button Styles */
        .btn {
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-transform: none;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 0.8rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Alert Styles */
        .alert {
            border-radius: 0.6rem;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            background-color: rgba(6, 214, 160, 0.1);
            color: var(--success);
        }

        .alert-danger {
            background-color: rgba(239, 71, 111, 0.1);
            color: var(--danger);
        }

        /* Form Controls */
        .form-control {
            border-radius: 0.5rem;
            padding: 0.6rem 1rem;
            border: 1px solid var(--gray-300);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
            border-color: var(--primary);
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-radius: 0.5rem;
            padding: 0.75rem 0;
        }

        .dropdown-item {
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(67, 97, 238, 0.08);
            color: var(--primary);
        }

        /* Footer Styles */
        footer {
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.03);
        }

        /* Custom eLearning Elements */
        .course-card {
            height: 100%;
        }

        .course-card .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .course-progress {
            height: 8px;
            border-radius: 4px;
        }

        .badge-course-level {
            font-size: 0.7rem;
            padding: 0.35em 0.65em;
            border-radius: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .badge-beginner {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--info);
        }

        .badge-intermediate {
            background-color: rgba(249, 199, 79, 0.1);
            color: var(--warning);
        }

        .badge-advanced {
            background-color: rgba(114, 9, 183, 0.1);
            color: var(--secondary);
        }

        /* Sidebar Navigation for Learning Dashboard */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 90px 0 0;
            width: 260px;
            background-color: white;
            border-right: 1px solid var(--gray-200);
            transition: all 0.3s;
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 90px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: var(--gray-700);
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            margin: 0.25rem 1rem;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }

        .sidebar .nav-link.active {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }

        .sidebar .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            margin-left: 1rem;
        }

        .dark-mode-toggle:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1rem 0;
            }

            .sidebar-sticky {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid d-flex w-100">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'moodle') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                    <!-- Dark Mode Toggle -->
                    <li class="nav-item">
                        <div class="dark-mode-toggle" id="darkModeToggle">
                            <i class="fas fa-moon"></i>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>

        <main class="py-4">
            @if (session('success'))
                <div class="container">
                    <div class="alert alert-success d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="container">
                    <div class="alert alert-danger d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="fw-bold mb-3">{{ config('app.name', 'Laravel eLearning') }}</h5>
                        <p class="text-muted">Empowering learners worldwide with quality education and accessible
                            learning opportunities.</p>
                        <div class="social-icons mt-3">
                            <a href="#" class="me-2 text-secondary"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="me-2 text-secondary"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="me-2 text-secondary"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="me-2 text-secondary"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-2 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3">Explore</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Courses</a>
                            </li>
                            <li class="mb-2"><a href="#"
                                    class="text-decoration-none text-secondary">Teachers</a></li>
                            <li class="mb-2"><a href="#"
                                    class="text-decoration-none text-secondary">Resources</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3">Information</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">About
                                    Us</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">FAQ</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Contact</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Terms</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3">Subscribe to Newsletter</h6>
                        <p class="text-muted small">Stay updated with our latest courses and educational resources.</p>
                        <form>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Your email address"
                                    aria-label="Your email address">
                                <button class="btn btn-primary" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <p class="mb-0 text-muted small">&copy; {{ date('Y') }}
                        {{ config('app.name', 'Laravel eLearning') }}. All rights reserved.</p>
                    <div>
                        <a href="#" class="text-decoration-none text-secondary small me-3">Privacy Policy</a>
                        <a href="#" class="text-decoration-none text-secondary small">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark Mode Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;

            // Check for saved theme preference or respect OS preference
            const darkMode = localStorage.getItem('darkMode') ||
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);

            // Apply theme preference
            if (darkMode === 'enabled' || darkMode === true) {
                body.classList.add('dark-mode');
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }

            // Toggle dark mode
            darkModeToggle.addEventListener('click', function() {
                body.classList.toggle('dark-mode');

                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('darkMode', 'enabled');
                    darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                } else {
                    localStorage.setItem('darkMode', null);
                    darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                }
            });
        });
    </script>
</body>

</html>
