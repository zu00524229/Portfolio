@extends("admin.layout")
@section("title", "玩家相關資料")
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
            <div class="col-md-11"> <!-- 調整表格容器的寬度 -->
                <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
                    <!-- 關鍵字搜尋 -->
                    <form id="searchForm" action="/admin/player/playerList" method="GET" class="d-flex">
                        <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 : </label>
                        <input type="text" name="keyword" class="form-control me-4" style="width: 330px;" placeholder="輸入玩家關鍵字(姓名、暱稱、帳號...)" value="{{ request('keyword') }}">
                        <button type="submit" class="btn btn-outline-success me-3"><i class="bi bi-search me-2"></i>搜尋</button>
                        <button type="button" class="btn btn-outline-secondary" id="resetButton"><i class="bi bi-x-circle me-2"></i>取消</button>
                    </form>
                </div>
                <div>
                    <div>
                        <h5>列表資料總數: {{ $playerList->total() }} 筆</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>編號</th>
                                    <th>姓名</th>
                                    <th>暱稱</th>
                                    <th>帳號</th>
                                    <th>手機</th>
                                    <th>住址</th>
                                    <th>性別</th>
                                    <th>信箱</th>
                                    <th>創立時間</th>
                                    <th>點數</th>
                                    <th>創立時間</th>
                                    <th style="width: 215px;">相關紀錄操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($playerList as $data)
                                <tr class="text-center">
                                    <td>{{ $data->Id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->nickName }}</td>
                                    <td>{{ $data->account }}</td>
                                    <td>{{ $data->telephone }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>
                                        @if ($data->gender == 0)
                                        男
                                        @elseif ($data->gender == 1)
                                        女
                                        @else
                                        未指定
                                        @endif
                                    </td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->birthdate }}</td>
                                    <td>{{ $data->point ?? 0}}</td>
                                    <td>{{ date('Y-m-d', strtotime($data->createTime)) }}</td>
                                    <td>
                                        <a href="/admin/player/rechargeList/{{ $data->Id }}" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-cash-coin"></i> 儲值
                                        </a>
                                        <a href="/admin/player/lotteryList/{{ $data->Id }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-award"></i> 抽獎
                                        </a>
                                        <a href="/admin/player/shippingList/{{ $data->Id }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-truck"></i> 出貨
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="text-center">目前沒有玩家資料。</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $playerList->links() }}
                        </div>
                        <div class="text-center mt-3">
                            <p>
                                第 {{ $playerList->currentPage() }} 頁，共 {{ $playerList->lastPage() }} 頁，本頁顯示 {{ $playerList->count() }} 筆
                            </p>
                        </div>
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
        window.location.href = '/admin/player/playerList';
    });
</script>
@endsection