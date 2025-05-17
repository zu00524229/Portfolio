@extends('admin.layout')
@section('title', '修改聯絡留言')
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-pencil-square ms-2"></i> @yield('title')</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('admin.contact.list') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> 返回列表
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-6">
                    <div class="card shadow-sm mt-4">
                        <div class="card-body">
                            <h1 class="card-title text-center mb-4 text-primary">
                                <i class="bi bi-pencil-fill"></i> 編輯聯絡留言
                            </h1>

                            <form action="{{ route('admin.contact.update', ['id' => $contact->id]) }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $contact->id }}">

                                <!-- 姓名 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">姓名</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $contact->name) }}" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email', $contact->email) }}" required>
                                </div>

                                <!-- 主旨 -->
                                <div class="mb-3">
                                    <label for="subject" class="form-label">主題</label>
                                    <select name="subject" class="form-select">
                                        <option value="">請選擇</option>
                                        <option value="MMT一對一">MMT 一對一</option>
                                        <option value="長照諮詢">長照諮詢</option>
                                        <option value="保險規劃">保險規劃</option>
                                        <option value="其他">其他</option>
                                    </select>
                                </div>

                                <!-- 留言內容 -->
                                <div class="mb-3">
                                    <label for="message" class="form-label">留言內容</label>
                                    <textarea name="message" id="message" rows="5" class="form-control" required>{{ old('message', $contact->message) }}</textarea>
                                </div>

                                <!-- 按鈕 -->
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary me-3">
                                        <i class="bi bi-check-circle"></i> 更新
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> 重置
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
