@extends('front.layout')
@section('title', '會員專區')
@section('content')
    <main class="main">


        <section class="section-top-50 section-sm-top-100">
            <div class="container mt-5" style="max-width: 600px;">
                <h2 class="fw-bold text-primary text-center mb-4">@yield('title')</h2>

                <div class="bg-dark text-white p-4 rounded-4 shadow-sm">
                    <h4 class="fw-bold text-white text-center mb-4">玩家個人資訊</h4>

                    <table class="table table-borderless text-white mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-bold w-50">姓名</td>
                                <td>{{ $player->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">暱稱</td>
                                <td>{{ $player->nickName }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">帳號</td>
                                <td>{{ $player->account }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">手機</td>
                                <td>{{ $player->telephone }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">住址</td>
                                <td>{{ $player->address ?? '未填寫' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">性別</td>
                                <td>
                                    @if ($player->gender == 0)
                                        男
                                    @elseif ($player->gender == 1)
                                        女
                                    @else
                                        未指定
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">信箱</td>
                                <td>{{ $player->email }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">生日</td>
                                <td>{{ $player->birthdate }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">建立時間</td>
                                <td>{{ $player->createTime }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-4">
                        <a href="{{ route('front.player.edit') }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-square me-1"></i> 修改資料
                        </a>
                    </div>
                </div>
            </div>
        </section>



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
                        <li><a href="news-details.html"><i class="bi bi-linkedin"></i></a></li>
                        <li><a href="event-details.html">Gmail</a></li>
                        <li><a href="privacy.html"><i class="bi bi-instagram"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© 2025 <strong class="px-1 sitename">SoulFlow</strong> 版權所有</p>
            <div class="credits">
                改版設計 by LuLu謙｜原始模板來自 <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>
    </div>
@endsection
