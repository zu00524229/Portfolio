@extends("front.layout")
@section("title", "公告管理列表")
@section("content")
<section class="section-top-50 section-sm-top-66" style="margin-top: 50px;">
    <div class="container mt-4">
        <h2 class="text-center fw-bold text-primary">@yield("title")</h2> <!-- 主標題，新增字體加粗和主色調 -->

        <div class="row">
        @foreach($notices as $notice)
            <div class="col-md-4 mb-4"> <!-- 每個公告佔三分之一的寬度，並保持底部間距 -->
                <div class="card shadow-sm border-0 rounded"> <!-- 卡片樣式，增加陰影和圓角 -->
                    <img src="/admin/images/notice/{{ $notice->photo }}" class="card-img-top img-fluid" alt="公告圖片" style="max-height: 200px; object-fit: cover;"> <!-- 圖片縮放並限制高度 -->
                    <div class="card-body">
                        <h3 class="card-title text-danger fw-bold">{{ $notice->title }}</h3> <!-- 標題加粗並設定色調 -->
                        <p class="card-text text-dark" style="font-size: 0.9rem;">刊登時間：{{ $notice->createTime }}</p> <!-- 刊登時間 -->
                        <p class="card-text">{{ $notice->subtitle }}</p> <!-- 副標題 -->
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary btn-sm px-4" data-bs-toggle="modal" data-bs-target="#noticeModal-{{ $notice->Id }}">
                                了解更多
                            </button> <!-- 小按鈕右對齊 -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap 模態框 -->
            <div class="modal fade" id="noticeModal-{{ $notice->Id }}" tabindex="-1" aria-labelledby="noticeModalLabel-{{ $notice->Id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fw-bold" style="color:crimson" id="noticeModalLabel-{{ $notice->Id }}">{{ $notice->title }}</h1> <!-- 標題加粗 -->
                        </div>
                        <hr style="width: auto;"><br>
                        <div class="modal-body">
                            <h2 class="text-center text-success">{{ $notice->subtitle }}</h2> <!-- 副標題次色調 -->
                            <p class="text-center text-muted mb-4" style="font-size: 0.9rem;">刊登時間：{{ $notice->createTime }}</p> <!-- 较小的时间文字 -->
                            <img src="/admin/images/notice/{{ $notice->photo }}" class="img-fluid mx-auto d-block rounded shadow-sm mb-4" style="width: 600px;"> <!-- 圖片增加圓角和陰影 -->
                            <h5 class="text-center text-white" style="line-height: 1.8;">{!! nl2br(e($notice->content)) !!}</h5> <!-- 內容增加行距 -->
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>

        <div class="footer text-center mt-5">
            <p class="text-muted">更多資訊請關注我們的官方網站和社交媒體。</p> <!-- 底部資訊，淡化文字 -->
            <a href="/" class="btn btn-outline-primary">返回首頁</a> <!-- 主要按鈕樣式 -->
        </div>
        <br><br>
    </div>
</section>
@endsection