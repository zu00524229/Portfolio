@extends('admin.layout')
@section('title', '新增專業資料')
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-person-plus"></i> @yield('title')</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="/admin/manager/list" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> 返回列表
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5"> <!-- 控制表單寬度 -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-body">
                            <h1 class="card-title text-center mb-4 text-primary"><i
                                    class="bi bi-file-earmark-plus-fill"></i> 填寫新增資料</h1><br><br>
                            <form action="/admin/manager/insert" method="POST">
                                @csrf <!-- Laravel 防止跨站請求偽造 -->

                                <!-- 姓名 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">姓名 <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="請輸入姓名" value="{{ old('name') }}" required autofocus>
                                </div>

                                <!-- 帳號 -->
                                <div class="mb-3">
                                    <label for="account" class="form-label">帳號 <span class="text-danger">*</span></label>
                                    <input type="text" name="account" id="account" class="form-control"
                                        placeholder="請輸入帳號" required>
                                    @error('error')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- 密碼 -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">密碼 <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="請輸入密碼" required>
                                </div>

                                <!-- 操作按鈕 -->
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary me-3">
                                        <i class="bi bi-check-circle"></i> 送出
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
