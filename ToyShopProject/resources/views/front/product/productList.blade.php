@extends("front.layout")
@section("content")
@if(session('lotteryResults'))
<div id="lotteryResults" data-results="{{ json_encode(session('lotteryResults')) }}"></div>
@endif
<!-- 主內容區域 -->
<section class="section-top-50 section-sm-top-100">
    <div class="container mt-5" style="max-width: 1500px; text-align: left;">
        <!-- 主內容區域 -->
        <div class="container" style="max-width: 100%;">
            <div class="row mb-5">
                <div class="container pt-5">
                    <div class="row">
                        <!-- 商品圖片區 -->
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 rounded-3">
                                @if(!empty($products->photo))
                                @php
                                $photos = explode(',', $products->photo); // 將圖片陣列拆解
                                @endphp

                                <!-- 大圖顯示區 -->
                                <div id="mainImage" style="overflow: hidden; position: relative; height: 560px;">
                                    <img src="/admin/images/product/{{ $photos[0] }}" class="card-img-top img-fluid" alt="{{ $products->name }}" style="height: 560px;">
                                </div>

                                <!-- 縮圖選擇區 -->
                                <div id="thumbnails" class="thumbnails" style="display: flex; justify-content: center; gap: 10px;">
                                    @foreach($photos as $index => $photo)
                                    <img src="/admin/images/product/{{ $photo }}"
                                        style="width: 80px; height: 60px; cursor: pointer; border: 2px solid #ccc; transition: border 0.2s ease-in-out;"
                                        data-large-src="/admin/images/product/{{ $photo }}">
                                    @endforeach
                                </div>
                                @else
                                <!-- 如果沒有圖片，顯示預設圖或提示 -->
                                <img src="/path/to/default-image.jpg" class="card-img-top img-fluid"
                                    alt="No image available" style="width: 100%; height: auto;">
                                <p class="image-count" style="font-size: 12px; color: #666; margin: 0;">目前沒有圖片</p>
                                @endif
                            </div>
                        </div>

                        <!-- 商品資訊區 -->
                        <div class="col-md-6">
                            <div style="text-align: left; height: 550px; overflow-y: auto;">
                                <!-- 顯示商品名稱 -->
                                <div>
                                    <h2 class="text-white p-2">{{ $products->name }}</h2>
                                </div>

                                <!-- 顯示商品點數與運送天數 -->
                                <div>
                                    <div class="card-text fs-3 mt-4 d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-currency-dollar text-warning fs-1"></i>
                                            點數: <strong class="text-danger">{{ $products->point }}</strong> 點
                                        </div>
                                        <div>
                                            <button class="btn btn-danger"><i class="bi bi-cart-check-fill fs-4"></i> 出貨天數 : {{ $products->shippingDays }} 天</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- 顯示商品獎項內容 -->
                                <div class="mt-4">
                                    <table class="table table-striped table-gifts mt-3 text-center">
                                        <thead class="bg-warning text-dark">
                                            <tr>
                                                <th class="col-3">獎項</th>
                                                <th class="col-5">獎項名稱</th>
                                                <th class="col-4">剩餘 / 總數</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-light text-dark">
                                            @forelse($award as $data)
                                            <tr class="{{ $data->stock == 0 ? 'text-muted text-decoration-line-through' : '' }}">
                                                <td>{{ $data->level }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->stock }} / {{ $data->totalCount }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center">目前沒有資料</td>
                                            </tr>
                                            @endforelse
                                            <tr style="background-color:rgb(248, 238, 147);">
                                                <td colspan="2"><strong>合計</strong></td>
                                                <td><strong>{{ $totalStock }} / {{ $totalCount }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 抽獎按鈕 -->
                            <div class="mt-1">
                                <div class="text-center d-flex justify-content-center align-items-center">
                                    <form action="/front/product/lottery" method="POST">
                                        @csrf
                                        <input type="hidden" name="productId" value="{{ $products->Id }}">
                                        <label class="text-white fs-5 me-3">抽獎次數 : </label>
                                        <input type="number" class="form-control" name="number" value="1" min="1" max="100">&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-success btn-lg">開始抽獎</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 顯示商品說明+注意事項內容 -->
        <div class="container" style="max-width: 70%; margin: 0 auto;">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="mt-4">
                        <h3 class="text-primary fs-3">商品介紹</h3>
                        <hr style="width: 100%;">
                        <p class="text-muted fs-6">{!! nl2br(e($products->content)) !!}</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mt-5">
                        <h3 class="text-primary fs-3">購買前請閱讀</h3>
                        <hr style="width: 100%;">
                        <img src="/front/images/shoppingnotice.png" alt="購買注意事項" style="width: 100%;">
                        <p class="text-muted fs-6">
                            <strong>★【消費方式】</strong><br />
                            一番賞：購買代幣>抽賞>申請出貨>等待收貨。<br />
                            預購商品：無需購買代幣即可消費。<br />
                            <br />
                            <strong>★【商品主題】</strong><br />
                            「爽抽樂」商品標體IP為強調部分大賞主題、其餘賞品可能為非主題IP出貨，購買前請注意。<br />
                            <br />
                            <strong>★【購買數量】</strong><br />
                            單抽/多抽(最多10樣)/包套購買<br />
                            <br />
                            <strong>★【購物車】</strong><br />
                            (1) 購物車上限為20件。<br />
                            (2) 抽選中購物車滿了，立即使用『清車』按鈕快速出貨。<br />
                            <br />
                            <strong>★【抽賞提示】</strong><br />
                            抽賞過程中，請"不要"進行以下操作<br />
                            (1) 同一帳號跨裝置/跨網頁購買<br />
                            (2) 跳轉頁面後直接按下上一頁返回原抽獎頁<br />
                            (3) 頻繁切換/返回抽選頁面<br />
                            以上可能導致秒數顯示不正確，需重新刷新頁面<br />
                            <br />
                            <strong>★【購物出車】</strong>每店家為獨立購物車不跨店，購物車滿20件即無法繼續購買。<br />
                            <strong>★【免運門檻】</strong>每個購物車皆獨立計算運費，抽選金額(不包含運費金額)達店家設定的免運門檻即享運費。<br />
                            <strong>★【合併訂單】</strong>有合併訂單需求，請先私訊客服，若有商品體積問題或廠商已寄出時等狀況，則無法合併訂單，敬請留意。<br />
                            <strong>★【包套購買】</strong>請確認購物車數量為19件以下(含19件)/代幣是否足夠。<br />
                            <strong>★【雙重中獎】</strong>無二次中獎且不附籤紙<br />
                            <strong>★【商品版本】</strong>依合作店家供貨來源有不同版本，有疑慮請於購買前詢問。<br />
                            <strong>★【商品量產】</strong>玩具為大量生產製造，全新商品不保證無原廠瑕疵，因運送過程有可能造成盒況損傷自行承擔風險<br />
                            <strong>★【出貨規定】</strong>超商規定單邊長度不能超過40cm，易碎物品無法寄送、皆使用宅配服務。<br />
                            <strong>★【出貨地址】</strong>出貨前請務必確認為真實姓名且各項資訊正確以利物流配送，若因個人填寫錯誤導致無法正常配送，買家需自行負擔二次運費。<br />
                            <strong>★【盒況說明】</strong>商品在日方原廠出品、運送及海關檢驗時可能有盒損、原廠二次膠拆檢等狀況。若您對於盒況有相當高的要求，建議您不要購買。<br />
                            <strong>★【全新未拆】</strong>全新未拆為商品本身未拆封過，不包含宣紙、運輸箱...等商品附加包材，若您對於運輸包材有特別要求，建議您不要購買。<br />
                            <strong>★【商品開箱】</strong>收到商品請全程錄影開箱，影片需完整揭露其過程、不可零碎片段，若有問題請於三日內回報。<br />
                            <strong>★【退貨換貨】</strong>一番賞為機率性商品，一經抽選知悉抽獎結果即視同拆封，除有瑕疵情形外，不得退換貨。<br />
                            <strong>★【金流事項】</strong>因應政府金融法規限制，短時間內頻繁刷卡可能視為風險帳戶而暫停刷卡功能，建議您一次購買足夠代幣。<br />
                            <strong>★【客服服務】</strong>每週一至五 09:00 ~ 18:00<br />
                            <br />
                            ※※※可接受上述條文者再購買。<br />
                            ※※※維肯娛樂股份有限公司保留對平台活動、商品及相關規定條款終止、變更、修改之權利，變更事項將於ToysShop線上商城官網說明。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer text-center mt-4 mb-5">
        <p class="text-muted">更多資訊請關注我們的官方網站和社交媒體。</p> <!-- 底部資訊，淡化文字 -->
        <a href="/front/product/productAllList" class="btn btn-outline-primary">返回商品專區首頁</a> <!-- 主要按鈕樣式 -->
    </div>
</section>

<!-- 控制圖片顯示與點選播放腳本 -->
<script>
    const mainImage = document.querySelector("#mainImage img"); // 大圖
    const thumbnails = document.querySelectorAll("#thumbnails img"); // 所有縮圖

    // 預設：高亮第一張縮圖
    if (thumbnails.length > 0) {
        thumbnails[0].style.border = "2px solid #f00"; // 設定第一張縮圖紅框
    }

    // 點擊縮圖切換大圖與高亮
    thumbnails.forEach((thumbnail) => {
        thumbnail.addEventListener("click", () => {
            // 更新大圖連結
            mainImage.src = thumbnail.dataset.largeSrc;

            // 清除其他縮圖高亮
            thumbnails.forEach(img => img.style.border = "2px solid #ccc");

            // 添加高亮到當前縮圖
            thumbnail.style.border = "2px solid #f00";
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        let lotteryResults = JSON.parse(document.getElementById('lotteryResults').getAttribute('data-results'));

        let resultHtml = '<ul>';
        lotteryResults.forEach(result => {
            resultHtml += `<li> <strong class="text-danger fs-4">${result.level}</strong> &nbsp;&nbsp; ${result.name}</li>`;
        });
        resultHtml += '</ul>';

        Swal.fire({
            icon: "success",
            title: "抽獎結果",
            html: resultHtml,
            draggable: true,
        });
    });
</script>
@endsection