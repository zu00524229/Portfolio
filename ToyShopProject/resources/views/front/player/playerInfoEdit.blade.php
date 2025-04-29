@extends("front.layout")
@section("title", "玩家資料修改")
@section("content")
<!-- 註冊表單區域 -->
<section class="section-top-50 section-sm-top-100">
    <div class="container mt-5 mb-5" style="max-width: 600px; text-align: center;">
        <div class="container" style="max-width: 500px; width: 100%; border-radius: 15px;">
            <div class="row" style="background-color: rgb(250, 249, 249); padding: 30px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);">
                <h3 class="text-center mb-4 text-primary fw-bold">@yield("title")</h3>
                <form method="POST" action="/front/player/update" id="registrationForm">
                    @csrf <!-- Laravel CSRF 保護 -->

                    <!-- 玩家姓名輸入框 -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $player->name }}">
                        <label for="name">玩家姓名</label>
                    </div>

                    <!-- 玩家暱稱輸入框 -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nickName" name="nickName" value="{{ $player->nickName }}">
                        <label for="nickName">玩家暱稱</label>
                    </div>

                    <!-- 玩家帳號輸入框 -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="account" name="account" value="{{ $player->account }}">
                        <label for="account">玩家帳號</label>
                        @if (session('accountError'))
                        <div class="text-danger">{{ session('accountError') }}</div>
                        @endif
                    </div>

                    <!-- 玩家密碼輸入框 -->
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="請輸入玩家密碼">
                        <label for="password">玩家密碼</label>
                        <div class="text-danger" id="passwordError"></div>
                        <!-- 密碼顯示切換按鈕 -->
                        <span class="toggle position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </span>
                    </div>

                    <!-- 確認密碼輸入框 -->
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" placeholder="再次輸入密碼">
                        <label for="passwordConfirmation">確認密碼</label>
                        <div class="text-danger" id="passwordConfirmationError"></div>
                        <!-- 確認密碼顯示切換按鈕 -->
                        <span class="toggle position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="bi bi-eye-slash" id="togglePasswordConfirmation"></i>
                        </span>
                    </div>

                    <!-- 手機號碼輸入框 -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telephone" name="telephone" pattern="09\d{8}" value="{{ $player->telephone }}">
                        <label for="telephone">手機</label>
                        <div class="text-danger" id="telephoneError"></div>
                    </div>

                    <!-- 住址輸入框 -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address" name="address" value="{{ $player->address }}">
                        <label for="address">住址</label>
                    </div>

                    <!-- 性別選擇 -->
                    <div class="form-floating mb-3">
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="">請選擇性別</option>
                            <option value="0" {{ $player->gender == 0 ? 'selected' : '' }}>男</option>
                            <option value="1" {{ $player->gender == 1 ? 'selected' : '' }}>女</option>
                        </select>
                    </div>

                    <!-- 電子郵件輸入框 -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $player->email }}">
                        <label for="email">信箱</label>
                        <div class="text-danger" id="emailError"></div>
                    </div>

                    <!-- 生日輸入框 -->
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $player->birthdate }}">
                        <label for="birthdate">生日</label>
                    </div>

                    <!-- 同意條款 -->
                    <div class="form-check mb-4">
                        <input type="checkbox" id="terms" class="form-check-input">
                        <label for="terms" class="form-check-label">我已閱讀並同意 <a href="#">服務條款</a> 與 <a href="#">隱私權政策</a></label>
                    </div>

                    <!-- 註冊按鈕 -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" id="registerButton" disabled>修改</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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
    setupPasswordToggle('togglePassword', 'password');
    setupPasswordToggle('togglePasswordConfirmation', 'passwordConfirmation');

    // 密碼、手機號碼、電子郵件驗證規則
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,16}$/;
    const telephoneRegex = /^09\d{8}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // 元素取得
    const passwordField = document.getElementById('password');
    const passwordConfirmationField = document.getElementById('passwordConfirmation');
    const telephoneField = document.getElementById('telephone');
    const emailField = document.getElementById('email');
    const termsCheckbox = document.getElementById('terms');
    const registerButton = document.getElementById('registerButton'); // 確保對應 HTML 中按鈕

    const passwordError = document.getElementById('passwordError'); // 確保對應 HTML 中的錯誤容器
    const passwordConfirmationError = document.getElementById('passwordConfirmationError');
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
    validateField(passwordField, passwordRegex, passwordError, '密碼需包8-16個字符，並含至少一個字母和一個數字。');
    validateField(telephoneField, telephoneRegex, telephoneError, '手機號碼格式錯誤，需為10碼並以09開頭。');
    validateField(emailField, emailRegex, emailError, '電子郵件格式不正確。');

    // 確認密碼即時驗證
    if (passwordConfirmationField && passwordField && passwordConfirmationError) {
        passwordConfirmationField.addEventListener('input', () => {
            if (passwordConfirmationField.value !== passwordField.value) {
                passwordConfirmationError.textContent = '密碼不一致，請重新輸入。';
            } else {
                passwordConfirmationError.textContent = '';
            }
            updateRegisterButtonState();
        });
    }

    // 監聽 Checkbox
    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', updateRegisterButtonState);
    }

    // 更新按鈕狀態
    function updateRegisterButtonState() {
        if (
            termsCheckbox.checked &&
            !passwordError.textContent &&
            !telephoneError.textContent &&
            !emailError.textContent
        ) {
            registerButton.disabled = false;
        } else {
            registerButton.disabled = true;
        }
    }

    // 初始化按鈕狀態
    updateRegisterButtonState();
</script>
@endsection