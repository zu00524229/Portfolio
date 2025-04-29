@extends("admin.layout")
@section("title", "修改商品獎項")
@section("content")
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-person-plus"></i> @yield("title")</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="/admin/productAwards/list/{{ $awards->product->Id }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> 返回獎項列表
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- 擴大寬度適應表格 -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4 text-primary"><i class="bi bi-file-earmark-plus-fill"></i> 填寫修改資料</h1><br><br>
                        <h6 style="font-weight: bolder; color:darkcyan;">商品名稱: {{ $awards->product->name }}</h6>

                        <form action="/admin/productAwards/update" method="POST">
                            @csrf <!-- Laravel 防止跨站請求偽造 -->
                            <input type="hidden" name="Id" value="{{ $awards->Id }}">
                            <input type="hidden" name="oldTotalCount" value="{{ $awards->totalCount }}">
                            <input type="hidden" name="stock" value="{{ $awards->stock }}">

                            <table class="table table-hover table-striped table-bordered text-center">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th class="col-2">商品獎項</th>
                                        <th class="col-4">獎項名稱</th>
                                        <th class="col-2">商品總數</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                        <td><input type="text" name="level" class="form-control" value="{{ $awards->level }}"></td>
                                        <td><input type="text" name="name" class="form-control" value="{{ $awards->name }}"></td>
                                        <td><input type="number" name="totalCount" class="form-control" value="{{ $awards->totalCount }}" min="0" step="1"></td>
                                        </tr>
                                </tbody>
                            </table>

                            <!-- 提交按鈕 -->
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