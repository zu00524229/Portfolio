@extends('admin.layout')
@section('title', '修改專業分類')
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-pencil-square ms-2"></i> @yield('title')</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('admin.major.list') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> 返回分類列表
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
                                <i class="bi bi-pencil-fill"></i> 填寫修改資料
                            </h1>
                            <form action="{{ route('admin.major_category.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">

                                <!-- 分類名稱 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">分類名稱</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $category->name) }}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
