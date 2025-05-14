@extends('front.layout')
@section('content')
    <!-- Swiper-->
    <div class="swiper-container swiper-slider" data-swiper='{"simulateTouch":"false","direction":"vertical"}'>
        <div class="swiper-wrapper">
            <div class="swiper-slide" data-slide-bg="front/images/side01.png"></div>
            <div class="swiper-slide" data-slide-bg="front/images/side02.jpg"></div>
            <div class="swiper-slide" data-slide-bg="front/images/side03.png"></div>
            <div class="swiper-slide" data-slide-bg="front/images/side04.jpg"></div>
            <div class="swiper-slide" data-slide-bg="front/images/side05.jpg"></div>
            <div class="swiper-slide" data-slide-bg="front/images/side06.jpg"></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <section class="section-top-50 section-sm-top-66">
        <div class="container">
            <div class="row row-20 justify-content-md-between">
                <div class="col-sm-12 col-lg-3">
                    <h1 class="text-center text-lg-start">最新強打商品</h1>
                </div>
                <div class="col-md-6 d-flex">
                    <blockquote class="quote-1 align-middle text-start">
                        <p>
                            <q class="text-base fst-italic">We have the latest and diversified products to choose from.</q>
                        </p>
                    </blockquote>
                </div>
                <div class="col-md-6 col-lg-3 text-center text-md-end d-lg-flex justify-right-md"><a
                        class="btn btn-sm btn-primary-variant-1 align-middle-md"
                        href="/front/product/productAllList">馬上進入商品區</a>
                </div>
            </div>
        </div>
        <!-- PhotoSwipe-->
        <div class="row g-0 offset-md-top-64" data-lightgallery="group">
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/img01.png"><img width="480" height="351" src="front/images/img01.png"
                        alt=""></a>
            </div>
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/img02.png"><img width="480" height="351" src="front/images/img02.png"
                        alt=""></a>
            </div>
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/img03.png"><img width="480" height="351" src="front/images/img03.png"
                        alt=""></a>
            </div>
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/img04.png"><img width="480" height="351" src="front/images/img04.png"
                        alt=""></a>
            </div>
        </div>
    </section>

    <section class="section-top-50 section-sm-top-66">
        <div class="container">
            <div class="row row-20 justify-content-md-between">
                <div class="col-sm-12 col-lg-4">
                    <h1 class="text-center text-lg-start">一番賞玩法教學</h1>
                </div>
                <div class="col-md-8 d-flex">
                    <blockquote class="quote-1 align-middle text-start">
                        <p>
                            <q class="text-base fst-italic">Tutorial on how to play the Ichibanshou lottery.</q>
                        </p>
                    </blockquote>
                </div>

            </div>
        </div>
        <!-- PhotoSwipe-->
        <div class="row g-0 offset-md-top-64" data-lightgallery="group">
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/play-rule01.png"><img width="480" height="351"
                        src="front/images/play-rule01.png" alt=""></a>
            </div>
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/play-rule02.png"><img width="480" height="351"
                        src="front/images/play-rule02.png" alt=""></a>
            </div>
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/play-rule03.png"><img width="480" height="351"
                        src="front/images/play-rule03.png" alt=""></a>
            </div>
            <div class="col-sm-6 col-lg-3"><a class="thumbnail-gallery" data-lightgallery="item"
                    href="front/images/play-rule04.png"><img width="480" height="351"
                        src="front/images/play-rule04.png" alt=""></a>
            </div>
        </div>
    </section>

    <section class="text-center text-md-start section-50 section-sm-125 section-sm-bottom-125 bg-lighter">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="img-wrap-3"><img src="front/images/gw.png" width="100%"></div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <h1 class="text-center">聯絡我們</h1>
                    <p class="text-center">需要幫忙?我們很樂意協助您!</p>
                    <!-- RD Mailform-->
                    <form method="post" action="/front/contact">
                        @csrf
                        <div class="floating-label-wrap">
                            <input class="form-input text-info" type="text" name="name" id="contact-name"
                                placeholder=" " required>
                            <label class="form-label" for="contact-name">姓名</label>
                        </div>
                        <div class="floating-label-wrap">
                            <input class="form-input text-info" type="text" name="phone" id="contact-phone"
                                placeholder=" " pattern="09\d{8}" required>
                            <label class="form-label" for="contact-phone">電話號碼</label>
                            <div class="text-danger" id="telephoneError"></div>
                        </div>
                        <div class="floating-label-wrap">
                            <input class="form-input text-info" type="text" name="email" id="contact-email"
                                placeholder=" " required>
                            <label class="form-label" for="contact-email">電子信箱</label>
                            <div class="text-danger" id="emailError"></div>
                        </div>
                        <div class="floating-label-wrap">
                            <textarea class="form-input text-info" name="message" id="contact-message" placeholder=" " required></textarea>
                            <label class="form-label" for="contact-message">給我們的話</label>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary-variant-1 btn-sm btn-min-width-lg offset-top-20"
                                id="registerButton" type="submit">送出</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="page-foot">
        <section class="copyright bg-darkest">
            <div class="container">
                <div class="row row-10 justify-content-md-between align-items-md-center">
                    <div class="col-md-6 col-lg-4 text-md-start">
                        <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span>
                            <span>ToysShop 一番賞玩具商城</span></a>
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-6 text-md-end"><span class="text-white fst-italic">Follow Us:</span>
                        <ul class="list-inline">
                            <li><a class="icon icon-circle icon-foot fa-facebook" href="#"></a></li>
                            <li><a class="icon icon-circle icon-foot fa-twitter" href="#"></a></li>
                            <li><a class="icon icon-circle icon-foot fa-google-plus" href="#"></a></li>
                            <li><a class="icon icon-circle icon-foot fa-instagram" href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    </div>
    <script>
        // 手機號碼、電子郵件驗證規則
        const telephoneRegex = /^09\d{8}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // 元素取得
        const telephoneField = document.getElementById('contact-phone');
        const emailField = document.getElementById('contact-email');
        const registerButton = document.getElementById('registerButton'); // 確保對應 HTML 中按鈕
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
        validateField(telephoneField, telephoneRegex, telephoneError, '手機號碼格式錯誤，需為10碼並以09開頭。');
        validateField(emailField, emailRegex, emailError, '電子郵件格式不正確。');
    </script>
@endsection
