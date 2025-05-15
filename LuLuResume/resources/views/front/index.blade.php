@extends('front.layout')
@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <div class="hero-container">
                <video autoplay="" muted="" loop="" playsinline="" class="video-background">
                    <source src="assets/img/education/video-2.mp4" type="video/mp4">
                </video>
                <div class="overlay"></div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7" data-aos="zoom-out" data-aos-delay="100">
                            <div class="hero-content">
                                <h1>About Me</h1>
                                <p>照顧他人曾是我的職責，如今是我的選擇。從護理走進富邦保險，我將療癒的本質帶進保障的世界，透過 MMT 與塔羅陪伴你看見自己的光。</p>
                                <div class="cta-buttons">
                                    <a href="#contact" class="btn-primary">預約一對一諮詢</a>
                                    <a href="#about" class="btn-secondary">了解我的專業</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5" data-aos="zoom-out" data-aos-delay="200">
                            <div class="stats-card">
                                <div class="stats-header">
                                    <h3>🧩 My Journey, My Expertise</h3>
                                    <div class="decoration-line"></div>
                                </div>
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-heart-pulse"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>98%</h4>
                                            <p> 照護護理</p>
                                        </div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-moon-stars-fill"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>80+</h4>
                                            <p> MMT 天賦系統</p>
                                        </div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-mortarboard"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>120+</h4>
                                            <p>專業知識</p>
                                        </div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-prescription2"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>120+</h4>
                                            <p>富邦保險</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-ticker">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-md-6 col-xl-4 col-12 ticker-item">
                            <span class="date">NOV 15</span>
                            <span class="title">Open House Day</span>
                            <a href="#" class="btn-register">Register</a>
                        </div>
                        <div class="col-md-6 col-12 col-xl-4  ticker-item">
                            <span class="date">DEC 5</span>
                            <span class="title">Application Workshop</span>
                            <a href="#" class="btn-register">Register</a>
                        </div>
                        <div class="col-md-6 col-12 col-xl-4 ticker-item">
                            <span class="date">JAN 10</span>
                            <span class="title">International Student Orientation</span>
                            <a href="#" class="btn-register">Register</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row mb-5">
                    <div class="col-lg-6 pe-lg-5" data-aos="fade-right" data-aos-delay="200">
                        <h2 class="display-6 fw-bold mb-4">Empowering Minds, <span>Shaping Futures</span></h2>
                        <p class="lead mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus
                            nec ullamcorper mattis, pulvinar dapibus leo.</p>
                        <div class="d-flex flex-wrap gap-4 mb-4">
                            <div class="stat-box">
                                <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="25"
                                        data-purecounter-duration="1" class="purecounter"></span>+</span>
                                <span class="stat-label">Years</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="2500"
                                        data-purecounter-duration="1" class="purecounter"></span>+</span>
                                <span class="stat-label">Students</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="125"
                                        data-purecounter-duration="1" class="purecounter"></span>+</span>
                                <span class="stat-label">Faculty</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4 signature-block">
                            <img src="assets/img/misc/signature-1.webp" alt="Principal's Signature" width="120">
                            <div class="ms-3">
                                <p class="mb-0 fw-bold">Dr. Elizabeth Morgan</p>
                                <p class="mb-0 text-muted">Principal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="image-stack">
                            <div class="image-stack-item image-stack-item-top" data-aos="zoom-in" data-aos-delay="400">
                                <img src="assets/img/education/campus-4.webp" alt="Campus Life"
                                    class="img-fluid rounded-4 shadow-lg">
                            </div>
                            <div class="image-stack-item image-stack-item-bottom" data-aos="zoom-in"
                                data-aos-delay="500">
                                <img src="assets/img/education/students-2.webp" alt="Students"
                                    class="img-fluid rounded-4 shadow-lg">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mission-vision-row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-rocket-takeoff"></i>
                            </div>
                            <h3>Our Mission</h3>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur excepteur sint occaecat.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-eye"></i>
                            </div>
                            <h3>Our Vision</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua ut enim ad minim.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-star"></i>
                            </div>
                            <h3>Our Values</h3>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                anim id est laborum consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- 技能專長 -->
        <section id="featured-programs" class="featured-programs section">

            <!-- 技能專長 -->
            <div class="container section-title" data-aos="fade-up">
                <h2>專業整合．貼近人心</h2>
                <p>從臨床護理到保險顧問，結合心理學、MMT 與靈性覺察，打造最貼近人心的支持與保障。</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <ul class="program-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All Programs</li>
                        @foreach ($categories as $category)
                            <li data-filter=".filter-{{ $category->id }}">{{ $category->name }}</li>
                        @endforeach
                    </ul>

                    <div class="row g-4 isotope-container">
                        @foreach ($majors as $major)
                            <div class="col-lg-6 isotope-item filter-{{ $major->majorId }}" data-aos="zoom-in"
                                data-aos-delay="{{ $loop->iteration * 100 }}">
                                <div class="program-item">
                                    <div class="program-badge"> {{ $major->majorCategory->name ?? '未分類' }}</div>
                                    <!-- 小標籤 -->
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <div class="program-image-wrapper">
                                                <img src="{{ asset('storage/' . $major->photo) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="program-content">
                                                <h3>{{ $major->name }}</h3>
                                                <div class="program-highlights">
                                                    <span><i class="bi bi-clock"></i> 4 Years</span>
                                                    <span><i class="bi bi-people-fill"></i> 120 Credits</span>
                                                    <span><i class="bi bi-calendar3"></i> Fall &amp; Spring</span>
                                                </div>
                                                <p>{{ $major->content }}</p>
                                                <a href="#" class="program-btn"><span>Learn More</span> <i
                                                        class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Program Item -->
                        @endforeach
                    </div>

                </div>
            </div>

            </div>

        </section><!-- /Featured Programs Section -->

    </main>

    <footer id="footer" class="footer position-relative dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">NiceSchool</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>關於我</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>我的專業</h4>
                    <ul>
                        <li><a href="https://one-mercury.com/">MMT</a></li>
                        <li><a href="event-details.html">長期照護服務</a></li>
                        <li><a href="privacy.html">護理照護</a></li>
                        <li><a href="https://www.fubon.com/life/product/personal/">富邦保險</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>聯絡我</h4>
                    <ul>
                        <li><a href="news-details.html"><i class="bi bi-linkedin"></i></a></li>
                        <li><a href="event-details.html">Gmail</a></li>
                        <li><a href="privacy.html"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="terms-of-service.html">富邦保險</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">MyWebsite</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>
    </div>
    <script>
        // 手機號碼、電子郵件驗證規則
        const telephoneRegex = /^09\d{8}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // 元素取得
        const telephoneField = document.getElementById('contact-phone');
        const emailField = document.getElementById('contact-email');
        const registerButton = document.getElementById('registerButton'); // 確保對應 HTML 中按鈕
        const telephoneError = document.getElementById('telephoneError');
        const emailError = document.getElementById('emailError');

        // 即時驗證功能
        function validateField(field, regex, errorElement, errorMessage) {
            if (field && errorElement) {
                field.addEventListener('input', () => {
                    if (!regex.test(field.value)) {
                        errorElement.textContent = errorMessage;
                    } else {
                        errorElement.textContent = '';
                    }
                    updateRegisterButtonState();
                });
            }
        }

        // 驗證各個輸入框
        validateField(telephoneField, telephoneRegex, telephoneError, '手機號碼格式錯誤，需為10碼並以09開頭。');
        validateField(emailField, emailRegex, emailError, '電子郵件格式不正確。');
    </script>
@endsection
