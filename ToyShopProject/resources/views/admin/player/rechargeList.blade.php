@extends("admin.layout")
@section("title", "玩家儲值紀錄")
@section("content")
<link rel="stylesheet" href="/admin/css/lightbox.min.css">
<script src="/admin/js/lightbox.min.js"></script>
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-cash-coin me-2"></i> @yield("title")</h3>
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
            <div class="col-md-6"> <!-- 調整表格容器的寬度 -->
                <div>
                    <h5>列表資料總數: {{ $rechargeList->total() }} 筆</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                        <thead class="table-dark text-center">
                            <tr>
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
                            @forelse($rechargeList as $data)
                            <tr class="text-center">
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
                    <div class="text-center">
                        {{ $rechargeList->links() }}
                    </div>
                    <div class="text-center mt-3">
                        <p>
                            第 {{ $rechargeList->currentPage() }} 頁，共 {{ $rechargeList->lastPage() }} 頁，本頁顯示 {{ $rechargeList->count() }} 筆
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection