<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>ToysShop</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="/front/images/logo.png" type="image/png">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700%7CLibre+Baskerville:400,400italic,700%7CCourgette">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/front/css/bootstrap.css">
    <link rel="stylesheet" href="/front/css/fonts.css">
    <link rel="stylesheet" href="/front/css/style.css">
    <!-- 引入 SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
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
    <div class="preloader">
        <div class="preloader-body">
            <div class="cssload-container">
                <div class="cssload-speeding-wheel"></div>
            </div>
            <p>Loading...</p>
        </div>
    </div>
    <div class="page text-center">
        <header class="section page-head page-head-default">
            <!--RD Navbar-->
            <div class="rd-navbar-wrap bg-transparent">
                <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                    data-md-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fixed"
                    data-lg-layout="rd-navbar-fullwidth" data-lg-device-layout="rd-navbar-static"
                    data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static"
                    data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static"
                    data-lg-stick-up-offset="46px" data-xl-stick-up-offset="117px" data-xxl-stick-up-offset="117px"
                    data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                    <div class="rd-navbar-inner">
                        <div class="rd-navbar-panel">
                            <!-- RD Navbar Toggle-->
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"
                                type="submit"><span></span></button>
                            <!-- RD Navbar Brand-->
                            <div class="rd-navbar-brand ms-5 d-flex align-items-center">
                                <img src="/front/images/logo.png" alt="ToysShop Logo" width="80px" class="me-2">
                                <a class="brand-name me-4" href="/">ToysShop</a>
                            </div>
                        </div>
                        <div class="rd-navbar-nav-wrap">
                            <ul class="rd-navbar-nav">
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/front/notice/list">活動公告</a></li>
                                <li class="rd-nav-item"><a class="rd-nav-link"
                                        href="/front/product/productAllList">商品專區</a></li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/front/player/playerInfo">玩家專區</a>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/front/player/recharge">儲值專區</a>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/front/cart/list">購物車</a></li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/admin/login"
                                        style="color:rgb(26, 189, 118);">後臺專區</a></li>
                            </ul>
                        </div>
                        <!-- 註冊/登入或使用者區域 -->
                        <div class="d-flex bd-highlight">
                            <!-- 根據是否登入來顯示不同內容 -->
                            @if (session('playerId'))
                                <!-- 已登入時顯示 -->
                                <div class="dropdown user-dropdown ms-5" id="player-dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="playerDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ session('nickName', 'XX玩家') }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="playerDropdown">
                                        <!-- 顯示玩家的點數 -->
                                        <li class="dropdown-item">點數：<span id="user-points">{{ session('point') ?? 0 }}
                                                點</span></li>
                                        <li><a class="dropdown-item" href="/front/logout">登出</a></li>
                                    </ul>
                                </div>
                            @else
                                <!-- 未登入時顯示 -->
                                <div class="p-2 bd-highlight ms-5" id="auth-buttons">
                                    <a class="btn btn-primary" href="/front/register">註冊</a>
                                </div>
                                <div class="p-2 bd-highlight ms-1" id="auth-buttons">
                                    <a class="btn btn-primary" href="/front/login">登入</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div class="main-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="/front/js/core.min.js"></script>
    <script src="/front/js/script.js"></script>
</body>

</html>
