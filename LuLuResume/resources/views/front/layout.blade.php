<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>LuLu | Personal Advisor for Life & Soul</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/card.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <!-- 引入 SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">


</head>



<body class="index-page">
    <!-- 成功操作後顯示提醒 -->
    @if (Session::has('message'))
        <script>
            Swal.fire({
                position: "top",
                icon: "success",
                title: "{!! Session::get('message') !!}",
                draggable: true,
                didOpen: () => {
                    // 移除 select2 的樣式
                    $('.swal2-container .select2-container').remove();
                },
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                position: "top",
                title: "{!! $errors->first() !!}",
                icon: "error",
                draggable: true
            });
        </script>
    @endif

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <i class="bi bi-buildings"></i>
                <h1 class="sitename">LuLuBOSS</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/" class="active">Home</a></li>
                    <li class="dropdown">
                        <a href="#about-me"><span>導覽</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#about-me">關於我</a></li>
                            <li><a href="#about">MMT天賦系統</a></li>
                            <li><a href="#featured-programs">卡牌介紹</a></li>
                            <li><a href="#contact">留言版</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><span>我的專業</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="https://one-mercury.com/">MMT</a></li>
                            <li><a href="event-details.html">長期照護服務</a></li>
                            <li><a href="privacy.html">護理照護</a></li>
                            <li><a href="https://www.fubon.com/life/product/personal/">富邦保險</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><span>聯絡我</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li>
                                <a href="https://line.me/ti/p/w7U_i0Dc0k" target="_blank">
                                    <i class="bi bi-linkedin me-1"></i> LinkedIn
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/yishan168/" target="_blank">
                                    <i class="bi bi-instagram me-1"></i> Instagram
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!--會員專區-->
                    @if (session('role') === 'player')
                        <li class="dropdown">
                            <a href="{{ route('front.player.dashboard') }}">會員專區
                                <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{ route('front.player.edit') }}">修改會員資料</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (session('managerId') && session('role') === 'admin')
                        <li><a href="{{ route('admin.home') }}" style="color: rgb(26, 189, 118);">後臺專區</a></li>
                    @endif

                    @if (session('playerId') || session('managerId'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                {{ session('nickName', '訪客') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('front.logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button class="dropdown-item" type="submit">登出</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a class="btn btn-outline-light px-3 py-1 me-2" href="/front/register">註冊</a></li>
                        <li><a class="btn btn-primary px-3 py-1" href="/front/login">登入</a></li>
                    @endif
                </ul>

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>



        </div>
    </header>

    <!-- 主內容區塊 -->
    <div class="main-wrapper">
        @yield('content')
    </div>


    <footer id="footer" class="footer position-relative dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">LuLuBOSS</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>09xx-873-xxx</span></p>
                        <p><strong>Email:</strong> <span>aa0120love@gmail.com</span></p>
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
                        <li><a href="#about-me">About us</a></li>
                        <li><a href="#about">MMT天賦系統</a></li>
                        <li><a href="#featured-programs">專長介紹</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>業務範圍</h4>
                    <ul>
                        <li><a href="https://one-mercury.com/">MMT一對一諮詢</a></li>
                        <li><a href="event-details.html">長期照護服務</a></li>
                        <li><a href="privacy.html">護理照護</a></li>
                        <li><a href="https://www.fubon.com/life/product/personal/">富邦保險</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>聯絡我</h4>
                    <ul>
                        <li><a href="https://line.me/ti/p/w7U_i0Dc0k"><i class="bi bi-linkedin"></i> LinkedIn</a></li>
                        <li><a href="event-details.html">Gmail</a></li>
                        <li><a href="https://www.instagram.com/yishan168/"><i
                                    class="bi bi-instagram"></i>Instagram</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© 2025 <strong class="px-1 sitename">LuLuBOSS</strong> 版權所有</p>
            <div class="credits">
                改版設計 by LuLu謙｜原始模板來自 <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- 引入 SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.min.css" rel="stylesheet">


</body>

</html>
