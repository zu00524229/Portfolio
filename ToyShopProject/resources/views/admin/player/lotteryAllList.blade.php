@extends("admin.layout")
@section("title", "抽獎紀錄")
@section("content")
<link rel="stylesheet" href="/admin/css/lightbox.min.css">
<script src="/admin/js/lightbox.min.js"></script>
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-list-check me-2 fs-2"></i>@yield("title")</h3>
            </div>
        </div>
    </div>
</div><br>

<!-- Table 區塊 -->
<div class="app-content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- 調整表格容器的寬度 -->
                <div class="d-flex justify-content-start align-items-center mb-5 mt-3">
                    <form id="searchForm" method="GET" action="/admin/player/lotteryAllList" class="d-flex">
                        <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 :</label>
                        <select class="form-select me-3" name="enableShip" style="width: 200px;">
                            <option value="">-- 選擇出貨狀態 --</option>
                            <option value="0" {{ request('enableShip') == '0' ? 'selected' : '' }}>未出貨</option>
                            <option value="1" {{ request('enableShip') == '1' ? 'selected' : '' }}>已出貨</option>
                        </select>
                        <button type="submit" class="btn btn-outline-success me-3">
                            <i class="bi bi-search me-2"></i>搜尋
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="resetButton">
                            <i class="bi bi-x-circle me-2"></i>取消
                        </button>
                    </form>
                </div>
                <div>
                    <h5>列表資料總數: {{ $lotteryList->total() }} 筆</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                        <thead class="table-dark text-center">
                            <tr>
                                <th>抽獎編號</th>
                                <th>玩家名字</th>
                                <th>玩家帳號</th>
                                <th>商品名稱</th>
                                <th>獎項內容</th>
                                <th>出貨天數</th>
                                <th>出貨狀態</th>
                                <th>抽獎時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lotteryList as $data)
                            <tr class="text-center">
                                <td>{{ $data->Id }}</td>
                                <td>{{ $data->player->name }}</td>
                                <td>{{ $data->player->account }}</td>
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
                        {{ $lotteryList->appends(request()->query())->links() }}
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
<script>
    document.getElementById('resetButton').addEventListener('click', function() {
        // 清空關鍵字欄位
        const form = document.getElementById('searchForm');
        form.enableShip.value = '';
        // 提交表單
        form.submit();
        // 重新導向到基礎網址
        window.location.href = '/admin/player/lotteryAllList';
    });
</script>
@endsection