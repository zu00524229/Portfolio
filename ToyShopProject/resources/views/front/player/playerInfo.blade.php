@extends("front.layout")
@section("title", "玩家個人專區")
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
            <!-- 玩家資料表 -->
            <div class="row" style="background-color: rgb(42, 42, 42); padding: 30px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);">
                <h3 class="text-white mb-4">玩家個人資訊</h3>
                <!-- 表格區域 -->
                <div class="col-md-6 mb-3">
                    <table class="table table-hover text-white text-center">
                        <thead>
                            <tr class="table-warning">
                                <th class="col-4">\</th>
                                <th class="col-8">個人資訊內容</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>玩家姓名</td>
                                <td>{{ $player->name }}</td>
                            </tr>
                            <tr>
                                <td>玩家暱稱</td>
                                <td>{{ $player->nickName }}</td>
                            </tr>
                            <tr>
                                <td>玩家帳號</td>
                                <td>{{ $player->account }}</td>
                            </tr>
                            <tr>
                                <td>點數</td>
                                <td>{{ $player->point ?? 0}} 點</td>
                            </tr>
                            <tr>
                                <td>創辦時間</td>
                                <td>{{ date('Y-m-d', strtotime($player->createTime)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-hover text-white text-center">
                        <thead>
                            <tr class="table-warning">
                                <th class="col-3">\</th>
                                <th class="col-9">個人資訊內容</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>手機</td>
                                <td>{{ $player->telephone }}</td>
                            </tr>
                            <tr>
                                <td>住址</td>
                                <td>{{ $player->address }}</td>
                            </tr>
                            <tr>
                                <td>性別</td>
                                <td>
                                    @if ($player->gender == 0)
                                    男
                                    @elseif ($player->gender == 1)
                                    女
                                    @else
                                    未指定
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>信箱</td>
                                <td>{{ $player->email }}</td>
                            </tr>
                            <tr>
                                <td>生日</td>
                                <td>{{ $player->birthdate }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12 mt-1 text-end">
                    <div class="col-md-12 mt-1 text-end">
                        <a href="/front/player/edit" class="btn btn-primary btn-sm">修改資料</a>
                    </div>
                </div>
            </div>

            <!-- 玩家儲值細項 -->
            <div class="row mb-4 mt-4" style="background-color: rgb(42, 42, 42); padding: 30px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);">
                <h3 class="text-white mb-4">玩家儲值資訊</h3>
                <div class="col-md-12 mb-3">
                    <table class="table table-hover text-white text-center">
                        <thead>
                            <tr class="table-danger">
                                <th class="col-2">儲值編號</th>
                                <th class="col-3">付款方式</th>
                                <th class="col-2">儲值點數</th>
                                <th class="col-3">儲值時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $paymentTypes = [1 => '信用卡付款', 2 => 'LINE Pay', 3 => '超商繳費'];
                            @endphp
                            @forelse($rechargeData as $data)
                            <tr>
                                <td>{{ $data->Id }}</td>
                                <td>{{ $paymentTypes[$data->paymentType] }}</td>
                                <td>{{ $data->point }}</td>
                                <td>{{ $data->createTime }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">目前沒有儲值資料。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- 分頁和點數資訊 -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            {{ $rechargeData->links() }}
                        </div>
                        <div class="text-end">
                            <p>目前剩餘點數 : <strong>{{ $player->point }}</strong> 點</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection