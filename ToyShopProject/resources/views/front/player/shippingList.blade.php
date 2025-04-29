@extends("front.layout")
@section("title", "玩家出貨資訊")
@section("content")
<!-- 主內容區域 -->
<section class="section-top-50 section-sm-top-100">
    <div class="container mt-5" style="max-width: 800px; text-align: left;">
        <h2 class="fw-bold text-primary">@yield("title")</h2>

        <!-- 三個選項區域，水平排列並增加間距 -->
        <div class="row mt-4">
            <div class="col-md-4 mb-2"><a href="/front/player/playerInfo" class="btn btn-info w-100 btn-sm">玩家資訊</a></div>
            <div class="col-md-4 mb-2"><a href="/front/player/recharge" class="btn btn-info w-100 btn-sm">儲值專區</a></div>
            <div class="col-md-4 mb-2"><a href="/front/player/shippingList" class="btn btn-info w-100 btn-sm">玩家出貨資訊</a></div>
        </div>

        <div class="container" style="margin-top: 30px; max-width: 100%;">
            <!-- 玩家出貨資訊 -->
            <div class="row mb-4 mt-4" style="background-color: rgb(42, 42, 42); padding: 30px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);">
                <h3 class="text-white mb-4">商品出貨紀錄</h3>
                <div class="col-md-12 mb-3">
                    <table class="table table-hover text-white text-center">
                        <thead>
                            <tr class="table-success">
                                <th class="col-1">編號</th>
                                <th class="col-5">商品內容</th>
                                <th class="col-2">到貨日期</th>
                                <th class="col-4">到貨地址</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shippingResults as $data)
                            <tr>
                                <td>{{ $data['shipping']->Id }}</td>
                                <td>
                                    @foreach($data['lotteryResults'] as $lotteryResult)
                                    <span class="text-secondary">{{ $lotteryResult->awards->product->name }}</span><br>
                                    <strong class="text-danger fs-5">{{ $lotteryResult->awards->level }}</strong> /
                                    <strong class="text-primary fs-6">{{ $lotteryResult->awards->name }}</strong><br>
                                    @endforeach
                                </td>
                                <td>{{ $data['shipping']->arrivalDate }}</td>
                                <td>{{ $data['shipping']->player->address }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">目前沒有商品出貨資料。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- 分頁和點數資訊 -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            {{ $shippingData->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection