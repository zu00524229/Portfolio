@extends('admin.layout')
@section('title', '新增專業分類')
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-tags"></i> @yield('title')</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('admin.major_category.list') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> 返回列表
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-sm mt-4">
                        <div class="card-body">
                            <h1 class="card-title text-center mb-4 text-primary">
                                <i class="bi bi-plus-circle-fill"></i> 新增分類名稱
                            </h1>

                            <form action="{{ route('admin.major_category.insert') }}" method="POST">
                                @csrf

                                <!-- 分類名稱 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">分類名稱 <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="請輸入分類名稱" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
