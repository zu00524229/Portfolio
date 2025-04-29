<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForgetPassword</title>
    <link rel="stylesheet" href="/admin/css/loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-box box">
            <div class="image-container">
                <img src="../../../admin/images/A01-Photoroom.png">
            </div>
            <header>設定密碼</header>
            <hr>
            <form action="/admin/postForget" method="POST">
                @csrf <!-- CSRF 防護 -->
                <div class="form-box">
                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input class="input-field" type="text" placeholder="使用者帳號" name="account">
                    </div>
                    <div class="input-container">
                        <label for="">請輸入新密碼 : </label>
                    </div>
                    <div class="input-container">
                        <i class="fa fa-lock icon"></i>
                        <input class="input-field password" type="password" placeholder="新密碼" name="newPassword">
                        <i class="fa fa-eye toggle icon"></i>
                    </div>

                    <div class="input-container">
                        <label for="">再次輸入新密碼 : </label>
                    </div>
                    <div class="input-container">
                        <i class="fa fa-lock icon"></i>
                        <input class="input-field password" type="password" placeholder="再次輸入新密碼" name="reNewPassword">
                        <i class="fa fa-eye toggle icon"></i>
                    </div>

                    @if($errors->has('admin.forget'))
                    <div class="error">
                        {{ $errors->first('admin.forget') }}
                    </div>
                    @endif

                    <div>
                        <input type="submit" id="submit" value="確定" class="forgetbnt">
                        <input type="reset" id="reset" value="重置" class="forgetbnt">
                    </div>
                </div>
                <div class="remember">
                    <span><a href="{{ route('admin.login') }}"><i class="bi bi-door-open-fill"></i>返回登入頁</a></span>
                </div>
            </form>
        </div>
    </div>
    <script>
        const toggle = document.querySelector(".toggle"),
            input = document.querySelector(".password");
        toggle.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";
                toggle.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                input.type = "password";
            }
        })
    </script>
</body>

</html>