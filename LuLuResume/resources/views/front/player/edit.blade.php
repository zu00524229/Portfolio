@extends('front.layout')
@section('title', '會員專區')
@section('content')
    <main class="main">


        <section class="featured-programs section">
            <div class="container" style="max-width: 600px;">
                <h2 class="fw-bold text-primary text-center mb-4">@yield('title')</h2>

                <form action="{{ route('front.player.update') }}" method="POST">
                    @csrf

                    <!-- 姓名 -->
                    <div class="mb-3">
                        <label for="name" class="form-label">姓名</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $player->name) }}">
                    </div>

                    <!-- 暱稱 -->
                    <div class="mb-3">
                        <label for="nickName" class="form-label">暱稱</label>
                        <input type="text" name="nickName" class="form-control"
                            value="{{ old('nickName', $player->nickName) }}">
                    </div>

                    <!-- 電話 -->
                    <div class="mb-3">
                        <label for="telephone" class="form-label">手機</label>
                        <input type="text" name="telephone" class="form-control"
                            value="{{ old('telephone', $player->telephone) }}">
                    </div>

                    <!-- 信箱 -->
                    <div class="mb-3">
                        <label for="email" class="form-label">信箱</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $player->email) }}">
                    </div>

                    <!-- 性別 -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">性別</label>
                        <select name="gender" class="form-select">
                            <option value="">請選擇</option>
                            <option value="0" {{ old('gender', $player->gender) == 0 ? 'selected' : '' }}>男</option>
                            <option value="1" {{ old('gender', $player->gender) == 1 ? 'selected' : '' }}>女</option>
                        </select>
                    </div>

                    <!-- 地址 -->
                    <div class="mb-3">
                        <label for="address" class="form-label">住址</label>
                        <input type="text" name="address" class="form-control"
                            value="{{ old('address', $player->address) }}">
                    </div>

                    <!-- 生日 -->
                    <div class="mb-3">
                        <label for="birthdate" class="form-label">生日</label>
                        <input type="date" name="birthdate" class="form-control"
                            value="{{ old('birthdate', $player->birthdate) }}">
                    </div>

                    <!-- 密碼（不改可不填） -->
                    <div class="mb-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" name="password" class="form-control" placeholder="若需修改請輸入新密碼">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">更新資料</button>
                    </div>
                </form>
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
