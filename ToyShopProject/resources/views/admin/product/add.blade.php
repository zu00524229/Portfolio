@extends("admin.layout")
@section("title", "新增商品資料")
@section("content")
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-person-plus"></i> @yield("title")</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="/admin/product/list" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> 返回列表
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7"> <!-- 控制表單寬度 -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4 text-primary"><i class="bi bi-file-earmark-plus-fill"></i> 填寫新增資料</h1><br><br>
                        <form action="/admin/product/insert" method="POST" enctype="multipart/form-data">
                            @csrf <!-- Laravel 防止跨站請求偽造 -->

                            <!-- 商品名稱 -->
                            <div class="mb-3">
                                <label for="name" class="form-label">商品名稱 <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="請輸入商品名稱" required autofocus>
                            </div>

                            <!-- 商品類別 -->
                            <div class="mb-3">
                                <label for="categories" class="form-label">商品類別 <span class="text-danger">*</span></label>
                                <select name="categoryId" id="categoryId" class="form-control" required>
                                    <option value="" disabled selected>請選擇</option>
                                    @foreach($categories as $data)
                                    <option value="{{ $data->Id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 商品內容  -->
                            <div class="mb-3">
                                <label for="content" class="form-label">商品內容 <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control" placeholder="請輸入商品內容" rows="5" style="resize: vertical; overflow-y: auto;" required></textarea>
                            </div>

                            <!-- 點數  -->
                            <div class="mb-3">
                                <label for="point" class="form-label">點數 <span class="text-danger">*</span></label>
                                <input type="number" name="point" id="point" class="form-control" placeholder="請輸入點數" min="0" step="1" required>
                            </div>

                            <!-- 商品總數 -->
                            <div class="mb-3">
                                <label for="totalCount" class="form-label">商品總數 <span class="text-danger">*</span></label>
                                <input type="number" name="totalCount" id="totalCount" class="form-control" placeholder="請輸入總數" min="0" step="1" required>
                            </div>

                            <!-- 出貨天數 -->
                            <div class="mb-3">
                                <label for="shippingDays" class="form-label">出貨天數 <span class="text-danger">*</span></label>
                                <input type="number" name="shippingDays" id="shippingDays" class="form-control" placeholder="請輸入出貨天數" min="0" step="1" required>
                            </div>

                            <!-- 多張圖片 -->
                            <div class="mb-3">
                                <label for="photos" class="form-label">圖片(可選擇多張) <span class="text-danger">*</span></label>

                                <!-- 圖片上傳欄位 -->
                                <input type="file" name="photos[]" id="photos" class="form-control" placeholder="請選擇圖片" required accept="image/*" multiple onchange="previewImages(event)">

                                <!-- 圖片預覽 -->
                                <div id="photosPreview" class="mt-3 d-flex flex-wrap gap-3">
                                    <!-- 圖片預覽區塊 -->
                                </div>
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
    function previewImages(event) {
        const photosPreview = document.getElementById('photosPreview');
        photosPreview.innerHTML = ''; // 清空之前的預覽

        const files = event.target.files;

        if (files) {
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = '圖片預覽';
                        img.className = 'img-fluid img-thumbnail';
                        img.style.maxWidth = '150px'; // 控制每張圖片的大小
                        photosPreview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }
</script>
@endsection