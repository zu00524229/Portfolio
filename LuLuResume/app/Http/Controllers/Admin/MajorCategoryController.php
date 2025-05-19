<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Majorcategory;
use Illuminate\Http\Request;

class MajorCategoryController extends Controller
{
    // 顯示分類列表
    public function list(Request $req)
    {
        // 顯示分類列表 (支援關鍵字搜尋)
        $keyword = $req->input('keyword');

        // 建立查詢物件
        $query = Majorcategory::query();

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
            // 模糊搜尋分類名稱
            // 目的讓管理員搜尋分類時，不用輸入全名也能找到
        }

        //  一更新時間排序 + 分頁
        $categories = $query->orderBy('updateTime', 'desc')->paginate(10);
        // $category = $categories->first();
        // dd($category->getAttributes());

        // 回傳admin.major_category.list 頁面，將分類資料傳入給$catrgories變數    ['categories' => $categories]
        // return view('admin.major_category.list', ['categories' => $categories]);
        return view('admin.major_category.list', compact('categories'));
    }

    // 顯示新增分類表單
    public function add()
    {
        return view('admin.major_category.add');        // 回傳admin.major_category.add 頁面
    }

    // 新增分類
    public function insert(Request $req)
    {
        // 表單欄位驗證
        $req->validate([
            'name' => 'required|string|max:255',
        ]);

        // 建立資料(含建立/更新時間)
        Majorcategory::create([
            'name' => $req->name,
            'createTime' => now(),
            'updateTime' => now(),
        ]);

        // 重新導向->rout(admin,major_category.list)，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.major_category.list')->with('message', '新增成功');
    }

    // 顯示分類編輯頁面
    public function edit($Id)
    {
        // 根據 ID 撈出指定分類資料（找不到會自動拋出 404）
        $category = Majorcategory::findOrFail($Id);

        // 回傳 admin.major_category.edit 頁面，並將分類資料傳入給 $category 變數
        return view('admin.major_category.edit', compact('category'));
    }

    // 更新分類頁面
    public function update(Request $req)
    {
        // 驗證資料
        $req->validate([
            'id' => 'required|integer',                     // 必須提供分類ID，且為整數
            'name' => 'required|string|max:255',            // 分類名稱為避填字串，限制255字元
        ]);


        // 根據id撈出資料(若不存在會拋出404)
        $category = Majorcategory::findOrFail($req->id);

        // 更希資料表中的 name 與 updateTime 欄位
        $category->update([
            'name' => $req->name,
            'updateTime' => now(),    // Laravel 的now() 會產生當下時間  
        ]);

        // dd($request->all()); // 確認有收到資料
        // 重新回傳admin.major_category.list，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.major_category.list')->with('message', '更新成功');
    }

    // 刪除分類
    public function delete(Request $req)
    {
        // 驗證id
        $req->validate(['id' => 'required|integer']);

        // 根據id撈出資料(找不到會拋出404)
        $category = Majorcategory::findOrFail($req->id);

        // 執行資料刪除
        $category->delete();

        // 重新回傳admin.major_category.list，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.major_category.list')->with('message', '刪除成功');
    }
}
