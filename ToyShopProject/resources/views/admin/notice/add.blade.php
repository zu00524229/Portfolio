@extends("admin.layout")
@section("title", "新增公告資料")
@section("content")
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-person-plus"></i> @yield("title")</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="/admin/notice/list" class="btn btn-outline-secondary">
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
                        <h1 class="card-title text-center mb-4 text-primary"><i class="bi bi-file-earmark-plus-fill"></i> 填寫新增資料</h1><br><br>
                        <form action="/admin/notice/insert" method="POST" enctype="multipart/form-data">
                            @csrf <!-- Laravel 防止跨站請求偽造 -->

                            <!-- 主標題 -->
                            <div class="mb-3">
                                <label for="title" class="form-label">主標題 <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="請輸入主標題" value="{{ old('title') }}" required autofocus>
                            </div>

                            <!-- 副標題 -->
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">副標題 <span class="text-danger">*</span></label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="請輸入副標題" required>
                            </div>

                            <!-- 圖片 -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">圖片 <span class="text-danger">*</span></label>

                                <!-- 圖片上傳欄位 -->
                                <input type="file" name="photo" id="photo" class="form-control" placeholder="請選擇圖片" required accept="image/*" onchange="previewImage(event)">

                                <!-- 圖片預覽 -->
                                <div class="mt-3">
                                    <img id="photoPreview" src="#" alt="圖片預覽" class="img-fluid img-thumbnail" style="max-width: 300px; display: none;">
                                </div>
                            </div>

                            <!-- 內容 -->
                            <div class="mb-3">
                                <label for="content" class="form-label">內容 <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control" placeholder="請輸入內容" rows="5" style="resize: vertical; overflow-y: auto;" required>{{ old('content') }}</textarea>
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

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("photoPreview");

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block"; // 顯示圖片
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
            preview.style.display = "none"; // 隱藏圖片
        }
    }
</script>
@endsection