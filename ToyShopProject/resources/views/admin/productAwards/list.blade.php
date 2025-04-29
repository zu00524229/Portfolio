@extends("admin.layout")
@section("title", " 商品獎項列表")
@section("content")
<link rel="stylesheet" href="/admin/css/lightbox.min.css">
<script src="/admin/js/lightbox.min.js"></script>
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
</div><br>

<!-- Table 區塊 -->
<div class="app-content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- 調整表格容器的寬度 -->
                <div>
                    <h5>列表資料總數: {{ $list->total() }} 筆</h5>
                </div>
                <p>

                    <!-- 顯示產品名稱 -->
                <h6 style="font-weight: bolder; color:darkcyan;">商品名稱: {{ $product->name }}</h6>
                <div class="d-flex justify-content-end mb-3">
                    <a href="/admin/productAwards/add/{{ $product->Id }}" class="btn btn-primary">
                        <i class="bi bi-person-fill-add"></i> 新增
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered"> <!-- 縮小字體大小 -->
                        <thead class="table-dark text-center">
                            <tr>
                                <th class="col-1">獎項</th>
                                <th class="col-3">獎項名稱</th>
                                <th class="col-1">獎項總數</th>
                                <th class="col-1">獎項庫存</th>
                                <th class="col-2">建立時間</th>
                                <th class="col-2">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $data)
                            <tr class="text-center">
                                <td>{{ $data->level }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->totalCount }}</td>
                                <td>{{ $data->stock }}</td>
                                <td>{{ $data->createTime }}</td>
                                <td>
                                    <a href="/admin/productAwards/edit/{{ $data->Id }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i> 修改
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <form action="/admin/productAwards/delete" method="POST" id="delete-form-{{ $data->Id }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="Id" value="{{ $data->Id }}">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="doDelete('{{ $data->Id }}')">
                                            <i class="bi bi-trash-fill"></i> 刪除
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">目前沒有此商品獎項資料。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- 總和顯示區域 -->
                    <div class="text-end mb-3">
                        <h6 style="font-weight: bold; color: darkslateblue;">商品總數總和: {{ $allTotalCount }} &nbsp;||&nbsp; 商品庫存總和: {{ $allStock }}</h6>
                    </div>
                    <!-- 分頁區域 -->
                    <div class="text-center">
                        {{ $list->links() }}
                    </div>
                    <div class="text-center mt-3">
                        <p>
                            第 {{ $list->currentPage() }} 頁，共 {{ $list->lastPage() }} 頁，本頁顯示 {{ $list->count() }} 筆
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection