@extends("admin.layout")
@section("title", "儲值紀錄")
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
            <div class="col-md-8"> <!-- 調整表格容器的寬度 -->
                <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
                    <!-- 關鍵字搜尋 -->
                    <form id="searchForm" action="/admin/player/rechargeAllList" method="GET" class="d-flex">
                        <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 : </label>
                        <input type="text" name="keyword" class="form-control me-4" style="width: 330px;" placeholder="輸入玩家關鍵字" value="{{ request('keyword') }}">
                        <button type="submit" class="btn btn-outline-success me-3"><i class="bi bi-search me-2"></i>搜尋</button>
                        <button type="button" class="btn btn-outline-secondary" id="resetButton"><i class="bi bi-x-circle me-2"></i>取消</button>
                    </form>
                </div>
                <div>
                    <h5>列表資料總數: {{ $list->total() }} 筆</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                        <thead class="table-dark text-center">
                            <tr>
                                <th class="col-2">儲值編號</th>
                                <th class="col-2">玩家名字</th>
                                <th class="col-2">玩家帳號</th>
                                <th class="col-2">付款方式</th>
                                <th class="col-2">儲值點數</th>
                                <th class="col-2">儲值時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $paymentTypes = [1 => '信用卡付款', 2 => 'LINE Pay', 3 => '超商繳費'];
                            @endphp
                            @forelse($list as $data)
                            <tr class="text-center">
                                <td>{{ $data->Id }}</td>
                                <td>{{ $data->player->name }}</td>
                                <td>{{ $data->player->account }}</td>
                                <td>{{ $paymentTypes[$data->paymentType] }}</td>
                                <td>{{ $data->point }}</td>
                                <td>{{ $data->createTime }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">目前沒有儲值資料。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $list->links() }}
                    </div>
                    <div class="text-center mt-3">
                        <p>
                            第 {{ $list->currentPage() }} 頁，共 {{ $list->lastPage() }} 頁，本頁顯示 {{ $list->count() }} 筆
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
        form.keyword.value = '';
        // 提交表單
        form.submit();
        // 重新導向到基礎網址
        window.location.href = '/admin/player/rechargeAllList';
    });
</script>
@endsection