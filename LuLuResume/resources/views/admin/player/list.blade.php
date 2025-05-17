@extends('admin.layout')
@section('title', '會員專區列表')

@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-people-fill me-2 fs-2"></i>@yield('title')</h3>
                </div>
            </div>
        </div>
    </div><br>

    <div class="app-content-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <!-- 關鍵字搜尋 -->
                        <form id="searchForm" action="/admin/players" method="GET" class="d-flex">
                            <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 :</label>
                            <input type="text" name="keyword" class="form-control me-4" style="width: 330px;"
                                placeholder="姓名 / 暱稱 / 帳號 / 電話 / 信箱 / 性別 / 點數" value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-outline-success me-3">
                                <i class="bi bi-search me-2"></i>搜尋
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="resetButton">
                                <i class="bi bi-x-circle me-2"></i>取消
                            </button>
                        </form>
                    </div>

                    <h5>列表資料總數: {{ $playerList->total() }} 筆</h5>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>編號</th>
                                    <th>姓名</th>
                                    <th>暱稱</th>
                                    <th>帳號</th>
                                    <th>電話</th>
                                    <th>性別</th>
                                    <th>信箱</th>
                                    <th>點數</th>
                                    <th>建立時間</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($playerList as $data)
                                    <tr class="text-center align-middle">
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->nickName }}</td>
                                        <td>{{ $data->account }}</td>
                                        <td>{{ $data->telephone }}</td>
                                        <td>{{ $data->gender == 0 ? '男' : ($data->gender == 1 ? '女' : '-') }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->point }}</td>
                                        <td>{{ $data->createTime }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success disabled">
                                                <i class="bi bi-pencil-square"></i> 修改
                                            </a>
                                            <form action="#" method="POST" id="delete-form-{{ $data->id }}"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('確定刪除這筆資料嗎？')">
                                                    <i class="bi bi-trash-fill"></i> 刪除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">目前沒有會員資料。</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $playerList->links() }}
                        </div>
                        <div class="text-center mt-3">
                            <p>第 {{ $playerList->currentPage() }} 頁，共 {{ $playerList->lastPage() }} 頁，本頁顯示
                                {{ $playerList->count() }} 筆</p>
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
            window.location.href = '/admin/players';
        });
    </script>
@endsection
