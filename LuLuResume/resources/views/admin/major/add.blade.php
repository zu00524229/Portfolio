@extends('admin.layout')
@section('title', '新增專業項目')
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-person-plus"></i> @yield('title')</h3>
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
                            <h1 class="card-title text-center mb-4 text-primary"><i
                                    class="bi bi-file-earmark-plus-fill"></i> 填寫專業資料</h1>


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>請修正以下錯誤：</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.major.insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- 所屬分類、專業標籤 -->
                                <div class="mb-3">
                                    <label for="majorId" class="form-label">所屬分類</label>
                                    <select name="majorId" id="majorId" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('majorId') == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- 專業名稱 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">專業名稱 <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" placeholder="例：天賦6" required>
                                </div>


                                <!-- 上傳圖片 -->
                                <div class="mb-3">
                                    <label for="photo" class="form-label">封面照片</label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                </div>

                                <!-- 專業內容 -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">專業內容介紹</label>
                                    <textarea name="content" id="content" class="form-control" rows="5" placeholder="輸入詳細說明...">{{ old('content') }}</textarea>
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
