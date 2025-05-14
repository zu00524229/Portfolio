@extends('front.layout')
@section('title', '玩家登入')
@section('content')
    @if (session('playerId'))
        <!-- 顯示已登入的內容，或直接重定向 -->
        <script>
            window.location.href = "/"; // 已登入，重定向到首頁
        </script>
    @endif
    <!-- 內容區域 -->
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="muji-login-box" style="max-width: 450px; width: 100%; border-radius: 15px;">
            <h3 class="text-center mb-4 text-primary fw-bold">@yield('title')</h3>
            <form action="postLogin" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="account" class="form-label">帳號</label>
                    <input type="text" class="form-control" id="account" name="account" required
                        style="border-radius: 4px; border-color: #ccc;">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">密碼</label>
                    <input type="password" class="form-control" id="password" name="password" required
                        style="border-radius: 4px; border-color: #ccc;">
                    <small class="form-text text-muted">請輸入包含英文及數字的8-16字元</small>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn">登入</button>
                </div>
                <div class="text-center mt-4" style="color: #666;">
                    <p class="mb-0">沒有帳號嗎？ <a href="/front/register">立即註冊</a>
                    </p>
                </div>
                <div class="text-center mt-2" style="color: #666;">
                    <p class="mb-0">忘記密碼嗎？ <a href="/front/forget">更改密碼</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        const toggle = document.querySelector(".toggle"),
            input = document.querySelector(".password");
        toggle.addEventListener("click", () => {
            const icon = toggle.querySelector("i");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            } else {
                input.type = "password";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            }
        });
    </script>

@endsection
