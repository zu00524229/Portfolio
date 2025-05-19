<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    // 聯絡資料列表
    public function index(Request $req)
    {
        $keyword = $req->input('keyword');                      // 接收前台輸入的keyword作為搜尋條件

        // 如果有keyword，就用wheh()搭配like查詢name、email、subject、message
        $contacts = Contact::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('subject', 'like', "%{$keyword}%")
                ->orWhere('message', 'like', "%{$keyword}%");
        })->latest()->paginate(10);                             // 最後建立時間排序(latest())並分頁顯示10筆

        return view('admin.contact.list', compact('contacts')); // 結果回傳到admin.contact.list Blade頁面
    }

    // 編輯表單
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);                    // 根據傳入的聯絡資料id撈取資料(找不到會拋出404)
        return view('admin.contact.edit', compact('contact'));  // 結果回傳admin.contact.edit 頁面，讓管理員修改欄位內容
    }

    // 更新聯絡資料
    public function update(Request $req, $id)
    {
        $contact = Contact::findOrFail($id);                    // 根據id撈出聯絡資料


        // 驗證輸入資料是否合法（格式正確、必填、長度等）
        $req->validate([
            'name' => 'required|string|max:255',                // 姓名必填，最多 255 字元
            'email' => 'required|email',                        // 必填且符合 Email 格式
            'phone' => 'nullable|string|max:20',                // 非必填，但若有要是字串
            'line' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:100',
            'message' => 'nullable|string',
        ]);

        // 取出欄位並批次更新
        $contact->update($req->only([
            'name',
            'email',
            'phone',
            'line',
            'subject',
            'message',
        ]));

        // 更新後回傳至admin.contact.list 頁面，並帶入訊息
        return redirect()->route('admin.contact.list')->with('message', '更新成功!');
    }

    // 刪除聯絡資料
    public function delete(Request $req)
    {
        Contact::destroy($req->id);                         // 使用Eloquent的destroy()方法直接依據id刪除資料

        // 刪除後回傳至admin.contact.list 頁面，並提示訊息
        return redirect()->route('admin.contact.list')->with('message', '刪除成功!');
    }
}
