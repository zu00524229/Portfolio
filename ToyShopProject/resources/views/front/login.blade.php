@extends("front.layout")
@section("title", "玩家登入")
@section("content")
@if(session('playerId'))
    <!-- 顯示已登入的內容，或直接重定向 -->
    <script>
        window.location.href = "/"; // 已登入，重定向到首頁
    </script>
@endif
<!-- 內容區域 -->
<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 15px;">
    <h3 class="text-center mb-4 text-primary fw-bold">@yield("title")</h3>
    <form action="postLogin" method="POST">
      @csrf
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="account" placeholder="請輸入帳號" required name="account">
        <label for="account">帳號</label>
      </div>
      <div class="form-floating mb-3 position-relative">
        <input type="password" class="form-control password" id="password" placeholder="請輸入密碼" required name="password">
        <label for="password">密碼</label>
        <small class="text-muted">請輸入包含英文及數字的8-16字元</small>
        <span class="toggle position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
          <i class="bi bi-eye-slash"></i>
        </span>
      </div>
      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-primary btn-lg">登入</button>
      </div>
      <div class="text-center mt-4">
        <p class="mb-0">沒有帳號嗎？ <a href="/front/register" class="text-primary fw-bold">立即註冊</a></p>
      </div>
      <div class="text-center mt-2">
        <p class="mb-0">忘記密碼嗎？ <a href="/front/forget" class="text-primary fw-bold">更改密碼</a></p>
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