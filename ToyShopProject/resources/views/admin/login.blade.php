<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/admin/css/loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-box box">
            <div class="image-container">
                <img src="../../../admin/images/logo.png">
            </div>
            <header>Login</header>
            <hr>
            <span class="title">賣家後臺系統 歡迎您~</span>
            <form action="/admin/postLogin" method="POST">
                @csrf <!-- CSRF 防護 -->
                <div class="form-box">
                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input class="input-field" type="text" placeholder="使用者帳號" name="account">
                    </div>

                    <div class="input-container">
                        <i class="fa fa-lock icon"></i>
                        <input class="input-field password" type="password" placeholder="使用者密碼" name="password">
                        <i class="fa fa-eye toggle icon"></i>
                    </div>

                    @if($errors->has('error'))
                    <div class="error">
                        {{ $errors->first('error') }}
                    </div>
                    @endif

                    <div>
                        <input type="submit" id="submit" value="Login" class="button btn btn-primary">
                    </div>
                </div>
                <div class="remember">
                    <span><a href="{{ route('admin.forget') }}"><i class="bi bi-bell-fill"></i>忘記密碼</a></span> &nbsp; || &nbsp;
                    <span><a href="{{ route('front.index') }}"><i class="bi bi-door-open-fill"></i>返回官網</a></span>
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

    @if (session('success'))
    <script>
        Swal.fire({
            title: '成功！',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: '確定'
        });
    </script>
    @endif
</body>

</html>