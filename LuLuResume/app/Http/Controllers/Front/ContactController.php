<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // 前台表單送出處理
    public function store(Request $req)
    {
        // dd($req->all());
        // 驗證資料
        $req->validate([
            'name' => 'required',                  // 姓名為必填
            'email' => 'required|email',           // 信箱為必填，且必須為合法 email 格式
            'phone' => 'nullable|string|max:50',   // 手機可留空，若填必須為字串
            'line' => 'nullable|string|max:100',   // Line ID 可留空
            'subject' => 'nullable|string|max:255', // 主旨可留空，長度最多 255 字
            'message' => 'required|string',        // 留言內容為必填
        ]);

        // 將聯絡資料寫入create 資料表
        Contact::create($req->only(['name', 'email', 'phone', 'line', 'subject', 'message']));

        // 重新回傳原頁面，並帶入提示訊息(session('message'))
        return redirect()->back()->with('message', "您的留言已送出，我將盡快與您聯繫 😊");
    }
}
