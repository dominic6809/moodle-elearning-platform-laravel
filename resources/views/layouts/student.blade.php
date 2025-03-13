<!-- resources/views/layouts/student.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel eLearning') }} - Student</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --sidebar-bg: #f8f9fa;
            --sidebar-active: #e9ecef;
            --header-height: 60px;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }
        
        /* Header Styles */
        .app-header {
            height: var(--header-height);
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            z-index: 1000;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }
        
        .app-logo {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.2rem;
            text-decoration: none;
        }
        
        .app-logo:hover {
            color: var(--primary-hover);
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: var(--header-height);
            bottom: 0;
            left: 0;
            width: 250px;
            padding: 1rem 0;
            background-color: var(--sidebar-bg);
            overflow-y: auto;
            transition: all 0.3s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            z-index: 900;
        }
        
        @media (max-width: 767.98px) {
            .sidebar {
                margin-left: -250px;
            }
            
            .sidebar.show {
                margin-left: 0;
            }
            
            .content-wrapper {
                margin-left: 0 !important;
            }
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #495057;
            border-radius: 0;
            transition: all 0.2s;
        }
        
        .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            width: 1.5rem;
            text-align: center;
        }
        
        .nav-link:hover {
            background-color: var(--sidebar-active);
            color: var(--primary-color);
        }
        
        .nav-link.active {
            background-color: var(--sidebar-active);
            color: var(--primary-color);
            font-weight: 600;
            position: relative;
        }
        
        .nav-link.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: var(--primary-color);
        }
        
        /* Content Styles */
        .content-wrapper {
            margin-left: 250px;
            margin-top: var(--header-height);
            padding: 2rem;
            min-height: calc(100vh - var(--header-height));
            transition: all 0.3s;
        }
        
        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Notification Badge */
        .badge-notification {
            position: absolute;
            top: 0.25rem;
            right: 1.25rem;
            transform: translate(25%, -25%);
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
        }
        
        /* Custom Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        /* Alert Styles */
        .alert {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        /* Table Styles */
        .table {
            --bs-table-striped-bg: rgba(0, 0, 0, 0.02);
        }
        
        .table th {
            font-weight: 600;
            border-top: none;
            white-space: nowrap;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        /* Status Badges */
        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
            border-radius: 20px;
        }
        
        .badge-success {
            background-color: #a7f3d0;
            color: #065f46;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        
        .badge-info {
            background-color: #e0f2fe;
            color: #0369a1;
        }
        
        /* Form Control Styles */
        .form-control {
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="app-header">
        <!-- Sidebar Toggle (Mobile) -->
        <button class="btn d-md-none me-3" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Logo -->
        <a class="app-logo me-auto" href="{{ route('student.dashboard') }}">
            {{ config('app.name', 'Laravel eLearning') }}
        </a>
        
        <!-- User Dropdown -->
        <div class="dropdown">
            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-none d-md-block me-2">
                    {{ Auth::guard('student')->user()->name }}
                </div>
                <div class="avatar">
                    <i class="fas fa-user-circle fa-lg"></i>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Sign out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.courses*') ? 'active' : '' }}" href="#">
                    <i class="fas fa-book"></i> My Courses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.assignments*') ? 'active' : '' }}" href="{{ route('student.assignments') }}">
                    <i class="fas fa-tasks"></i> Assignments
                </a>
            </li>
            <li class="nav-item position-relative">
                <a class="nav-link {{ request()->routeIs('student.notifications*') ? 'active' : '' }}" href="{{ route('student.notifications') }}">
                    <i class="fas fa-bell"></i> Notifications
                    @php
                        $unreadCount = Auth::guard('student')->user()->notifications()->where('read', false)->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="badge bg-danger badge-notification">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.calendar*') ? 'active' : '' }}" href="#">
                    <i class="fas fa-calendar-alt"></i> Calendar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.resources*') ? 'active' : '' }}" href="#">
                    <i class="fas fa-file-alt"></i> Resources
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="content-wrapper">
        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Page Content -->
        @yield('content')
    </main>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 768 && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>