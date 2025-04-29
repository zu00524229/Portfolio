@extends("admin.layout")
@section("title", "玩家出貨紀錄")
@section("content")
<link rel="stylesheet" href="/admin/css/lightbox.min.css">
<script src="/admin/js/lightbox.min.js"></script>
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-truck me-2"></i> @yield("title")</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="/admin/player/playerList" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> 返回列表
                </a>
            </div>
        </div>
    </div>
</div><br>

<!-- Table 區塊 -->
<div class="app-content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- 調整表格容器的寬度 -->
                <div>
                    <h5>列表資料總數: {{ $shippingList->total() }} 筆</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                        <thead class="table-dark text-center">
                            <tr>
                                <th>出貨編號</th>
                                <th>商品內容</th>
                                <th>出貨時間</th>
                                <th>到貨時間</th>
                                <th>到貨地址</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shippingResults as $data)
                            <tr class="text-center">
                                <td>{{ $data['shipping']->Id }}</td>
                                <td>
                                    @foreach($data['lotteryResults'] as $lotteryResult)
                                    <span class="text-secondary">{{ $lotteryResult->awards->product->name }}</span><br>
                                    <strong class="text-danger fs-5">{{ $lotteryResult->awards->level }}</strong> /
                                    <strong class="text-primary fs-6">{{ $lotteryResult->awards->name }}</strong><br>
                                    @endforeach
                                </td>
                                <td>{{ date('Y-m-d', strtotime($data['shipping']->createTime)) }}</td>
                                <td>{{ $data['shipping']->arrivalDate }}</td>
                                <td>{{ $data['shipping']->player->address }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">目前沒有玩家出貨資料。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $shippingList->links() }}
                    </div>
                    <div class="text-center mt-3">
                        <p>
                            第 {{ $shippingList->currentPage() }} 頁，共 {{ $shippingList->lastPage() }} 頁，本頁顯示 {{ $shippingList->count() }} 筆
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection