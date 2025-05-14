@extends('admin.layout')
@section('title', '專業分類列表')
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
                <div class="col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <!-- 搜尋 -->
                        <form id="searchForm" action="{{ route('admin.major_category.list') }}" method="GET"
                            class="d-flex">
                            <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 :</label>
                            <input type="text" name="keyword" class="form-control me-4" style="width: 330px;"
                                placeholder="輸入分類名稱" value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-outline-success me-3">
                                <i class="bi bi-search me-2"></i>搜尋
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="resetButton">
                                <i class="bi bi-x-circle me-2"></i>取消
                            </button>
                        </form>

                        <a href="{{ route('admin.major_category.add') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-file-earmark-plus"></i> 新增
                        </a>
                    </div>

                    <h5>分類總數: {{ $categories->total() }} 筆</h5>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>編號</th>
                                    <th>名稱</th>
                                    <th>建立時間</th>
                                    <th>修改時間</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr class="text-center align-middle">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->createTime }}</td>
                                        <td>{{ $category->updateTime }}</td>
                                        <td>
                                            <a href="{{ route('admin.major_category.edit', ['id' => $category->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i> 修改
                                            </a>

                                            &nbsp;
                                            <form action="{{ route('admin.major_category.delete') }}" method="POST"
                                                id="delete-form-{{ $category->id }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="doDelete('{{ $category->id }}')">
                                                    <i class="bi bi-trash-fill"></i> 刪除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">目前沒有分類資料。</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $categories->links() }}
                        </div>
                        <div class="text-center mt-3">
                            <p>
                                第 {{ $categories->currentPage() }} 頁，共 {{ $categories->lastPage() }} 頁，本頁顯示
                                {{ $categories->count() }} 筆
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
            window.location.href = '{{ route('admin.major_category.list') }}';
        });

        function doDelete(id) {
            if (confirm('確定要刪除這筆資料嗎？')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
