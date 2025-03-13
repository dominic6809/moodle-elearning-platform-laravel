<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnConnect - Transform Your Teaching and Learning Experience</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-dark: #4338CA;
            --secondary: #10B981;
            --dark: #1F2937;
            --light: #F9FAFB;
            --gray: #6B7280;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-secondary {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-secondary {
            color: var(--secondary) !important;
        }

        .navbar {
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .navbar.scrolled {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .hero {
            background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
            padding: 8rem 0 6rem;
            position: relative;
            overflow: hidden;
        }

        .hero-shape {
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: var(--gray);
        }

        .feature-card {
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .testimonial-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 10px;
            left: 20px;
            font-size: 5rem;
            color: rgba(79, 70, 229, 0.1);
            font-family: serif;
            line-height: 1;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-card h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 5rem 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .cta-shape {
            position: absolute;
            top: 0;
            right: 0;
            width: 25%;
            opacity: 0.1;
        }

        footer {
            background-color: var(--dark);
            color: var(--light);
            padding: 5rem 0 0;
        }

        .footer-widget h5 {
            color: white;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .footer-widget ul {
            list-style: none;
            padding-left: 0;
        }

        .footer-widget ul li {
            margin-bottom: 0.75rem;
        }

        .footer-widget ul li a {
            color: var(--gray);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-widget ul li a:hover {
            color: var(--secondary);
        }

        .social-links a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--light);
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--secondary);
            color: white;
            transform: translateY(-3px);
        }

        .copyright {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        .floating-image {
            animation: float 6s ease-in-out infinite;
        }

        .user-img {
            width: 40px;
            /* Adjust size as needed */
            height: 40px;
            /* Ensures images are square */
            margin-right: -10px;
            border: 2px solid white;
        }


        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .counter-animation {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .counter-animation.animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Authentication Modal Styles */
        .auth-modal .modal-content {
            border-radius: 15px;
            border: none;
            overflow: hidden;
        }

        .auth-modal .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .auth-tabs {
            display: flex;
            margin-bottom: 1.5rem;
        }

        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 1rem;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .auth-tab.active {
            border-bottom: 2px solid var(--primary);
            color: var(--primary);
        }

        .auth-form-container {
            padding: 0 1rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }

        .btn-auth {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        .auth-divider {
            text-align: center;
            position: relative;
            margin: 1.5rem 0;
        }

        .auth-divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e0e0e0;
        }

        .auth-divider span {
            background-color: white;
            position: relative;
            padding: 0 10px;
            color: var(--gray);
        }

        .social-auth {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .social-auth-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .social-auth-btn:hover {
            background-color: #e9ecef;
        }

        .floating-image {
            height: 500px;
            /* Adjust height as needed */
            width: auto;
            /* Ensures aspect ratio is maintained */
            object-fit: cover;
            /* Prevents distortion */
            border-radius: 10px;
            border: none;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="fas fa-graduation-cap text-primary me-2" style="font-size: 24px;"></i>
                <span class="fw-bold">LearnConnect</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <h1>Transform Your <span class="text-primary">Teaching</span> and <span
                            class="text-secondary">Learning</span> Experience</h1>
                    <p>LearnConnect brings teachers and students together on a powerful platform designed to make
                        education more engaging, effective, and accessible.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#authModal"
                            data-auth-tab="register">
                            <a href="{{ route('register') }}" class="text-white text-decoration-none">Get Started</a><i class="fas fa-arrow-right ms-2"></i></button>
                        <button class="btn btn-light btn-lg"><i class="fas fa-play-circle me-2"></i> Watch Demo</button>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex align-items-center">
                            <div class="d-flex">
                                <img src="{{ asset('images/user1.jpg') }}" alt="User"
                                    class="rounded-circle user-img">
                                <img src="{{ asset('images/user1.jpg') }}" alt="User"
                                    class="rounded-circle user-img">
                                <img src="{{ asset('images/user3.jpg') }}" alt="User"
                                    class="rounded-circle user-img">
                                <img src="{{ asset('images/user3.jpg') }}" alt="User"
                                    class="rounded-circle user-img">
                            </div>

                            <div class="ms-3">
                                <p class="mb-0"><strong>2000+</strong> educators and students trust us</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                    <img src="{{ asset('images/learning-platform.jpg') }}" alt="Learning Platform"
                        class="img-fluid floating-image">
                </div>
            </div>
        </div>
        <svg class="hero-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,64L48,58.7C96,53,192,43,288,48C384,53,480,75,576,80C672,85,768,75,864,64C960,53,1056,43,1152,42.7C1248,43,1344,53,1392,58.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 mt-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold" data-aos="fade-up">Powerful Features</h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-delay="200">Discover the tools that make
                        LearnConnect the perfect platform for modern education</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon bg-primary-light text-primary">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4>Interactive Classrooms</h4>
                        <p class="text-muted">Create engaging virtual classrooms with video conferencing, screen
                            sharing, and interactive whiteboards.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon bg-success-light text-success">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>Comprehensive Courses</h4>
                        <p class="text-muted">Organize all your learning materials, assignments, and assessments in one
                            place.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon bg-warning-light text-warning">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Progress Tracking</h4>
                        <p class="text-muted">Monitor student progress with detailed analytics and performance reports.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon bg-info-light text-info">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Collaborative Learning</h4>
                        <p class="text-muted">Foster student collaboration with group projects, discussion forums, and
                            peer reviews.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon bg-danger-light text-danger">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Mobile Learning</h4>
                        <p class="text-muted">Access courses and materials on any device, anytime, anywhere.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon bg-purple-light text-purple">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4>Gamification</h4>
                        <p class="text-muted">Increase student engagement with points, badges, and leaderboards.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold" data-aos="fade-up">How It Works</h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-delay="200">Get started with LearnConnect in
                        just a few simple steps</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <img src="{{ asset('images/teacher.jpg') }}" alt="Teacher Creating Course"
                        class="img-fluid rounded-3 shadow-lg">
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <div class="d-flex mb-4">
                        <div class="me-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <span class="fw-bold">1</span>
                            </div>
                        </div>
                        <div>
                            <h4>Create Your Account</h4>
                            <p class="text-muted">Sign up as a teacher or student and set up your profile with just a
                                few clicks.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="me-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <span class="fw-bold">2</span>
                            </div>
                        </div>
                        <div>
                            <h4>Create or Join Courses</h4>
                            <p class="text-muted">Teachers can create courses, while students can join using invitation
                                codes or direct links.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <span class="fw-bold">3</span>
                            </div>
                        </div>
                        <div>
                            <h4>Start Learning</h4>
                            <p class="text-muted">Access course materials, participate in discussions, submit
                                assignments, and track your progress.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card counter-animation">
                        <h2 class="counter" data-target="50">0</h2>
                        <p class="text-muted mb-0">Active Users</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card counter-animation">
                        <h2 class="counter" data-target="40">0</h2>
                        <p class="text-muted mb-0">Courses Created</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card counter-animation">
                        <h2 class="counter" data-target="20">0</h2>
                        <p class="text-muted mb-0">Schools</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card counter-animation">
                        <h2 class="counter" data-target="98">0</h2>
                        <p class="text-muted mb-0">Satisfaction Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold" data-aos="fade-up">What Our Users Say</h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-delay="200">Hear from teachers and students who
                        love LearnConnect</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('images/user3.jpg') }}" alt="User"
                                class="rounded-circle me-3 user-img">
                            <div>
                                <h5 class="mb-0">Sarah Johnson</h5>
                                <p class="text-muted mb-0">High School Teacher</p>
                            </div>
                        </div>
                        <p class="mb-0">"LearnConnect has transformed how I teach. Creating engaging lessons is now
                            effortless, and my students are more engaged than ever before."</p>
                        <div class="mt-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('images/user1.jpg') }}" alt="User"
                                class="rounded-circle me-3 user-img">
                            <div>
                                <h5 class="mb-0">Mike Thompson</h5>
                                <p class="text-muted mb-0">College Student</p>
                            </div>
                        </div>
                        <p class="mb-0">"As a student, I love how easy it is to access all my course materials in one
                            place. The interactive features make learning more fun and effective."</p>
                        <div class="mt-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('images/user3.jpg') }}" alt="User"
                                class="rounded-circle me-3 user-img">
                            <div>
                                <h5 class="mb-0">Emily Rodriguez</h5>
                                <p class="text-muted mb-0">School Principal</p>
                            </div>
                        </div>
                        <p class="mb-0">"Implementing LearnConnect across our school has improved student outcomes
                            and made remote learning seamless. The analytics help us track progress effectively."</p>
                        <div class="mt-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold" data-aos="fade-up">Choose Your Plan</h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-delay="200">Select the perfect plan for your
                        needs</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <h5 class="text-uppercase text-muted">Basic</h5>
                            <h1 class="display-6 fw-bold mt-3">Free</h1>
                            <p class="text-muted">For individual teachers and students</p>
                            <hr>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> 1 classroom</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> 30 students</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Basic course tools
                                </li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Limited storage</li>
                                <li class="text-muted mb-2"><i class="fas fa-times text-danger me-2"></i> Advanced
                                    analytics</li>
                                <li class="text-muted mb-2"><i class="fas fa-times text-danger me-2"></i> Priority
                                    support</li>
                            </ul>
                            <button class="btn btn-outline-primary w-100">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow h-100" style="transform: translateY(-10px);">
                        <div class="card-body p-4 text-center">
                            <span class="badge bg-primary mb-3">Most Popular</span>
                            <h5 class="text-uppercase text-muted">Pro</h5>
                            <h1 class="display-6 fw-bold mt-3">$19<small class="fs-6">/month</small></h1>
                            <p class="text-muted">For schools and education centers</p>
                            <hr>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Unlimited classrooms
                                </li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> 500 students</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Advanced course
                                    tools</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> 50GB storage</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Advanced analytics
                                </li>
                                <li class="text-muted mb-2"><i class="fas fa-times text-danger me-2"></i> Priority
                                    support</li>
                            </ul>
                            <button class="btn btn-primary w-100">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <h5 class="text-uppercase text-muted">Enterprise</h5>
                            <h1 class="display-6 fw-bold mt-3">$49<small class="fs-6">/month</small></h1>
                            <p class="text-muted">For districts and large institutions</p>
                            <hr>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Unlimited classrooms
                                </li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Unlimited students
                                </li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> All course tools
                                </li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Unlimited storage
                                </li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Advanced analytics
                                </li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Priority support
                                </li>
                            </ul>
                            <button class="btn btn-outline-primary w-100">Contact Sales</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 text-center text-lg-start">
                    <h2 class="fw-bold mb-3" data-aos="fade-up">Ready to Transform Your Teaching Experience?</h2>
                    <p class="mb-lg-0" data-aos="fade-up" data-aos-delay="200">Join thousands of educators and
                        students who are already using LearnConnect.</p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#authModal"
                        data-auth-tab="register" data-aos="fade-up" data-aos-delay="300">Sign Up Now <i
                            class="fas fa-arrow-right ms-2"></i></button>
                </div>
            </div>
        </div>
        <svg class="cta-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="0.1"
                d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,202.7C672,203,768,181,864,181.3C960,181,1056,203,1152,197.3C1248,192,1344,160,1392,144L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <a class="d-flex align-items-center mb-4" href="#">
                            <i class="fas fa-graduation-cap text-primary me-2" style="font-size: 24px;"></i>
                            <span class="fw-bold text-white">LearnConnect</span>
                        </a>
                        <p class="text-muted">Transforming education through innovative technology solutions that
                            connect teachers and students.</p>
                        <div class="social-links mt-3">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5>Quick Links</h5>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#features">Features</a></li>
                            <li><a href="#how-it-works">How It Works</a></li>
                            <li><a href="#testimonials">Testimonials</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5>For Teachers</h5>
                        <ul>
                            <li><a href="#">Resources</a></li>
                            <li><a href="#">Course Creation</a></li>
                            <li><a href="#">Teaching Tools</a></li>
                            <li><a href="#">Assessment</a></li>
                            <li><a href="#">Community</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5>For Students</h5>
                        <ul>
                            <li><a href="#">Study Materials</a></li>
                            <li><a href="#">Assignments</a></li>
                            <li><a href="#">Progress Tracking</a></li>
                            <li><a href="#">Peer Learning</a></li>
                            <li><a href="#">Certificates</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5>Support</h5>
                        <ul>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-md-0">&copy; 2025 LearnConnect. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">Made with <i class="fas fa-heart text-danger"></i> for educators and
                            learners</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Auth modal tab switching
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.auth-tab');
            const forms = document.querySelectorAll('.auth-form');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');

                    // Deactivate all tabs
                    tabs.forEach(t => t.classList.remove('active'));

                    // Hide all forms
                    forms.forEach(form => {
                        form.style.display = 'none';
                        form.classList.remove('active');
                    });

                    // Activate current tab
                    this.classList.add('active');

                    // Show target form
                    const targetForm = document.getElementById(`${targetTab}-form`);
                    targetForm.style.display = 'block';
                    targetForm.classList.add('active');
                });
            });

            // Handle auth tab from buttons
            const authButtons = document.querySelectorAll('[data-auth-tab]');
            authButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-auth-tab');
                    const tabElement = document.querySelector(`.auth-tab[data-tab="${targetTab}"]`);
                    if (tabElement) {
                        tabElement.click();
                    }
                });
            });
        });

        // Counter animation
        const counterAnimation = () => {
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.getAttribute('data-target');
                    const data = +counter.innerText;
                    const time = value / speed;

                    if (data < value) {
                        counter.innerText = Math.ceil(data + time);
                        setTimeout(animate, 1);
                    } else {
                        counter.innerText = value;
                    }
                };
                animate();
            });
        };

        // Intersection Observer for counter animation
        const observeCounters = () => {
            const counterElements = document.querySelectorAll('.counter-animation');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');

                        // Start counter animation when stats are visible
                        if (entry.target.querySelector('.counter')) {
                            counterAnimation();
                        }

                        // Unobserve after animation
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });

            counterElements.forEach(element => {
                observer.observe(element);
            });
        };

        // Initialize observers
        observeCounters();
    </script>
</body>

</html>
