@extends("front.layout")
@section("title", "購物車")
@section("content")
<section class="section-top-50 section-sm-top-66" style="margin-top: 60px;">
    <div class="container mt-4 text-center">
        <h2 class="text-center fw-bold text-primary">@yield("title")</h2>

        <div class="container" style="margin-top: 30px; max-width: 100%;">
            <!-- 抽取獎項資訊 -->
            <div class="row mb-3" style="background-color: rgb(42, 42, 42); padding: 30px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);">
                <h3 class="text-white text-left mb-4">商品抽獎資訊</h3>
                <div class="col-md-12 mb-3">
                    <table class="table table-hover text-white text-center">
                        <thead>
                            <tr class="table-info">
                                <th class="col-1">抽獎編號</th>
                                <th class="col-1">商品圖片</th>
                                <th class="col-4">商品名稱</th>
                                <th class="col-3">獎項內容</th>
                                <th class="col-1">出貨天數</th>
                                <th class="col-2">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $data)
                            <tr>
                                <td>{{ $data->Id }}</td>
                                @if(!empty($data->awards->product->photo))
                                @php
                                $photos = explode(',', $data->awards->product->photo);
                                @endphp
                                <td>
                                    <img src="/admin/images/product/{{ $photos[0] }}" class="img" style="max-width: 120px; max-height: 80px; object-fit: cover; margin-right: 15px;">
                                </td>
                                @endif
                                <td class="mb-1 text-warning fw-bold">{{ $data->awards->product->name }}</td>
                                <td class="mb-1 text-white fw-bold">{{ $data->awards->level }} / {{ $data->awards->name }}</td>
                                <td class="mb-1 text-white fw-bold">{{ $data->awards->product->shippingDays }}</td>
                                <td>
                                    <button type="button" id="btn-{{ $data->Id }}" class="btn btn-primary btn-sm" onclick="addToCart('{{ $data->Id }}', '{{ $data->awards->product->name }}', '{{ $data->awards->name }}')">選擇出貨</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">目前沒有商品獎項資料。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 已選出貨區域 -->
            <div class="row mb-3 mt-4 mx-auto" id="cart-area" style="background-color: rgb(42, 42, 42); padding: 30px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25); display: none; max-width: 85%; text-align: center;">
                <h3 class="text-white text-left mb-4">已選擇商品</h3>
                <div class="col-md-12 mb-3">
                    <form action="/front/cart/shipping" method="POST">
                        @csrf
                        <table class="table table-hover text-white text-center">
                            <thead>
                                <tr class="table-warning">
                                    <th class="col-2">抽獎編號</th>
                                    <th class="col-4">商品名稱</th>
                                    <th class="col-4">獎項內容</th>
                                    <th class="col-2">操作</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
                                <!-- 已選擇商品會顯示在這裡 -->
                            </tbody>
                        </table>
                        <!-- 確認出貨按鈕 -->
                        <button type="submit" class="btn btn-success mt-1">確認出貨</button>
                    </form>
                </div>
            </div>
        </div>
</section>

<script>
    // 儲存選擇的商品
    let selectedItems = {};

    // 當按下「選擇出貨」按鈕時，將商品加入選擇清單
    function addToCart(lotteryId, productName, awardName) {
        const productKey = `${lotteryId}-${productName}-${awardName}`; // 使用抽獎編號作識別
        if (!selectedItems[productKey]) {
            selectedItems[productKey] = {
                lotteryId,
                productName,
                awardName
            }; // 新增商品
            updateCartDisplay();

            // 改變按鈕顏色並禁用
            const button = document.getElementById(`btn-${lotteryId}`);
            button.disabled = true;
            button.classList.add('btn-secondary');
            button.classList.remove('btn-primary');
            button.textContent = '已選擇';
        }
    }

    function updateCartDisplay() {
        const cartItemsList = document.querySelector('#cart-items');
        const cartArea = document.querySelector('#cart-area');
        cartItemsList.innerHTML = ''; // 清空現有商品清單

        if (Object.keys(selectedItems).length === 0) {
            // 如果沒有選擇商品，隱藏已選擇商品區域
            cartArea.style.display = 'none';
        } else {
            // 如果有選擇商品，顯示已選擇商品區域
            cartArea.style.display = 'block';

            // 迭代所有選擇的商品並更新顯示
            for (const productKey in selectedItems) {
                const {
                    lotteryId,
                    productName,
                    awardName
                } = selectedItems[productKey];

                const row = document.createElement('tr');

                // 抽獎編號
                const tdLotteryId = document.createElement('td');
                tdLotteryId.textContent = lotteryId;
                row.appendChild(tdLotteryId);

                // 商品名稱
                const tdProductName = document.createElement('td');
                tdProductName.textContent = productName;
                row.appendChild(tdProductName);

                // 獎項內容
                const tdAwardName = document.createElement('td');
                tdAwardName.textContent = awardName;
                row.appendChild(tdAwardName);

                // 操作：取消按鈕
                const tdAction = document.createElement('td');
                const cancelButton = document.createElement('button');
                cancelButton.style.padding = "0.2rem 0.7rem"; // 進一步縮小
                cancelButton.style.fontSize = "0.9rem";
                cancelButton.textContent = '取消';
                cancelButton.style.backgroundColor = 'rgb(239, 116, 116)';
                cancelButton.style.color = '#000000';
                cancelButton.classList.add('btn', 'btn-sm', 'ms-3');
                cancelButton.onclick = () => removeFromCart(productKey);
                tdAction.appendChild(cancelButton);
                row.appendChild(tdAction);

                // 新增隱藏輸入欄位
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'lotteryId[]';
                hiddenInput.value = lotteryId;
                row.appendChild(hiddenInput);

                cartItemsList.appendChild(row);
            }
        }
    }

    // 從購物車中移除商品
    function removeFromCart(productKey) {
        const {
            lotteryId
        } = selectedItems[productKey]; // 從 key 中取得抽獎編號
        delete selectedItems[productKey];
        updateCartDisplay();

        // 恢復商品的按鈕顏色並啟用
        const button = document.getElementById(`btn-${lotteryId}`);
        button.disabled = false;
        button.classList.add('btn-primary');
        button.classList.remove('btn-secondary');
        button.textContent = '選擇出貨';
    }
</script>
@endsection