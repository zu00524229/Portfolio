@extends('admin.layout')
@section('title', '修改專業資料')
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-pencil-square ms-2"></i> @yield('title')</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('admin.major.list') }}" class="btn btn-outline-secondary">
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
                                <i class="bi bi-pencil-fill"></i> 填寫修改資料
                            </h1>

                            <form action="{{ route('admin.major.update', ['id' => $major->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $major->id }}">

                                <!-- 專業名稱 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">專業名稱</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $major->name) }}" required>
                                </div>

                                <!-- 所屬分類 -->
                                <div class="mb-3">
                                    <label for="majorId" class="form-label">所屬分類</label>
                                    <select name="majorId" id="majorId" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($category->id == $major->majorId) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- 原圖顯示 + 上傳新圖 -->
                                <div class="mb-3">
                                    <label for="photo" class="form-label">封面圖片</label>
                                    @if ($major->photo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $major->photo) }}" alt="原始圖片"
                                                width="120">
                                        </div>
                                    @endif
                                    <input type="file" name="photo" id="photo" class="form-control">
                                    <small class="text-muted">不修改圖片請留空</small>
                                </div>

                                <!-- 專業介紹內容 -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">專業內容</label>
                                    <textarea name="content" id="content" rows="5" class="form-control">{{ old('content', $major->content) }}</textarea>
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
