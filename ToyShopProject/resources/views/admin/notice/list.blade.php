@extends("admin.layout")
@section("title", "公告管理列表")
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
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <!-- 關鍵字搜尋 -->
                    <form id="searchForm" action="/admin/notice/list" method="GET" class="d-flex">
                        <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 : </label>
                        <input type="text" name="keyword" class="form-control me-4" style="width: 330px;" placeholder="輸入公告關鍵字(標題、副標題、內容)" value="{{ request('keyword') }}">
                        <button type="submit" class="btn btn-outline-success me-3"><i class="bi bi-search me-2"></i>搜尋</button>
                        <button type="button" class="btn btn-outline-secondary" id="resetButton"><i class="bi bi-x-circle me-2"></i>取消</button>
                    </form>
                    <a href="/admin/notice/add" class="btn btn-primary btn-lg">
                        <i class="bi bi-person-fill-add"></i> 新增
                    </a>
                </div>
                <div>
                    <h5>列表資料總數: {{ $list->total() }} 筆</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                        <thead class="table-dark text-center">
                            <tr>
                                <th class="col-1">編號</th> <!-- 調整欄寬 -->
                                <th class="col-1">圖片</th>
                                <th class="col-2">主標題</th>
                                <th class="col-3">副標題</th>
                                <th class="col-2">公告內容</th>
                                <th class="col-1">建立時間</th>
                                <th class="col-2">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $data)
                            <tr class="text-center">
                                <td>{{ $data->Id }}</td>
                                <td>
                                    @if(!empty($data->photo))
                                    <a href="/admin/images/notice/{{ $data->photo }}" data-lightbox="image" data-title="{{ $data->title }}">
                                        <img src="/admin/images/notice/{{ $data->photo }}" width="150">
                                    </a>
                                    @endif
                                </td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->subtitle }}</td>
                                <td>
                                    <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#contentModal-{{ $data->Id }}">
                                        {{ Str::limit($data->content, 40, '....(了解更多)') }}
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="contentModal-{{ $data->Id }}" tabindex="-1" aria-labelledby="contentModalLabel-{{ $data->Id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="contentModalLabel-{{ $data->Id }}">內容詳情</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $data->content }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $data->createTime }}</td>
                                <td>
                                    <a href="/admin/notice/edit/{{ $data->Id }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i> 修改
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <form action="/admin/notice/delete" method="POST" id="delete-form-{{ $data->Id }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="Id" value="{{ $data->Id }}">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="doDelete('{{ $data->Id }}')">
                                            <i class="bi bi-trash-fill"></i> 刪除
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">目前沒有活動公告資料。</td>
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
        window.location.href = '/admin/notice/list';
    });
</script>
@endsection