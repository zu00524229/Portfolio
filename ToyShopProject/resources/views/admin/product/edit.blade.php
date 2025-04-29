@extends("admin.layout")
@section("title", "修改商品資料")
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
                        <h1 class="card-title text-center mb-4 text-primary"><i class="bi bi-file-earmark-plus-fill"></i> 填寫修改資料</h1><br><br>
                        <form action="/admin/product/update" method="POST" enctype="multipart/form-data">
                            @csrf <!-- Laravel 防止跨站請求偽造 -->
                            <input type="hidden" name="Id" value="{{ $product->Id }}">
                            <input type="hidden" name="oldTotalCount" value="{{ $product->totalCount }}">
                            <input type="hidden" name="stock" value="{{ $product->stock }}">

                            <!-- 商品名稱 -->
                            <div class="mb-3">
                                <label for="name" class="form-label">商品名稱</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" autofocus>
                            </div>

                            <!-- 商品類別 -->
                            <div class="mb-3">
                                <label for="categories" class="form-label">商品類別</label>
                                <select name="categoryId" id="categoryId" class="form-control">
                                    @foreach($categories as $data)
                                    <option value="{{ $data->Id }}"
                                        {{ $product->categoryId && $product->category->Id == $data->Id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 商品內容  -->
                            <div class="mb-3">
                                <label for="content" class="form-label">商品內容</label>
                                <textarea name="content" id="content" class="form-control" rows="5" style="resize: vertical; overflow-y: auto;">{{ $product->content }}</textarea>
                            </div>

                            <!-- 點數  -->
                            <div class="mb-3">
                                <label for="point" class="form-label">點數</label>
                                <input type="number" name="point" id="point" class="form-control" value="{{ $product->point }}" min="0" step="1">
                            </div>

                            <!-- 商品總數 -->
                            <div class="mb-3">
                                <label for="totalCount" class="form-label">商品總數</label>
                                <input type="number" name="totalCount" id="totalCount" class="form-control" value="{{ $product->totalCount }}" min="0" step="1">
                            </div>

                            <!-- 出貨天數 -->
                            <div class="mb-3">
                                <label for="shippingDays" class="form-label">出貨天數</label>
                                <input type="number" name="shippingDays" id="shippingDays" class="form-control" value="{{ $product->shippingDays }}" min="0" step="1">
                            </div>

                            <!-- 多張圖片 -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">圖片(可選擇多張)</label>

                                <!-- 顯示原本的圖片 -->
                                @if (!empty($photos) && count($photos) > 0)
                                <div class="mb-2 d-flex flex-wrap gap-3">
                                    @foreach ($photos as $photo)
                                    @if (file_exists(public_path('admin/images/product/' . $photo)))
                                    <div class="image-wrapper">
                                        <img src="{{ asset('admin/images/product/' . $photo) }}" alt="目前的圖片"
                                            class="img-fluid img-thumbnail" style="max-width: 150px;">
                                    </div>
                                    @else
                                    <p class="text-danger">圖片檔案不存在：{{ $photo }}</p>
                                    @endif
                                    @endforeach
                                </div>
                                @else
                                <p class="text-muted">目前無圖片</p>
                                @endif

                                <!-- 圖片上傳欄位 -->
                                <input type="file" name="photos[]" id="photos" class="form-control" placeholder="請選擇圖片" accept="image/*" multiple onchange="previewImages(event)">
                                <small class="form-text text-muted">如不選擇新圖片，將保留目前的圖片。</small>

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