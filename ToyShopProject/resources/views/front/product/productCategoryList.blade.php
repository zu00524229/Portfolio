@extends("front.layout")
@section("title", "系列商品專區")
@section("content")
<!-- 主內容區域 -->
<section class="section-top-50 section-sm-top-100">
    <div class="container mt-5" style="max-width: 1500px; text-align: left;">
        <h2 class="fw-bold text-primary">@yield("title")</h2>

        <!-- 選擇商品系列 -->
        <div class="container d-flex justify-content-between align-items-center mt-4" style="margin-top: 30px; max-width: 100%;">
            <!-- 關鍵字搜尋 -->
            <form id="searchForm" action="/front/product/productCategoryList/{{ $category->Id }}" method="GET" class="d-flex">
                <label class="fw-bold text-muted fs-4 me-3">關鍵字搜尋 : </label>
                <input type="text" name="keyword" class="form-control me-4" style="width: 330px;" placeholder="輸入商品名稱或點數" value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-outline-warning me-3"><i class="bi bi-search me-1"></i>搜尋</button>
                <button type="button" class="btn btn-outline-success" id="resetButton"><i class="bi bi-x-circle me-2"></i>取消</button>
            </form>

            <!-- 選擇商品系列 -->
            <div class="dropdown">
                <button class="btn btn-outline-danger" style="width: 250px;" type="button" id="MenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    選擇商品系列 ▼
                </button>
                <ul class="dropdown-menu" aria-labelledby="MenuButton">
                    @forelse($categories as $data)
                    <li><a class="dropdown-item text-center" style="width: 250px;" href="/front/product/productCategoryList/{{ $data->Id }}">{{ $data->name }}</a></li>
                    @empty
                    <li>
                        <p class="dropdown-item text-center">沒有商品可顯示。</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="container" style="margin-top: 30px; max-width: 100%;">
            <div class="row mb-5">
                <!-- 商品搜尋區 -->
                @if(!empty(request('keyword')))
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h3 class="text-muted mb-0 fs-2">商品搜尋區</h3>
                    </div>

                    <div class="row mt-3">
                        <!-- 顯示商品 -->
                        @forelse($keywordProduct as $data)
                        <div class="col-md-3 mt-1 mb-4">
                            <div class="card shadow-sm border-0 rounded-3" style="height: 380px;" data-lightgallery="group">
                                @if(!empty($data->photo))
                                @php
                                $photos = explode(',', $data->photo);
                                @endphp
                                <!-- 商品封面，使用第一張圖片 -->
                                <div style="height: 250px; overflow: hidden;">
                                    <a class="thumbnail-gallery" data-lightgallery="item" href="/admin/images/product/{{ $photos[0] }}">
                                        <img src="/admin/images/product/{{ $photos[0] }}"
                                            class="card-img-top"
                                            alt="{{ $data->name }}"
                                            style="object-fit: cover; width: 100%; height: 100%;">
                                    </a>
                                </div>
                                <!-- 其他圖片 -->
                                @foreach(array_slice($photos, 1) as $photo)
                                <a data-lightgallery="item" href="/admin/images/product/{{ $photo }}" style="display: none;">
                                    <img src="/admin/images/product/{{ $photo }}" alt="{{ $data->name }}">
                                </a>
                                @endforeach
                                @endif

                                <div class="badge-container position-absolute top-0 end-0 p-2">
                                    <span class="badge bg-primary">{{ $data->stock }} / {{ $data->totalCount }}</span>
                                </div>

                                <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px;">
                                    <h5 class="card-title text-dark" style="max-height: 50px; overflow-y: auto; word-break: break-word;">
                                        {{ $data->name }}
                                    </h5>
                                    <p class="card-text text-end fs-5">
                                        <i class="bi bi-currency-dollar text-warning fs-2"></i> 點數: <strong class="text-danger">{{ $data->point }}</strong> 點
                                    </p>
                                    <div class="mt-auto text-end">
                                        <a href="/front/product/productList/{{ $data->Id }}" class="btn btn-primary btn-sm">去抽獎</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-left fw-bold text-primary fs-5 mb-4">未找到相關商品，請重新輸入關鍵字。</p>
                        @endforelse
                    </div>
                </div>
                @endif

                <!-- 所有商品區 -->
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h3 class="text-muted mb-4 fs-2">❰ {{ $category->name }} ❱</h3>
                    </div>

                    <div class="row mt-3">
                        <!-- 顯示商品 -->
                        @forelse($products as $data)
                        <div class="col-md-3 mt-1 mb-4">
                            <div class="card shadow-sm border-0 rounded-3" style="height: 380px;" data-lightgallery="group">
                                @if(!empty($data->photo))
                                @php
                                $photos = explode(',', $data->photo);
                                @endphp
                                <!-- 商品封面，使用第一張圖片 -->
                                <div style="height: 250px; overflow: hidden;">
                                    <a class="thumbnail-gallery" data-lightgallery="item" href="/admin/images/product/{{ $photos[0] }}">
                                        <img src="/admin/images/product/{{ $photos[0] }}"
                                            class="card-img-top"
                                            alt="{{ $data->name }}"
                                            style="object-fit: cover; width: 100%; height: 100%;">
                                    </a>
                                </div>
                                <!-- 其他圖片 -->
                                @foreach(array_slice($photos, 1) as $photo)
                                <a data-lightgallery="item" href="/admin/images/product/{{ $photo }}" style="display: none;">
                                    <img src="/admin/images/product/{{ $photo }}" alt="{{ $data->name }}">
                                </a>
                                @endforeach
                                @endif

                                <div class="badge-container position-absolute top-0 end-0 p-2">
                                    <span class="badge bg-primary">{{ $data->stock }} / {{ $data->totalCount }}</span>
                                </div>

                                <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px;">
                                    <h5 class="card-title text-dark" style="max-height: 50px; overflow-y: auto; word-break: break-word;">
                                        {{ $data->name }}
                                    </h5>
                                    <p class="card-text text-end fs-5">
                                        <i class="bi bi-currency-dollar text-warning fs-2"></i> 點數: <strong class="text-danger">{{ $data->point }}</strong> 點
                                    </p>
                                    <div class="mt-auto text-end">
                                        <a href="/front/product/productList/{{ $data->Id }}" class="btn btn-primary btn-sm">去抽獎</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>目前沒有此系列商品資料。</p>
                        @endforelse
                    </div>

                    <!-- 分頁導航 -->
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            {{ $products->links() }} <!-- 顯示分頁導航 -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="footer text-center mt-4 mb-5">
            <p class="text-muted">更多資訊請關注我們的官方網站和社交媒體。</p> <!-- 底部資訊，淡化文字 -->
            <a href="/front/product/productAllList" class="btn btn-outline-primary">返回商品專區首頁</a> <!-- 主要按鈕樣式 -->
        </div>
    </div>
</section>
<script>
    document.getElementById('resetButton').addEventListener('click', function() {
        // 清空關鍵字欄位
        const form = document.getElementById('searchForm');
        form.keyword.value = '';
        // 提交表單
        form.submit();
        // 重新導向到基礎網址
        window.location.href = '/front/product/productCategoryList/{{ $category->Id }}';
    });
</script>
@endsection