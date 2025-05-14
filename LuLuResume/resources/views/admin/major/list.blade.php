@extends('admin.layout')
@section('title', '專業管理列表')
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

    <div class="app-content-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <form id="searchForm" action="{{ route('admin.major.list') }}" method="GET" class="d-flex">
                            <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 :</label>
                            <input type="text" name="keyword" class="form-control me-4" style="width: 330px;"
                                placeholder="輸入專業名稱" value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-outline-success me-3">
                                <i class="bi bi-search me-2"></i>搜尋
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="resetButton">
                                <i class="bi bi-x-circle me-2"></i>取消
                            </button>
                        </form>
                        <a href="{{ route('admin.major.add') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-file-earmark-plus"></i> 新增
                        </a>
                    </div>

                    <h5>列表資料總數: {{ $majors->total() }} 筆</h5>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>編號</th>
                                    <th>圖片</th>
                                    <th>名稱</th>
                                    <th>所屬分類</th>
                                    <th>建立時間</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($majors as $data)
                                    <tr class="text-center align-middle">
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            @if ($data->photo)
                                                <img src="{{ asset('storage/' . $data->photo) }}" width="80">
                                            @else
                                                無圖
                                            @endif
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->majorCategory->name ?? '未分類' }}</td>
                                        <td>{{ $data->createTime }}</td>
                                        <td>
                                            <a href="{{ route('admin.major.edit', ['id' => $data->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i> 修改
                                            </a>
                                            &nbsp;
                                            <form action="{{ route('admin.major.delete') }}" method="POST"
                                                id="delete-form-{{ $data->id }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="doDelete('{{ $data->id }}')">
                                                    <i class="bi bi-trash-fill"></i> 刪除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">目前沒有專業資料。</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $majors->links() }}
                        </div>
                        <div class="text-center mt-3">
                            <p>
                                第 {{ $majors->currentPage() }} 頁，共 {{ $majors->lastPage() }} 頁，本頁顯示
                                {{ $majors->count() }} 筆
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
            const form = document.getElementById('searchForm');
            form.keyword.value = '';
            window.location.href = '{{ route('admin.major.list') }}';
        });

        function doDelete(id) {
            if (confirm('確定要刪除這筆資料嗎？')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
