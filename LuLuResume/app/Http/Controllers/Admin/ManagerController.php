<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function list(Request $req)
    {
        // 檢查是否有搜尋關鍵字
        $keyword = $req->input('keyword');


        // 根據關鍵字搜尋(模糊比對)，搜尋姓名和帳號
        $list = Manager::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%")->orWhere('account', 'like', "%{$keyword}%");
        })->paginate(10);


        // 回傳admin.manager.list，並導入資料 $list 變數
        return view("admin.manager.list", compact("list"));
    }

    // 新增表單
    public function add()
    {
        return view("admin.manager.add");   // 顯示新增表單admin.manager.add
    }

    public function insert(Request $req)
    {
        // dd($req->all());
        // 檢查帳後是否重複
        $manager = Manager::where("account", $req->account)->first();
        if ($manager) {
            return back()->withErrors(["error" => "帳號已存在，請使用其他帳號!"])->withInput();
        }

        // 儲存新帳號(密碼加密儲存)
        Manager::Create([
            'Id' => $req->Id,
            'name' => $req->name,
            'account' => $req->account,
            'password' => Hash::make($req->password),
            'createTime' => now(),
            'updateTime' => now(),
        ]);

        // 重新回傳route(admon.manager.list)，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.manager.list')->with("message", "新增成功!");
    }

    public function edit(Request $req)
    {
        $manager = Manager::find($req->Id);
        return view("admin.manager.edit", compact("manager"));
    }

    public function update(Request $req)
    {
        // 先檢查帳號是否已經存在(排除自己)
        $managerAccount = Manager::where("account", $req->account)->where("Id", "<>", $req->id)->first();

        if ($managerAccount) {
            return back()->withErrors(["error" => "帳號已存在，請改用其他帳號!"])->withInput();
        }

        // 如果找到了該 Manager 實例，開始更新
        $manager = Manager::find($req->Id);

        if ($manager) {
            // 更新資料，若密碼欄位有值則加密密碼
            $manager->update([
                'Id' => $req->Id,
                'name' => $req->name,
                'account' => $req->account,
                // 如果密碼欄位有值則加密更新，否則保留原密碼
                'password' => $req->password ? Hash::make($req->password) : $manager->password,
                'updateTime' => now()
            ]);


            // 重新回傳route(admon.manager.list)，將設定的提示訊息變數(message)加到session
            return redirect()->route('admin.manager.list')->with("message", "更新成功!");
        }
    }

    public function delete(Request $req)
    {
        // dd($req->all());
        // dd(Manager::find($req->Id));
        Manager::destroy($req->Id);


        // 重新回傳route(admon.manager.list)，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.manager.list')->with("message", "刪除成功!");
    }
}
