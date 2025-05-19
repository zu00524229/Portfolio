<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\MajorCategory;
use Illuminate\Support\Facades\Storage;

class MajorController extends Controller
{
    // 列出所有專業資料（含分類資料），用最新建立時間排序
    public function list()
    {
        $majors = Major::with('majorCategory')->orderBy('createTime', 'desc')->paginate(10);

        // 回傳至admin.major.add，並帶入$majors 變數
        return view('admin.major.list', compact('majors'));
    }

    // 顯示新增頁面，載入所有分類供選擇
    public function add()
    {
        $categories = MajorCategory::all(); // MajorCategory所有資料放入$categories變數

        // 回傳至admin.major.add，並帶入$categories 變數
        return view('admin.major.add', compact('categories'));
    }

    // 新增一筆專業資料（含圖片上傳）
    public function insert(Request $req)
    {
        // 驗證欄位
        $req->validate([
            'majorId' => 'required|exists:majorcategories,id',
            'name' => 'required',
            'photo' => 'nullable|image',    // 圖片非必填，但若有要是圖檔
            'content' => 'nullable|string',
        ]);

        $photoPath = null;

        // 若有圖片上傳，儲存到 storage/app/public/majors/
        if ($req->hasFile('photo')) {
            $photoPath = $req->file('photo')->store('majors', 'public');
            // 儲存結果類似：majors/20240521_xxx.jpg（用於 Blade 顯示）
        }

        // 儲存資料進資料庫（圖檔路徑會存到 photo 欄位）
        Major::create([
            'majorId' => $req->majorId,
            'name' => $req->name,
            'photo' => $photoPath,          // 圖片路徑存進資料庫
            'content' => $req->content,
            'createTime' => now(),
        ]);

        // 重新回傳route(admin.major.list)，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.major.list')->with('message', '新增成功！');
    }

    // 顯示編輯畫面，帶入該筆資料與分類選項
    public function edit(Request $req)
    {
        $major = Major::findOrFail($req->id);   // 撈出要編輯的id資料

        // 用於新增表單的下拉選單
        $categories = MajorCategory::all(); // MajorCategory所有資料放入$categories變數

        // 回傳admin.major.edit頁面，並導入資料$major、$catejories 變數
        return view('admin.major.edit', compact('major', 'categories'));
    }

    // 更新專業資料（可更新圖片）
    public function update(Request $req)
    {
        $major = Major::findOrFail($req->id);

        // 驗證輸入
        $req->validate([
            'name' => 'required',
            'photo' => 'nullable|image',
            'content' => 'nullable|string',
        ]);

        // 如果有上傳新圖片，先刪除舊圖片，再儲存新圖
        if ($req->hasFile('photo')) {
            if ($major->photo) {
                Storage::disk('public')->delete($major->photo); // 刪除舊圖
            }

            // 儲存新圖到 storage/app/public/majors/，回傳相對路徑
            $major->photo = $req->file('photo')->store('majors', 'public');
        }

        // 更新其他欄位（分類、名稱、內容、更新時間）
        $major->majorId = $req->input('majorId');
        $major->name = $req->name;
        $major->content = $req->content;
        $major->updateTime = now();
        $major->save();

        // 重新回傳route(admon.major.list)，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.major.list')->with('message', '更新成功！');
    }

    // 刪除該筆資料（同時刪除圖片）
    public function delete(Request $req)
    {
        $major = Major::findOrFail($req->id);

        // 若該筆有圖片，一併刪除
        if ($major->photo) {
            Storage::disk('public')->delete($major->photo);
        }

        $major->delete();   // 刪除資料

        // 重新回傳route(admon.major.list)，將設定的提示訊息變數(message)加到session
        return redirect()->route('admin.major.list')->with('message', '刪除成功！');
    }
}
