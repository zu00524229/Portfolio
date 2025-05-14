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
                                <h1>Empowering Futures Through Education</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae diam ornare, imperdiet
                                    est eget, pretium augue. Nullam auctor felis in nibh gravida, eu viverra risus egestas.
                                </p>
                                <div class="cta-buttons">
                                    <a href="#" class="btn-primary">Start Your Journey</a>
                                    <a href="#" class="btn-secondary">Discover Programs</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5" data-aos="zoom-out" data-aos-delay="200">
                            <div class="stats-card">
                                <div class="stats-header">
                                    <h3>Why Choose Us</h3>
                                    <div class="decoration-line"></div>
                                </div>
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-trophy-fill"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>98%</h4>
                                            <p>Graduate Employment</p>
                                        </div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-globe"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>45+</h4>
                                            <p>International Partners</p>
                                        </div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-mortarboard"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>15:1</h4>
                                            <p>Student-Faculty Ratio</p>
                                        </div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-building"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h4>120+</h4>
                                            <p>Degree Programs</p>
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

        <!-- Featured Programs Section -->
        <section id="featured-programs" class="featured-programs section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Featured Programs</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <ul class="program-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All Programs</li>
                        <li data-filter=".filter-bachelor">MMT</li>
                        <li data-filter=".filter-master">護理專業</li>
                        <li data-filter=".filter-certificate">保險業務</li>
                    </ul>

                    <div class="row g-4 isotope-container">
                        <div class="col-lg-6 isotope-item filter-bachelor" data-aos="zoom-in" data-aos-delay="100">
                            <div class="program-item">
                                <div class="program-badge">MMT</div>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="program-image-wrapper">
                                            <img src="assets/img/education/education-1.webp" class="img-fluid"
                                                alt="Program">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="program-content">
                                            <h3>MMT</h3>
                                            <div class="program-highlights">
                                                <span><i class="bi bi-clock"></i> 4 Years</span>
                                                <span><i class="bi bi-people-fill"></i> 120 Credits</span>
                                                <span><i class="bi bi-calendar3"></i> Fall &amp; Spring</span>
                                            </div>
                                            <p>內容區域</p>
                                            <a href="#" class="program-btn"><span>Learn More</span> <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-bachelor" data-aos="zoom-in" data-aos-delay="200">
                            <div class="program-item">
                                <div class="program-badge">MMT</div>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="program-image-wrapper">
                                            <img src="assets/img/education/education-3.webp" class="img-fluid"
                                                alt="Program">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="program-content">
                                            <h3>Business Administration</h3>
                                            <div class="program-highlights">
                                                <span><i class="bi bi-clock"></i> 3 Years</span>
                                                <span><i class="bi bi-people-fill"></i> 90 Credits</span>
                                                <span><i class="bi bi-calendar3"></i> Fall Only</span>
                                            </div>
                                            <p>Nullam sed augue a turpis bibendum cursus. Suspendisse potenti. Praesent mi
                                                diam, feugiat a tincidunt at.</p>
                                            <a href="#" class="program-btn"><span>Learn More</span> <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-bachelor" data-aos="zoom-in" data-aos-delay="300">
                            <div class="program-item">
                                <div class="program-badge">MMT</div>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="program-image-wrapper">
                                            <img src="assets/img/education/education-5.webp" class="img-fluid"
                                                alt="Program">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="program-content">
                                            <h3>Medical Sciences</h3>
                                            <div class="program-highlights">
                                                <span><i class="bi bi-clock"></i> 5 Years</span>
                                                <span><i class="bi bi-people-fill"></i> 150 Credits</span>
                                                <span><i class="bi bi-calendar3"></i> Fall Only</span>
                                            </div>
                                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                                                cubilia curae.</p>
                                            <a href="#" class="program-btn"><span>Learn More</span> <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-master" data-aos="zoom-in" data-aos-delay="100">
                            <div class="program-item">
                                <div class="program-badge">護理專業</div>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="program-image-wrapper">
                                            <img src="assets/img/education/education-7.webp" class="img-fluid"
                                                alt="Program">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="program-content">
                                            <h3>Environmental Studies</h3>
                                            <div class="program-highlights">
                                                <span><i class="bi bi-clock"></i> 2 Years</span>
                                                <span><i class="bi bi-people-fill"></i> 60 Credits</span>
                                                <span><i class="bi bi-calendar3"></i> Spring Only</span>
                                            </div>
                                            <p>Aenean imperdiet, erat vel consequat mollis, nunc risus aliquam nunc, eget
                                                condimentum urna dui et metus.</p>
                                            <a href="#" class="program-btn"><span>Learn More</span> <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-master" data-aos="zoom-in" data-aos-delay="200">
                            <div class="program-item">
                                <div class="program-badge">護理專業</div>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="program-image-wrapper">
                                            <img src="assets/img/education/education-9.webp" class="img-fluid"
                                                alt="Program">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="program-content">
                                            <h3>Mechanical Engineering</h3>
                                            <div class="program-highlights">
                                                <span><i class="bi bi-clock"></i> 2 Years</span>
                                                <span><i class="bi bi-people-fill"></i> 64 Credits</span>
                                                <span><i class="bi bi-calendar3"></i> Fall &amp; Spring</span>
                                            </div>
                                            <p>Praesent tincidunt, massa et porttitor imperdiet, lorem ex ultricies ipsum, a
                                                tempus metus eros non tortor.</p>
                                            <a href="#" class="program-btn"><span>Learn More</span> <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-certificate" data-aos="zoom-in" data-aos-delay="100">
                            <div class="program-item">
                                <div class="program-badge">保險業務</div>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="program-image-wrapper">
                                            <img src="assets/img/education/education-2.webp" class="img-fluid"
                                                alt="Program">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="program-content">
                                            <h3>Data Science</h3>
                                            <div class="program-highlights">
                                                <span><i class="bi bi-clock"></i> 6 Months</span>
                                                <span><i class="bi bi-people-fill"></i> 24 Credits</span>
                                                <span><i class="bi bi-calendar3"></i> Year-round</span>
                                            </div>
                                            <p>Mauris sed erat in mi vestibulum commodo. Donec a purus at justo facilisis
                                                imperdiet tnteger pell</p>
                                            <a href="#" class="program-btn"><span>Learn More</span> <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Program Item -->

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
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Hic solutasetp</h4>
                    <ul>
                        <li><a href="#">Molestiae accusamus iure</a></li>
                        <li><a href="#">Excepturi dignissimos</a></li>
                        <li><a href="#">Suscipit distinctio</a></li>
                        <li><a href="#">Dilecta</a></li>
                        <li><a href="#">Sit quas consectetur</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Nobis illum</h4>
                    <ul>
                        <li><a href="#">Ipsam</a></li>
                        <li><a href="#">Laudantium dolorum</a></li>
                        <li><a href="#">Dinera</a></li>
                        <li><a href="#">Trodelas</a></li>
                        <li><a href="#">Flexo</a></li>
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
