@extends("front.layout")
@section("title", "重設密碼")
@section("content")
<!-- 主內容區域 -->
<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 15px;">
    <h3 class="text-center mb-4 text-primary fw-bold">@yield("title")</h3>
    <!-- 重設密碼表單 -->
    <form method="POST" action="postForget">
      @csrf
      <!-- 帳號輸入框 -->
      <div class="form-floating mb-3 position-relative">
        <input type="text" class="form-control" name="account" placeholder="請輸入帳號" required>
        <label for="account">帳號</label>
      </div>
      <!-- 新密碼輸入框 -->
      <div class="form-floating mb-3 position-relative">
        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="請輸入新密碼" required>
        <label for="newPassword">新密碼</label>
        <span class="toggle position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
          <i class="bi bi-eye-slash"></i>
        </span>
        <div class="text-danger" id="newPasswordError"></div>
      </div>
      <!-- 確認密碼輸入框 -->
      <div class="form-floating mb-4 position-relative">
        <input type="password" class="form-control" name="reNewPassword" id="reNewPassword" placeholder="請再次輸入新密碼" required>
        <label for="reNewPassword">確認新密碼</label>
        <span class="toggle position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
          <i class="bi bi-eye-slash"></i>
        </span>
        <div class="text-danger" id="reNewPasswordError"></div>
      </div>
      <div class="d-grid mt-5">
        <button type="submit" class="btn btn-primary btn-lg" id="resetButton" disabled>重設密碼</button>
      </div>
      <div class="text-center mt-3"><a href="login" class="small">返回登入頁面</a></div>
    </form>
  </div>
</div>

<script>
  // 密碼顯示/隱藏功能
  function setupPasswordToggle(toggleId, fieldId) {
    const toggle = document.getElementById(toggleId);
    const field = document.getElementById(fieldId);

    if (toggle && field) {
      toggle.addEventListener('click', function() {
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
      });
    }
  }

  // 初始化密碼顯示切換
  setupPasswordToggle('toggleNewPassword', 'newPassword');
  setupPasswordToggle('toggleReNewPassword', 'reNewPassword');

  // 密碼格式驗證規則
  const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,16}$/;

  // 元素取得
  const newPasswordField = document.getElementById('newPassword');
  const reNewPasswordField = document.getElementById('reNewPassword');
  const resetButton = document.getElementById('resetButton'); // 確保對應 HTML 中按鈕

  const newPasswordError = document.getElementById('newPasswordError');
  const reNewPasswordError = document.getElementById('reNewPasswordError');

  // 即時驗證功能
  function validateField(field, regex, errorElement, errorMessage) {
    if (field && errorElement) {
      field.addEventListener('input', () => {
        if (!regex.test(field.value)) {
          errorElement.textContent = errorMessage;
        } else {
          errorElement.textContent = '';
        }
        updateResetButtonState();
      });
    }
  }

  // 驗證新密碼
  validateField(newPasswordField, passwordRegex, newPasswordError, '密碼需包8-16個字符，並含至少一個字母和一個數字。');

  // 驗證確認密碼
  if (reNewPasswordField && newPasswordField && reNewPasswordError) {
    reNewPasswordField.addEventListener('input', () => {
      if (reNewPasswordField.value !== newPasswordField.value) {
        reNewPasswordError.textContent = '密碼不一致，請重新輸入。';
      } else {
        reNewPasswordError.textContent = '';
      }
      updateResetButtonState();
    });
  }

  // 更新重設密碼按鈕狀態
  function updateResetButtonState() {
    if (
      !newPasswordError.textContent &&
      !reNewPasswordError.textContent &&
      newPasswordField.value !== '' &&
      reNewPasswordField.value !== ''
    ) {
      resetButton.disabled = false;
    } else {
      resetButton.disabled = true;
    }
  }

  // 初始化按鈕狀態
  updateResetButtonState();
</script>
@endsection