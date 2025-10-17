<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wee Design - نظام إدارة متكامل لمتاجر الملابس النسائية المحافظة">
    <title>Wee Design - نظام إدارة المبيعات للأزياء النسائية</title>
    
    <!-- Bootstrap 5.3 CSS RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            font-family: 'Cairo', sans-serif;
            color: var(--text-color);
            overflow-x: hidden;
            direction: rtl;
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
        
        /* Contact Section */
        .contact-section {
            padding: 100px 0;
            background: var(--light-color);
        }
        
        .contact-info .info-item {
            transition: transform 0.3s ease;
        }
        
        .contact-info .info-item:hover {
            transform: translateX(10px);
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        
        .contact-info h5 {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .contact-form-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .contact-form .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .contact-form .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .contact-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .contact-form textarea.form-control {
            resize: vertical;
            min-height: 120px;
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
                <i class="bi bi-heart-fill"></i> Wee Design
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">المميزات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">عن النظام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">الباقات والأسعار</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">آراء العملاء</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">تواصل معنا</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="index.php" class="btn btn-primary-custom text-white">ابدأ الآن</a>
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
                    <h1>أطلقي متجرك للأزياء النسائية المحافظة مع Wee Design</h1>
                    <p>نظام متكامل لإدارة مبيعات الملابس النسائية العربية والمحافظة - نقاط بيع سريعة، إدارة مخزون ذكية، وتقارير تحليلية دقيقة لنجاح متجرك</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#pricing" class="btn btn-light btn-lg px-4 py-3 rounded-pill">شاهد الباقات</a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">اكتشف المزيد</a>
                    </div>
                    <div class="mt-4">
                        <small class="text-white opacity-75">
                            <i class="bi bi-check-circle-fill me-2"></i>بدون بطاقة ائتمان
                            <i class="bi bi-check-circle-fill ms-3 me-2"></i>تجربة مجانية لمدة 14 يوم
                        </small>
                    </div>
                </div>
                <div class="col-lg-6 hero-image" data-aos="fade-left">
                    <img src="img/hero-illustration.svg" alt="لوحة التحكم Wee Design" class="img-fluid" 
                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22600%22 height=%22500%22 viewBox=%220 0 600 500%22%3E%3Crect fill=%22%23ffffff%22 fill-opacity=%220.2%22 width=%22600%22 height=%22500%22 rx=%2220%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-size=%2224%22 fill=%22%23ffffff%22%3EWee Design%3C/text%3E%3C/svg%3E'">
                </div>
            </div>
        </div>
    </section>

    <!-- Banners Carousel -->
    <section class="carousel-section" id="features">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="section-subtitle">حلولنا المتكاملة</p>
                <h2 class="section-title">مميزات قوية لنجاح متجرك</h2>
            </div>
            <div id="featuresCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="zoom-in">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/pos-banner.jpg" class="d-block w-100" alt="نظام نقاط البيع"
                             onerror="this.src='https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=1200&h=400&fit=crop'">
                        <div class="carousel-caption">
                            <h3>نظام نقاط بيع متطور</h3>
                            <p>سرعة فائقة في معالجة المبيعات مع إمكانية العمل بدون إنترنت ومزامنة فورية</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/inventory-banner.jpg" class="d-block w-100" alt="إدارة المخزون"
                             onerror="this.src='https://images.unsplash.com/photo-1553413077-190dd305871c?w=1200&h=400&fit=crop'">
                        <div class="carousel-caption">
                            <h3>إدارة مخزون ذكية</h3>
                            <p>تتبع مخزون الملابس والمقاسات والألوان لحظياً مع تنبيهات ذكية لإعادة الطلب</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/analytics-banner.jpg" class="d-block w-100" alt="لوحة التحليلات"
                             onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&h=400&fit=crop'">
                        <div class="carousel-caption">
                            <h3>تقارير وتحليلات قوية</h3>
                            <p>معلومات دقيقة عن المبيعات والأرباح لاتخاذ قرارات صحيحة</p>
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
                <p class="section-subtitle">لماذا تختارين Wee Design</p>
                <h2 class="section-title">كل ما تحتاجينه لإدارة متجر الملابس النسائية</h2>
                <p class="lead text-muted">Wee Design يجمع بين القوة والسهولة لمساعدتك في إدارة متجر الأزياء النسائية المحافظة بكفاءة عالية</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h4>نقاط البيع السريعة</h4>
                        <p>واجهة عصرية وسهلة تعمل مع وبدون إنترنت. معالجة المبيعات بسرعة مع مسح الباركود وخيارات دفع متعددة</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h4>إدارة المخزون المتقدمة</h4>
                        <p>تتبع مخزون الملابس حسب المقاسات والألوان. تنبيهات تلقائية عند نقص المخزون وإدارة الموردين بسهولة</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>التقارير والتحليلات</h4>
                        <p>لوحات تحكم شاملة وتقارير مفصلة لفهم أداء متجرك. اتخذي قرارات ذكية مبنية على البيانات الدقيقة</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>إدارة العميلات</h4>
                        <p>بناء علاقات دائمة مع ملفات العميلات وسجل المشتريات وبرامج الولاء لزيادة الاحتفاظ بالزبائن</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <h4>الفواتير والإيصالات</h4>
                        <p>إنشاء فواتير وإيصالات احترافية فوراً. دعم طرق دفع متعددة مع حسابات تلقائية دقيقة</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>آمن وموثوق</h4>
                        <p>حماية على مستوى المؤسسات مع تشفير البيانات ونسخ احتياطي منتظم وضمان توفر 99.9% لراحة بالك</p>
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
                        <div class="counter-number" data-target="500">0</div>
                        <div class="counter-label">متجر نسائي نشط</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="counter-item">
                        <div class="counter-number" data-target="10000">0</div>
                        <div class="counter-label">عملية بيع يومياً</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="counter-item">
                        <div class="counter-number" data-target="98">0</div>
                        <div class="counter-label">رضا العملاء</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="counter-item">
                        <div class="counter-number" data-target="24">0</div>
                        <div class="counter-label">دعم فني</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section" id="pricing">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="section-subtitle">باقات الاشتراك</p>
                <h2 class="section-title">اختاري الباقة المناسبة لمتجرك</h2>
                <p class="lead text-muted">خيارات مرنة تناسب احتياجات متجرك مع خدمة التوصيل</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-card">
                        <div class="pricing-title">الباقة الشهرية</div>
                        <div class="pricing-price">25 د.ك<span>/شهرياً</span></div>
                        <p class="text-muted">+ 15% عمولة على كل فاتورة</p>
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> فرع واحد</li>
                            <li><i class="bi bi-check-circle-fill"></i> حتى 1,000 منتج</li>
                            <li><i class="bi bi-check-circle-fill"></i> نقاط بيع أساسية</li>
                            <li><i class="bi bi-check-circle-fill"></i> إدارة المخزون</li>
                            <li><i class="bi bi-check-circle-fill"></i> تقارير أساسية</li>
                            <li><i class="bi bi-check-circle-fill"></i> خدمة التوصيل المدمجة</li>
                            <li><i class="bi bi-check-circle-fill"></i> دعم عبر البريد</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary w-100 rounded-pill py-3 mt-3">ابدأ الآن</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-card featured">
                        <span class="pricing-badge">الأكثر طلباً</span>
                        <div class="pricing-title">الباقة نصف السنوية</div>
                        <div class="pricing-price">100 د.ك<span>/6 أشهر</span></div>
                        <p class="text-muted">+ 10% عمولة على كل فاتورة</p>
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> حتى 3 فروع</li>
                            <li><i class="bi bi-check-circle-fill"></i> منتجات غير محدودة</li>
                            <li><i class="bi bi-check-circle-fill"></i> نقاط بيع متقدمة</li>
                            <li><i class="bi bi-check-circle-fill"></i> إدارة مخزون متقدمة</li>
                            <li><i class="bi bi-check-circle-fill"></i> تحليلات متقدمة</li>
                            <li><i class="bi bi-check-circle-fill"></i> إدارة العميلات</li>
                            <li><i class="bi bi-check-circle-fill"></i> خدمة التوصيل المدمجة</li>
                            <li><i class="bi bi-check-circle-fill"></i> دعم فني ذو أولوية</li>
                        </ul>
                        <a href="#" class="btn btn-primary-custom w-100 rounded-pill py-3 mt-3 text-white">ابدأ الآن</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="pricing-card">
                        <div class="pricing-title">الباقة السنوية</div>
                        <div class="pricing-price">250 د.ك<span>/سنوياً</span></div>
                        <p class="text-muted">+ 7.5% عمولة على كل فاتورة</p>
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> فروع غير محدودة</li>
                            <li><i class="bi bi-check-circle-fill"></i> منتجات غير محدودة</li>
                            <li><i class="bi bi-check-circle-fill"></i> جميع مميزات الباقة نصف السنوية</li>
                            <li><i class="bi bi-check-circle-fill"></i> إدارة متعددة الفروع</li>
                            <li><i class="bi bi-check-circle-fill"></i> الوصول لواجهة برمجية API</li>
                            <li><i class="bi bi-check-circle-fill"></i> تكاملات مخصصة</li>
                            <li><i class="bi bi-check-circle-fill"></i> خدمة التوصيل المدمجة</li>
                            <li><i class="bi bi-check-circle-fill"></i> مدير حساب مخصص</li>
                            <li><i class="bi bi-check-circle-fill"></i> دعم فني 24/7 عبر الهاتف</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary w-100 rounded-pill py-3 mt-3">تواصل معنا</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="section-subtitle">آراء عميلاتنا</p>
                <h2 class="section-title">ماذا يقولن صاحبات المتاجر</h2>
                <p class="lead text-muted">انضمي لمئات المتاجر النسائية الناجحة التي تستخدم Wee Design</p>
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
                        <p class="testimonial-text">"Wee Design غير طريقة إدارتي لمتجر العبايات بالكامل. نظام نقاط البيع سريع جداً وإدارة المخزون توفر علي ساعات كل أسبوع. النظام سهل ومريح جداً"</p>
                        <div class="testimonial-author">
                            <div class="author-image">نم</div>
                            <div class="author-info">
                                <h5>نورة المطيري</h5>
                                <p>صاحبة متجر أناقة نورة</p>
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
                        <p class="testimonial-text">"انتقلت لـ Wee Design قبل 6 أشهر ولم أندم أبداً. التقارير والتحليلات تساعدني اتخذ قرارات صحيحة كل يوم. أنصح فيه بقوة لكل صاحبة متجر عبايات"</p>
                        <div class="testimonial-author">
                            <div class="author-image">مع</div>
                            <div class="author-info">
                                <h5>مريم العتيبي</h5>
                                <p>مديرة بوتيك الرقي</p>
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
                        <p class="testimonial-text">"دعم فني ممتاز ونظام غني بالمميزات. Wee Design ينمو مع نمو متجري. الحل المثالي لإدارة عدة فروع لمتاجر الملابس النسائية المحافظة"</p>
                        <div class="testimonial-author">
                            <div class="author-image">سخ</div>
                            <div class="author-info">
                                <h5>سارة الخالدي</h5>
                                <p>مؤسسة متاجر الأناقة الراقية</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <p class="section-subtitle">تواصلي معنا</p>
                    <h2 class="section-title">دعينا نتحدث عن متجرك</h2>
                    <p class="lead text-muted mb-4">لديك استفسارات؟ يسعدنا التواصل معك. أرسلي لنا رسالة وسنرد في أقرب وقت ممكن.</p>
                    
                    <div class="contact-info">
                        <div class="info-item mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="info-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div>
                                    <h5>راسلينا عبر البريد</h5>
                                    <p class="text-muted mb-0">support@weedesign.com</p>
                                    <p class="text-muted mb-0">sales@weedesign.com</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="info-icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div>
                                    <h5>اتصلي بنا</h5>
                                    <p class="text-muted mb-0">+965 9999 9999</p>
                                    <p class="text-muted mb-0">السبت - الخميس: 9 صباحاً - 6 مساءً</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="d-flex align-items-start gap-3">
                                <div class="info-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <h5>زورينا</h5>
                                    <p class="text-muted mb-0">شارع الأعمال 123</p>
                                    <p class="text-muted mb-0">الكويت، العاصمة</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="contact-form-card">
                        <form id="contactForm" class="contact-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">الاسم الأول *</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">اسم العائلة *</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">البريد الإلكتروني *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">الموضوع *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">الرسالة *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-custom text-white w-100 py-3">
                                        <i class="bi bi-send me-2"></i>إرسال الرسالة
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="formMessage" class="alert mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5><i class="bi bi-heart-fill"></i> Wee Design</h5>
                    <p class="text-white-50">حل متكامل لإدارة متاجر الملابس النسائية المحافظة. نساعدك على تنمية تجارتك بثقة واحترافية</p>
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
                        <a href="https://snapchat.com" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-snapchat"></i>
                        </a>
                        <a href="https://tiktok.com" class="social-link" target="_blank" rel="noopener">
                            <i class="bi bi-tiktok"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>المنتج</h5>
                    <ul>
                        <li><a href="#features">المميزات</a></li>
                        <li><a href="#pricing">الباقات والأسعار</a></li>
                        <li><a href="#">تجربة مجانية</a></li>
                        <li><a href="#">واجهة برمجية</a></li>
                        <li><a href="#">التكاملات</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>الشركة</h5>
                    <ul>
                        <li><a href="#about">من نحن</a></li>
                        <li><a href="#">الوظائف</a></li>
                        <li><a href="#">المدونة</a></li>
                        <li><a href="#">الأخبار</a></li>
                        <li><a href="#">الشركاء</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>الدعم الفني</h5>
                    <ul>
                        <li><a href="#">مركز المساعدة</a></li>
                        <li><a href="#">التوثيق</a></li>
                        <li><a href="#">تواصل معنا</a></li>
                        <li><a href="#">حالة النظام</a></li>
                        <li><a href="#">المجتمع</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>قانوني</h5>
                    <ul>
                        <li><a href="#">سياسة الخصوصية</a></li>
                        <li><a href="#">شروط الخدمة</a></li>
                        <li><a href="#">سياسة الكوكيز</a></li>
                        <li><a href="#">الامتثال</a></li>
                        <li><a href="#">الأمان</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Wee Design. جميع الحقوق محفوظة. صُمم بـ <i class="bi bi-heart-fill text-danger"></i> لمتاجر الأزياء النسائية المحافظة</p>
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

        // Contact form submission
        const contactForm = document.getElementById('contactForm');
        const formMessage = document.getElementById('formMessage');

        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData);
            
            // Show loading state
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>جاري الإرسال...';
            submitBtn.disabled = true;
            
            // Simulate form submission (replace with actual API call)
            setTimeout(() => {
                // Show success message
                formMessage.className = 'alert alert-success mt-3';
                formMessage.style.display = 'block';
                formMessage.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>شكراً لك! تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.';
                
                // Reset form
                contactForm.reset();
                
                // Reset button
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
                
                // Hide message after 5 seconds
                setTimeout(() => {
                    formMessage.style.display = 'none';
                }, 5000);
            }, 1500);
            
            // For actual implementation, use this:
            /*
            fetch('api/contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    formMessage.className = 'alert alert-success mt-3';
                    formMessage.style.display = 'block';
                    formMessage.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>' + result.message;
                    contactForm.reset();
                } else {
                    formMessage.className = 'alert alert-danger mt-3';
                    formMessage.style.display = 'block';
                    formMessage.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-2"></i>' + result.message;
                }
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            })
            .catch(error => {
                formMessage.className = 'alert alert-danger mt-3';
                formMessage.style.display = 'block';
                formMessage.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-2"></i>An error occurred. Please try again.';
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            });
            */
        });
    </script>
</body>
</html>
