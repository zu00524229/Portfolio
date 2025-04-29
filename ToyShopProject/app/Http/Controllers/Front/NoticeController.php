<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function list()
    {
        // 根據 createTime 字段降冪排序，取得公告列表
        $notices = Notice::orderBy('createTime', 'desc')->get();
        return view('front.notice.list', compact('notices'));
    }
}
