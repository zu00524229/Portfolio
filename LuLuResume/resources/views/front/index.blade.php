@extends('front.layout')
@section('content')
    <main class="main">

        <!-- About -->
        <section id="hero" class="hero section dark-background">

            <div class="hero-container">
                <video autoplay="" muted="" loop="" playsinline="" class="video-background">
                    <source src="assets/img/education/bghgmg.mp4" type="video/mp4">
                </video>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7" data-aos="zoom-out" data-aos-delay="100">
                            <div class="hero-content">
                                <h1>About Me</h1>
                                <p>照顧他人曾是我的職責，如今是我的選擇。從護理走進富邦保險，我將療癒的本質帶進保障的世界，透過 MMT 與塔羅陪伴你看見自己的光。</p>
                                <div class="cta-buttons">
                                    <a href="https://one-mercury.com/" class="btn-primary">MMT預約一對一諮詢</a>
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
            {{-- 網頁腰線 --}}
            <div class="event-ticker">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-md-6 col-xl-4 col-12 ticker-item">
                            <span class="date">NOV 15</span>
                            <span class="title">自我介紹</span>
                            <a href="#about-me" class="btn-register">Register</a>
                        </div>
                        <div class="col-md-6 col-12 col-xl-4  ticker-item">
                            <span class="date">DEC 5</span>
                            <span class="title">MMT天賦系統</span>
                            <a href="#about" class="btn-register">Register</a>
                        </div>
                        <div class="col-md-6 col-12 col-xl-4 ticker-item">
                            <span class="date">JAN 10</span>
                            <span class="title">技能專長</span>
                            <a href="#featured-programs" class="btn-register">Register</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- 自我介紹區塊 -->
        <section id="about-me" class="intro-section section">

            <!-- Section Title -->
            <div class="section-title" data-aos="fade-up">
                {{-- <h2>關於我</h2> --}}
                <h3>我是魯魯，一位融合MMT天賦系統與專業保險的陪跑者，</h3>
                <h3>用溫柔與洞察陪伴人們穿越人生轉折。</h3>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center gy-3">

                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <div class="students-life-img position-relative">
                            <img src="assets/img/lulu/lu02.png" class="img-fluid rounded-4 shadow-sm w-100" alt="">
                            <div class="img-overlay">
                                <h3>SoulFlow · 靈感旅人</h3>
                                <a href="about.html" class="explore-btn">探索更多 <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="students-life-content">

                            <div class="row gy-4 mb-4">
                                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="student-activity-item h-100">
                                        {{-- <div class="icon-box">
                                            <i class="bi bi-people"></i>
                                        </div> --}}
                                        <h4>👥 個案陪跑</h4>
                                        <p>從MMT天賦系統出發，協助你梳理生命故事，看見內在渴望與卡點，找到真正適合你的節奏與方向。我相信，每一個人都有能力改寫自己的人生劇本，只是需要一位陪跑者，在關鍵時刻拉你一把。
                                        </p>
                                        <a href="https://one-mercury.com/" target="_blank"
                                            class="btn btn-outline-primary btn-sm mt-2">指定我諮詢 →</a>
                                    </div>
                                </div>

                                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="300">
                                    <div class="student-activity-item h-100">
                                        {{-- <div class="icon-box">
                                            <i class="bi bi-heart-pulse"></i>
                                        </div> --}}
                                        <h4>🧘 靈性療癒</h4>
                                        <p>結合塔羅、精油與意識對話，透過高敏感與直覺力，協助你看見潛藏的能量訊息。不只是解牌，而是引導你回到自己的內在力量，重新與身心靈建立連結，溫柔地療癒那些未被理解的傷。
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
                                    <div class="student-activity-item h-100">
                                        {{-- <div class="icon-box">
                                            <i class="bi bi-journal-bookmark"></i>
                                        </div> --}}
                                        <h4>💼 保險顧問 × 個人特質</h4>
                                        <p>擁有專業臨床護理背景，理解身體與醫療的細節，結合 MMT
                                            天賦系統與心理學觀察力，幫助保險客戶找出「真正適合」自己的保單配置。<br>
                                            我擅長聆聽，擁有豐富的同理心，總是讓人覺得親近安心。為人善良、熱於助人。
                                        </p>
                                        <a href="https://www.instagram.com/yishan168/" target="_blank"
                                            class="btn btn-outline-primary btn-sm mt-2">了解更多保險 →</a>
                                    </div>
                                </div>

                                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="500">
                                    <div class="student-activity-item h-100">
                                        {{-- <div class="icon-box">
                                            <i class="bi bi-globe"></i>
                                        </div> --}}
                                        <h4>🌏 多元整合</h4>
                                        <p>我不只是一個角色，而是穿梭於療癒者、顧問與學習者之間的多面向實踐者。橫跨護理、靈性、保險、教育，擁有架構式思維，也願意不斷精進並分享。這樣的整合力，是我提供服務時最大的價值來源。
                                        </p>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="students-life-cta" data-aos="fade-up" data-aos-delay="600">
                                <a href="about.html" class="btn btn-primary">深入了解魯魯的專業旅程</a>
                            </div> --}}


                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- MMT天賦系統標題 -->
        <div class="container section-title" data-aos="fade-up">
            <h2>MMT天賦系統</h2>
            <p>我是魯魯，一位融合靈性療癒與專業保險的陪跑者，用溫柔與洞察陪伴人們穿越人生轉折。</p>
        </div>

        <!-- MMT天賦系統 -->
        <section id="about" class="about section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row mb-5">
                    <div class="col-lg-6 pe-lg-5" data-aos="fade-right" data-aos-delay="200">
                        <h3>甚麼是MMT天賦系統?</h3>
                        <p class="lead mb-4">MMT 是一套結合 數字排序、心理學與關係圓形圖譜 的人際系統科技。<br>
                            透過專利演算法，只需輸入你的 出生年月日，<br>
                            即可運算出 22 種人格特質，建構出專屬的「關係設計圖」。<br>
                        <h3>MMT 能幫助你——</h3>
                        — 看懂你在關係裡的行為邏輯與盲點<br>
                        — 提升團隊合作與領導力<br>
                        — 修復親密關係、強化親子理解<br>
                        — 精準掌握人與人之間的默契與衝突動力<br>
                        </p>
                        <div class="d-flex flex-wrap gap-4 mb-4">
                            <div class="stat-box">
                                <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="5"
                                        data-purecounter-duration="1" class="purecounter"></span>+</span>
                                <span class="stat-label">探索經歷（年）</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="300"
                                        data-purecounter-duration="1" class="purecounter"></span>+</span>
                                <span class="stat-label">陪跑個案</span>
                            </div>
                            <div class="stat-box">
                                <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="50"
                                        data-purecounter-duration="1" class="purecounter"></span>+</span>
                                <span class="stat-label">團體講座 / 分析紀錄</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mt-4 signature-block">
                            <img src="assets/img/misc/signature-1.webp" alt="Principal's Signature" width="120">
                            <div class="ms-3">
                                <p class="mb-0 fw-bold">LuLu 邱議萱</p>
                                <p class="mb-0 text-muted">MMT人際探索分析師｜保險顧問</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="image-stack">
                            <div class="image-stack-item image-stack-item-top" data-aos="zoom-in" data-aos-delay="400">
                                <img src="assets/img/mmt/mmt6.png" alt="Campus Life"
                                    class="img-fluid rounded-4 shadow-lg">
                            </div>
                            <div class="image-stack-item image-stack-item-bottom" data-aos="zoom-in"
                                data-aos-delay="500">
                                <img src="assets/img/mmt/mmt19.png" alt="Students" class="img-fluid rounded-4 shadow-lg">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mission-vision-row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi-compass"></i>
                            </div>
                            <h3>Our Mission｜我們的使命</h3>
                            <p>透過MMT系統與心理學的結合，幫助每個人認識自我、發掘潛能，讓理解自己與他人不再是難題。
                                我們致力於建立一個看得懂關係、說得出情緒、走得出困境的溝通橋樑，讓人際互動更加清晰、自在、有方向。<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-binoculars"></i>
                            </div>
                            <h3>Our Vision｜我們的願景</h3>
                            <p>相信:每個人都值得擁有清楚自我定位與人生方向的能力。<br>
                                透過MMT的結構化模型與引導，我們希望成為協助人們跨越關係卡點、找到生涯道路的明燈。<br>
                                不論是職涯發展、親子教養，還是情感修復，MMT都是你理解世界與自己的新工具。<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-heart"></i>
                            </div>
                            <h3>Our Values｜我們的價值觀</h3>
                            <p>理解是改變的起點：相信深入的理解，能帶來真正的成長。<br>
                                助人為本：以同理心傾聽與陪伴每一位探索者的心路歷程。<br>
                                科學與直覺並進：結合心理學理論與象徵語言，引導出專屬的發展方向。<br>
                            </p>
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
                                                <img src="{{ asset('storage/' . $major->photo) }}" class="glightbox"
                                                    data-gallery="mmt" alt="">
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
                                                <p>{!! nl2br(e($major->content)) !!}
                                                </p>
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

        <!--聯絡我-->
        <section id="contact" class="section bg-light">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="contact-form-wrapper">
                            <h2 class="text-center mb-4">聯絡我</h2>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf

                                <!--左欄-->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="input-with-icon">
                                            <i class="bi bi-person"></i>
                                            <label for="name" class="form-label">姓名 <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required
                                                value="{{ old('name') }}">
                                        </div>


                                        <div class="input-with-icon">
                                            <i class="bi bi-phone"></i>
                                            <label for="phone" class="form-label">手機</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>


                                    <!--右欄-->
                                    <div class='col-md-6'>
                                        <div class="input-with-icon">
                                            <i class="bi bi-chat-left-dots"></i>
                                            <label for="line" class="form-label">LINE ID</label>
                                            <input type="text" name="line" class="form-control"
                                                value="{{ old('line') }}">
                                        </div>

                                        <div class="input-with-icon">
                                            <i class="bi bi-text-left"></i>
                                            <label for="subject" class="form-label">主題</label>
                                            <select name="subject" class="form-select">
                                                <option value="">請選擇</option>
                                                <option value="MMT一對一">MMT 一對一</option>
                                                <option value="長照諮詢">長照諮詢</option>
                                                <option value="保險規劃">保險規劃</option>
                                                <option value="其他">其他</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="input-with-icon">
                                            <i class="bi bi-envelope"></i>
                                            <label for="email" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" required
                                                value="{{ old('email') }}">
                                            <div id="emailError" class="form-text text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="input-with-icon">
                                            <i class="bi bi-chat-dots message-icon"></i>
                                            <label for="message" class="form-label">留言內容 <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary">送出留言</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
    </div>
@endsection
