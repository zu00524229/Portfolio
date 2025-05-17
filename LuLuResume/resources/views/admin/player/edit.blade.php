@extends('admin.layout')
@section('title', '修改會員資料')

@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-pencil-square ms-2"></i> @yield('title')</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('admin.player.list') }}" class="btn btn-outline-secondary">
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
                                <i class="bi bi-person-lines-fill"></i> 編輯會員資料
                            </h1>

                            <form action="{{ route('admin.player.update', $player->id) }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $player->id }}">

                                <!-- 姓名 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">姓名</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $player->name) }}" required>
                                </div>

                                <!-- 暱稱 -->
                                <div class="mb-3">
                                    <label for="nickName" class="form-label">暱稱</label>
                                    <input type="text" name="nickName" id="nickName" class="form-control"
                                        value="{{ old('nickName', $player->nickName) }}">
                                </div>

                                <!-- 帳號 -->
                                <div class="mb-3">
                                    <label for="account" class="form-label">帳號</label>
                                    <input type="text" name="account" id="account" class="form-control"
                                        value="{{ old('account', $player->account) }}" required>
                                    @error('error')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- 密碼（選填）-->
                                <div class="mb-3">
                                    <label for="password" class="form-label">密碼</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="若要修改再填寫，空白則不變更">
                                </div>

                                <!-- 電話 -->
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">電話</label>
                                    <input type="text" name="telephone" id="telephone" class="form-control"
                                        value="{{ old('telephone', $player->telephone) }}">
                                </div>

                                <!-- 信箱 -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">信箱</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email', $player->email) }}">
                                </div>

                                <!-- 性別 -->
                                <div class="mb-3">
                                    <label for="gender" class="form-label">性別</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="">請選擇</option>
                                        <option value="0" {{ old('gender', $player->gender) == 0 ? 'selected' : '' }}>男
                                        </option>
                                        <option value="1" {{ old('gender', $player->gender) == 1 ? 'selected' : '' }}>
                                            女</option>
                                    </select>
                                </div>

                                <!-- 出生日期 -->
                                <div class="mb-3">
                                    <label for="birthdate" class="form-label">生日</label>
                                    <input type="date" name="birthdate" id="birthdate" class="form-control"
                                        value="{{ old('birthdate', $player->birthdate) }}">
                                </div>

                                <!-- 按鈕 -->
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
