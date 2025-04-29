@extends("admin.layout")
@section("title", "新增商品獎項")
@section("content")
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><i class="bi bi-person-plus"></i> @yield("title")</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="/admin/productAwards/list/{{ $product->Id }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> 返回獎項列表
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- 擴大寬度適應表格 -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4 text-primary"><i class="bi bi-file-earmark-plus-fill"></i> 填寫新增資料</h1><br><br>
                        <h6 style="font-weight: bolder; color:darkcyan;">商品名稱: {{ $product->name }}</h6>

                        <form action="/admin/productAwards/insert" method="POST">
                            @csrf <!-- Laravel 防止跨站請求偽造 -->
                            <input type="hidden" name="Id" value="{{ $product->Id }}">
                            <table class="table table-hover table-striped table-bordered text-center">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th class="col-1"></th>
                                        <th class="col-3">商品獎項 <span class="text-danger">*</span></th>
                                        <th class="col-4">獎項名稱 <span class="text-danger">*</span></th>
                                        <th class="col-2">商品總數 <span class="text-danger">*</span></th>
                                        <th class="col-2">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="awardsTableBody">
                                    @php
                                    $levels = old('levels', ['']); // 預設至少有一行
                                    $names = old('names', ['']);
                                    $totalCounts = old('totalCounts', ['']);
                                    @endphp
                                    @foreach ($levels as $index => $level)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <input type="text" name="levels[]" class="form-control" placeholder="請輸入商品獎項" value="{{ $level }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="names[]" class="form-control" placeholder="請輸入獎項名稱" value="{{ old('names.' . $index) }}" required>
                                        </td>
                                        <td>
                                            <input type="number" name="totalCounts[]" class="form-control" placeholder="請輸入總數" min="0" step="1" value="{{ old('totalCounts.' . $index) }}" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                                <i class="bi bi-trash"></i> 刪除
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- 動態新增按鈕 -->
                            <div class="text-end mt-3">
                                <button type="button" class="btn btn-success" id="addRowButton">
                                    <i class="bi bi-plus-circle"></i> 新增列
                                </button>
                            </div>

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const awardsTableBody = document.getElementById("awardsTableBody");
        const addRowButton = document.getElementById("addRowButton");

        // 動態新增列
        addRowButton.addEventListener("click", function() {
            const rowCount = awardsTableBody.rows.length + 1;
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="text" name="levels[]" class="form-control" placeholder="請輸入商品獎項" required></td>
            <td><input type="text" name="names[]" class="form-control" placeholder="請輸入獎項名稱" required></td>
            <td><input type="number" name="totalCounts[]" class="form-control" placeholder="請輸入總數" min="0" step="1" required></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row">
                    <i class="bi bi-trash"></i> 刪除
                </button>
            </td>
        `;
            awardsTableBody.appendChild(newRow);
        });

        // 刪除列
        awardsTableBody.addEventListener("click", function(event) {
            if (event.target.closest(".remove-row")) {
                const row = event.target.closest("tr");
                row.remove();
            }

            // 更新行號
            updateRowNumbers();
        });

        // 更新行號
        function updateRowNumbers() {
            const rows = awardsTableBody.querySelectorAll("tr");
            rows.forEach((row, index) => {
                row.querySelector("td:first-child").innerText = index + 1;
            });
        }
    });
</script>
@endsection