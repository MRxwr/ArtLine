<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Art Line - Complete Business Management System with POS, Inventory, and Analytics">
    <title>The Art Line - Modern Business Management System</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #ec4899;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --text-color: #334155;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar {
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            opacity: 0.5;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-section p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
        }
        
        .hero-image {
            position: relative;
            z-index: 1;
        }
        
        .hero-image img {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.2));
        }
        
        /* Banners Carousel */
        .carousel-section {
            padding: 80px 0;
            background: var(--light-color);
        }
        
        .carousel-inner img {
            border-radius: 20px;
            height: 400px;
            object-fit: cover;
        }
        
        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            bottom: 3rem;
        }
        
        /* About Section */
        .about-section {
            padding: 100px 0;
            background: white;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .section-subtitle {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }
        
        .feature-card {
            padding: 2rem;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        /* Counters Section */
        .counters-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .counter-item {
            text-align: center;
        }
        
        .counter-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        
        .counter-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* Pricing Section */
        .pricing-section {
            padding: 100px 0;
            background: var(--light-color);
        }
        
        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }
        
        .pricing-card.featured {
            border: 3px solid var(--primary-color);
            transform: scale(1.05);
        }
        
        .pricing-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .pricing-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .pricing-price {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .pricing-price span {
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--text-color);
        }
        
        .pricing-features {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }
        
        .pricing-features li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .pricing-features li:last-child {
            border-bottom: none;
        }
        
        .pricing-features i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }
        
        /* Testimonials Section */
        .testimonials-section {
            padding: 100px 0;
            background: white;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
        }
        
        .testimonial-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            font-style: italic;
            color: var(--text-color);
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .author-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .author-info h5 {
            margin: 0;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .author-info p {
            margin: 0;
            color: var(--text-color);
            font-size: 0.9rem;
        }
        
        .rating {
            color: #fbbf24;
            margin-bottom: 1rem;
        }
        
        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 80px 0 30px;
        }
        
        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .footer ul {
            list-style: none;
            padding: 0;
        }
        
        .footer ul li {
            margin-bottom: 0.75rem;
        }
        
        .footer ul li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer ul li a:hover {
            color: var(--primary-color);
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 3rem;
            padding-top: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .counter-number {
                font-size: 2.5rem;
            }
            
            .pricing-card.featured {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-palette"></i> The Art Line
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="index.php" class="btn btn-primary-custom text-white">Get Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content" data-aos="fade-right">
                    <h1>Transform Your Business with The Art Line</h1>
                    <p>All-in-one business management system featuring POS, inventory management, analytics, and more. Streamline your operations and boost productivity.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#pricing" class="btn btn-light btn-lg px-4 py-3 rounded-pill">View Pricing</a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">Learn More</a>
                    </div>
                    <div class="mt-4">
                        <small class="text-white opacity-75">
                            <i class="bi bi-check-circle-fill me-2"></i>No credit card required
                            <i class="bi bi-check-circle-fill ms-3 me-2"></i>14-day free trial
                        </small>
                    </div>
                </div>
                <div class="col-lg-6 hero-image" data-aos="fade-left">
                    <img src="img/hero-illustration.svg" alt="The Art Line Dashboard" class="img-fluid" 
                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22600%22 height=%22500%22 viewBox=%220 0 600 500%22%3E%3Crect fill=%22%23ffffff%22 fill-opacity=%220.2%22 width=%22600%22 height=%22500%22 rx=%2220%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-size=%2224%22 fill=%22%23ffffff%22%3EDashboard Illustration%3C/text%3E%3C/svg%3E'">
                </div>
            </div>
        </div>
    </section>

    <!-- Banners Carousel -->
    <section class="carousel-section" id="features">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="section-subtitle">Our Solutions</p>
                <h2 class="section-title">Powerful Features for Your Business</h2>
            </div>
            <div id="featuresCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="zoom-in">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/pos-banner.jpg" class="d-block w-100" alt="POS System"
                             onerror="this.src='https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=1200&h=400&fit=crop'">
                        <div class="carousel-caption">
                            <h3>Advanced POS System</h3>
                            <p>Lightning-fast point of sale with offline capability and real-time sync</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/inventory-banner.jpg" class="d-block w-100" alt="Inventory Management"
                             onerror="this.src='https://images.unsplash.com/photo-1553413077-190dd305871c?w=1200&h=400&fit=crop'">
                        <div class="carousel-caption">
                            <h3>Smart Inventory Management</h3>
                            <p>Track stock levels, automate reordering, and prevent stockouts</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/analytics-banner.jpg" class="d-block w-100" alt="Analytics Dashboard"
                             onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&h=400&fit=crop'">
                        <div class="carousel-caption">
                            <h3>Powerful Analytics</h3>
                            <p>Data-driven insights to make informed business decisions</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#featuresCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#featuresCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="section-subtitle">Why Choose Us</p>
                <h2 class="section-title">Everything You Need to Run Your Business</h2>
                <p class="lead text-muted">The Art Line combines powerful features with intuitive design to help you manage your business efficiently</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h4>Point of Sale</h4>
                        <p>Modern, intuitive POS interface that works online and offline. Process transactions quickly with barcode scanning and multiple payment options.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h4>Inventory Management</h4>
                        <p>Keep track of your stock levels in real-time. Set up automatic alerts for low stock and manage suppliers efficiently.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>Analytics & Reports</h4>
                        <p>Comprehensive dashboards and reports to understand your business performance. Make data-driven decisions with ease.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>Customer Management</h4>
                        <p>Build lasting relationships with customer profiles, purchase history, and loyalty programs to increase retention.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <h4>Invoice & Billing</h4>
                        <p>Create professional invoices and receipts instantly. Support for multiple payment methods and automatic calculations.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Secure & Reliable</h4>
                        <p>Enterprise-grade security with data encryption, regular backups, and 99.9% uptime guarantee for peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Counters Section -->
    <section class="counters-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="counter-item">
                        <div class="counter-number" data-target="5000">0</div>
                        <div class="counter-label">Active Users</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="counter-item">
                        <div class="counter-number" data-target="50000">0</div>
                        <div class="counter-label">Transactions Daily</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="counter-item">
                        <div class="counter-number" data-target="99">0</div>
                        <div class="counter-label">Customer Satisfaction</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="counter-item">
                        <div class="counter-number" data-target="24">0</div>
                        <div class="counter-label">Hours Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section" id="pricing">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="section-subtitle">Pricing Plans</p>
                <h2 class="section-title">Choose Your Perfect Plan</h2>
                <p class="lead text-muted">Flexible pricing options to match your business needs</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-card">
                        <div class="pricing-title">Starter</div>
                        <div class="pricing-price">$29<span>/month</span></div>
                        <p class="text-muted">Perfect for small businesses</p>
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> Single Location</li>
                            <li><i class="bi bi-check-circle-fill"></i> Up to 1,000 Products</li>
                            <li><i class="bi bi-check-circle-fill"></i> Basic POS Features</li>
                            <li><i class="bi bi-check-circle-fill"></i> Inventory Management</li>
                            <li><i class="bi bi-check-circle-fill"></i> Basic Reports</li>
                            <li><i class="bi bi-check-circle-fill"></i> Email Support</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary w-100 rounded-pill py-3 mt-3">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-card featured">
                        <span class="pricing-badge">Most Popular</span>
                        <div class="pricing-title">Professional</div>
                        <div class="pricing-price">$79<span>/month</span></div>
                        <p class="text-muted">Best for growing businesses</p>
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> Up to 3 Locations</li>
                            <li><i class="bi bi-check-circle-fill"></i> Unlimited Products</li>
                            <li><i class="bi bi-check-circle-fill"></i> Advanced POS Features</li>
                            <li><i class="bi bi-check-circle-fill"></i> Advanced Inventory</li>
                            <li><i class="bi bi-check-circle-fill"></i> Advanced Analytics</li>
                            <li><i class="bi bi-check-circle-fill"></i> Customer Management</li>
                            <li><i class="bi bi-check-circle-fill"></i> Priority Support</li>
                        </ul>
                        <a href="#" class="btn btn-primary-custom w-100 rounded-pill py-3 mt-3 text-white">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="pricing-card">
                        <div class="pricing-title">Enterprise</div>
                        <div class="pricing-price">$199<span>/month</span></div>
                        <p class="text-muted">For large organizations</p>
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> Unlimited Locations</li>
                            <li><i class="bi bi-check-circle-fill"></i> Unlimited Products</li>
                            <li><i class="bi bi-check-circle-fill"></i> All Professional Features</li>
                            <li><i class="bi bi-check-circle-fill"></i> Multi-Store Management</li>
                            <li><i class="bi bi-check-circle-fill"></i> API Access</li>
                            <li><i class="bi bi-check-circle-fill"></i> Custom Integrations</li>
                            <li><i class="bi bi-check-circle-fill"></i> Dedicated Account Manager</li>
                            <li><i class="bi bi-check-circle-fill"></i> 24/7 Phone Support</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary w-100 rounded-pill py-3 mt-3">Contact Sales</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="section-subtitle">Testimonials</p>
                <h2 class="section-title">What Our Customers Say</h2>
                <p class="lead text-muted">Join thousands of satisfied businesses using The Art Line</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"The Art Line has completely transformed how we manage our retail store. The POS system is incredibly fast and the inventory management saves us hours every week."</p>
                        <div class="testimonial-author">
                            <div class="author-image">SM</div>
                            <div class="author-info">
                                <h5>Sarah Mitchell</h5>
                                <p>Owner, Artisan Boutique</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"We switched to The Art Line 6 months ago and haven't looked back. The analytics features help us make better business decisions every day. Highly recommended!"</p>
                        <div class="testimonial-author">
                            <div class="author-image">JC</div>
                            <div class="author-info">
                                <h5>James Chen</h5>
                                <p>Manager, Tech Hub Store</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"Outstanding customer support and a feature-rich platform. The Art Line grows with our business. It's the perfect solution for multi-location retail."</p>
                        <div class="testimonial-author">
                            <div class="author-image">EP</div>
                            <div class="author-info">
                                <h5>Emma Parker</h5>
                                <p>CEO, Fashion Forward</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5><i class="bi bi-palette"></i> The Art Line</h5>
                    <p class="text-white-50">Complete business management solution for modern retailers. Streamline operations, boost sales, and grow your business with confidence.</p>
                    <div class="social-links mt-4">
                        <a href="https://facebook.com" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://instagram.com" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://linkedin.com" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="https://youtube.com" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Product</h5>
                    <ul>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#">Demo</a></li>
                        <li><a href="#">API</a></li>
                        <li><a href="#">Integrations</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Company</h5>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Press Kit</a></li>
                        <li><a href="#">Partners</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">System Status</a></li>
                        <li><a href="#">Community</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">GDPR</a></li>
                        <li><a href="#">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 The Art Line. All rights reserved. Designed with <i class="bi bi-heart-fill text-danger"></i> for modern businesses.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
            } else {
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
            }
        });

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    element.textContent = Math.floor(current) + (element.textContent.includes('%') ? '%' : '+');
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target + (target === 99 ? '%' : '+');
                }
            };

            updateCounter();
        }

        // Intersection Observer for counters
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.counter-number');
                    counters.forEach(counter => {
                        animateCounter(counter);
                    });
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const countersSection = document.querySelector('.counters-section');
        if (countersSection) {
            counterObserver.observe(countersSection);
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Auto-play carousel
        const carousel = new bootstrap.Carousel(document.getElementById('featuresCarousel'), {
            interval: 5000,
            ride: 'carousel'
        });
    </script>
</body>
</html>
