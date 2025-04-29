@extends("admin.layout")
@section("title", "聯絡我們")
@section("content")
<link rel="stylesheet" href="/admin/css/lightbox.min.css">
<script src="/admin/js/lightbox.min.js"></script>
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-envelope-fill me-2 fs-2"></i>@yield("title")</h3>
            </div>
        </div>
    </div>
</div><br>

<!-- Table 區塊 -->
<div class="app-content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7"> <!-- 調整表格容器的寬度 -->
                <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
                    <!-- 關鍵字搜尋 -->
                    <form id="searchForm" action="/admin/contact/contactList" method="GET" class="d-flex">
                        <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 : </label>
                        <input type="text" name="keyword" class="form-control me-4" style="width: 330px;" placeholder="輸入關鍵字(姓名、手機、信箱)" value="{{ request('keyword') }}">
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
                                <th>編號</th>
                                <th>姓名</th>
                                <th>手機</th>
                                <th>信箱</th>
                                <th>訊息內容</th>
                                <th>寄送時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $data)
                            <tr class="text-center">
                                <td>{{ $data->Id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <button
                                        class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#messageModal"
                                        data-message="{!! nl2br(e($data->message)) !!}">
                                        查看內容
                                    </button>
                                </td>
                                <td>{{ $data->createTime }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">目前沒有聯絡我們資料。</td>
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

<!-- 訊息內容的 Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">訊息內容</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="messageContent">內容載入中...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>

<script>
    // 當 Modal 顯示時更新內容
    const messageModal = document.getElementById('messageModal');
    messageModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // 引發事件的按鈕
        const message = button.getAttribute('data-message'); // 獲取訊息內容
        const messageContent = messageModal.querySelector('#messageContent');
        messageContent.textContent = message; // 更新 Modal 中的內容
    });

    document.getElementById('resetButton').addEventListener('click', function() {
        // 清空關鍵字欄位
        const form = document.getElementById('searchForm');
        form.keyword.value = '';
        // 提交表單
        form.submit();
        // 重新導向到基礎網址
        window.location.href = '/admin/contact/contactList';
    });
</script>
@endsection