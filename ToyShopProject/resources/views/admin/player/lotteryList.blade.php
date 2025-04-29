@extends("admin.layout")
@section("title", "玩家抽獎紀錄")
@section("content")
<link rel="stylesheet" href="/admin/css/lightbox.min.css">
<script src="/admin/js/lightbox.min.js"></script>
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-award me-2"></i> @yield("title")</h3>
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
                    <h5>列表資料總數: {{ $lotteryList->total() }} 筆</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                        <thead class="table-dark text-center">
                            <tr>
                                <th class="col-1">抽獎編號</th>
                                <th class="col-4">商品名稱</th>
                                <th class="col-3">獎項內容</th>
                                <th class="col-1">出貨天數</th>
                                <th class="col-1">是否出貨</th>
                                <th class="col-2">抽獎時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lotteryList as $data)
                            <tr class="text-center">
                                <td>{{ $data->Id }}</td>
                                <td>{{ $data->awards->product->name }}</td>
                                <td>{{ $data->awards->level }} / {{ $data->awards->name }}</td>
                                <td>{{ $data->awards->product->shippingDays }}</td>
                                <td>
                                    @if ($data->enableShip == 0)
                                    <strong class="text-danger">未出貨</strong>
                                    @elseif ($data->enableShip == 1)
                                    <strong class="text-success">已出貨</strong>
                                    @else
                                    狀態未知
                                    @endif
                                </td>
                                <td>{{ $data->createTime }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">目前沒有商品獎項資料。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $lotteryList->links() }}
                    </div>
                    <div class="text-center mt-3">
                        <p>
                            第 {{ $lotteryList->currentPage() }} 頁，共 {{ $lotteryList->lastPage() }} 頁，本頁顯示 {{ $lotteryList->count() }} 筆
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection