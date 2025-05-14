@extends('admin.layout')
@section('title', '員工管理列表')
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-list-check me-2 fs-2"></i>@yield('title')</h3>
                </div>
            </div>
        </div>
    </div><br>

    <!-- Table 區塊 -->
    <div class="app-content-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-9"> <!-- 調整表格容器的寬度 -->
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <!-- 關鍵字搜尋 -->
                        <form id="searchForm" action="/admin/manager/list" method="GET" class="d-flex">
                            <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 : </label>
                            <input type="text" name="keyword" class="form-control me-4" style="width: 330px;"
                                placeholder="輸入姓名或帳號" value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-outline-success me-3"><i
                                    class="bi bi-search me-2"></i>搜尋</button>
                            <button type="button" class="btn btn-outline-secondary" id="resetButton"><i
                                    class="bi bi-x-circle me-2"></i>取消</button>
                        </form>
                        <a href="/admin/manager/add" class="btn btn-primary btn-lg">
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
                                    <th class="col-2">姓名</th>
                                    <th class="col-2">帳號</th>
                                    <th class="col-2">建立時間</th>
                                    <th class="col-2">修改時間</th>
                                    <th class="col-3">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($list as $data)
                                    <tr class="text-center">
                                        <td>{{ $data->Id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->account }}</td>
                                        <td>{{ $data->createTime }}</td>
                                        <td>{{ $data->updateTime }}</td>
                                        <td>
                                            <a href="/admin/manager/edit/{{ $data->Id }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i> 修改
                                            </a>&nbsp;&nbsp;&nbsp;
                                            <form action="/admin/manager/delete" method="POST"
                                                id="delete-form-{{ $data->Id }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="Id" value="{{ $data->Id }}">
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="doDelete('{{ $data->Id }}')">
                                                    <i class="bi bi-trash-fill"></i> 刪除
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">目前沒有員工資料。</td>
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
            window.location.href = '/admin/manager/list';
        });
    </script>
@endsection
