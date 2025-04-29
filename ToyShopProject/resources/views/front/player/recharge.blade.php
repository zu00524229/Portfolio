@extends("front.layout")
@section("title", "儲值專區")
@section("content")
<section class="section-top-50 section-sm-top-100">
    <div class="container mt-5" style="max-width: 800px; text-align: left;">
        <h2 class="fw-bold text-primary">@yield("title")</h2>

        <!-- 三個選項區域，水平排列並增加間距 -->
        <div class="row mt-4">
            <div class="col-md-4 mb-2"><a href="/front/player/playerInfo" class="btn btn-info w-100 btn-sm">玩家資訊</a></div>
            <div class="col-md-4 mb-2"><a href="/front/player/recharge" class="btn btn-info w-100 btn-sm">儲值專區</a></div>
            <div class="col-md-4 mb-2"><a href="/front/player/shippingList" class="btn btn-info w-100 btn-sm">玩家出貨資訊</a></div>
        </div>

        <!-- 步驟一：選擇代幣數量 -->
        <div class="step-one mt-5">
            <h3>步驟一 : 選擇代幣數量</h3>
            <p class="mt-2">一元台幣可購買代幣一點</p>
            <div class="row mt-3">
                @foreach([100, 200, 300, 500, 1000, 2000, 3000, 4000, 5000, 10000, 20000, 30000] as $point)
                <div class="col-md-4 col-lg-3 mb-4">
                    <!-- 調整每個按鈕的寬度，可以依照 col-md, col-lg 控制-->
                    <button class="btn btn-outline-primary w-100 token-btn" data-point="{{ $point }}" value="{{ $point }}">
                        {{ $point }} 代幣
                    </button>
                </div>
                @endforeach
            </div>
            <p class="mt-2">應付金額：<span id="totalPoint">0</span> 元</p>
        </div>

        <!-- 步驟二：選擇付款方式 -->
        <div class="step-two mt-5">
            <h3>步驟二 : 選擇付款方式</h3>
            <div class="row mt-3">
                <div class="col-md-4 mb-2">
                    <button class="btn btn-info w-100 btn-sm" name="paymentType" value="1">信用卡付款</button>
                </div>
                <div class="col-md-4 mb-2">
                    <button class="btn btn-success w-100 btn-sm" name="paymentType" value="2">LINE Pay</button>
                </div>
                <div class="col-md-4 mb-2">
                    <button class="btn btn-warning w-100 btn-sm" name="paymentType" value="3">超商繳費</button>
                </div>
            </div>
            <p class="mt-4">付款方式：<span id="paymentType"></span> </p>
        </div>

        <!-- 注意事項 -->
        <div class="notice mt-5">
            <p class="text-muted">注意事項：</p>
            <ul class="text-muted">
                <li>本服務由第三方支付夥伴提供，點擊選項將導至第三方金流系統完成付款交易。</li>
                <li>代幣僅供本網站會員購物之用。</li>
                <li>購買時如有相關問題，請聯繫客服。</li>
                <li>購買代幣所產生每筆服務費由消費者支付。</li>
            </ul>
        </div>

        <!-- 確認付款按鈕 -->
        <div class="mt-5 mb-5 text-center">
            <form method="POST" action="postrecharge">
                @csrf
                <input type="hidden" name="point" id="pointInput">
                <input type="hidden" name="paymentType" id="paymentTypeInput">

                <div class="mt-5 mb-5 text-center">
                    <button type="submit" class="btn btn-primary w-50">確認付款</button>
                </div>
            </form>
        </div>
</section>
<script>
    // 當選擇代幣數量時
    document.querySelectorAll('.token-btn').forEach(button => {
        button.addEventListener('click', function() {
            const point = this.getAttribute('data-point');
            document.getElementById('totalPoint').textContent = point;
            document.getElementById('pointInput').value = point; // 設置隱藏欄位的值
        });
    });

    // 當選擇付款方式時
    document.querySelectorAll('button[name="paymentType"]').forEach(button => {
        button.addEventListener('click', function() {
            const paymentType = this.value;
            let paymentTypeName = '';

            // 根據 value 顯示對應的付款方式名稱
            switch (paymentType) {
                case '1':
                    paymentTypeName = '信用卡付款';
                    break;
                case '2':
                    paymentTypeName = 'LINE Pay';
                    break;
                case '3':
                    paymentTypeName = '超商繳費';
                    break;
            }

            document.getElementById('paymentType').textContent = paymentTypeName;
            document.getElementById('paymentTypeInput').value = paymentType; // 設置隱藏欄位的值
        });
    });
</script>
@endsection