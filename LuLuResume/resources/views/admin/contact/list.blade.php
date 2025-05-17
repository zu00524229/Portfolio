@extends('admin.layout')
@section('title', '聯絡我留言列表')

@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-envelope-paper fs-2 me-2"></i>@yield('title')</h3>
                </div>
            </div>
        </div>
    </div><br>

    <div class="app-content-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <h5>列表資料總數: {{ $contacts->total() }} 筆</h5>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>Email</th>
                                    <th>手機</th>
                                    <th>Line ID</th>
                                    <th>主題</th>
                                    <th>內容</th>
                                    <th>送出時間</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $data)
                                    <tr class="text-center align-middle">
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->line }}</td>
                                        <td>{{ $data->subject ?? '（無）' }}</td>
                                        <td class="text-start">{{ Str::limit($data->message, 50) }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.contact.edit', $data->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i> 修改
                                            </a>
                                            <form action="{{ route('admin.contact.delete') }}" method="POST"
                                                id="delete-form-{{ $data->id }}" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('確定刪除這筆資料嗎？')">
                                                    <i class="bi bi-trash-fill"></i> 刪除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">目前沒有聯絡資料。</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $contacts->links() }}
                        </div>
                        <div class="text-center mt-3">
                            <p>
                                第 {{ $contacts->currentPage() }} 頁，共 {{ $contacts->lastPage() }} 頁，本頁顯示
                                {{ $contacts->count() }} 筆
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
