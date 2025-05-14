<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Majorcategory;
use Illuminate\Http\Request;

class MajorCategoryController extends Controller
{
    // 顯示分類列表
    public function list(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Majorcategory::query();
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $categories = $query->orderBy('updateTime', 'desc')->paginate(10);
        // $category = $categories->first();
        // dd($category->getAttributes());
        return view('admin.major_category.list', compact('categories'));
    }

    // 顯示新增分類表單
    public function add()
    {
        return view('admin.major_category.add');
    }

    // 新增分類
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Majorcategory::create([
            'name' => $request->name,
            'createTime' => now(),
            'updateTime' => now(),
        ]);

        return redirect()->route('admin.major_category.list')->with('message', '新增成功');
    }

    // 顯示編輯頁面
    public function edit($Id) // 大寫 Id 與 route 參數一致
    {
        $category = Majorcategory::findOrFail($Id);
        return view('admin.major_category.edit', compact('category'));
    }

    // 更新分類
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        $category = Majorcategory::findOrFail($request->id);
        $category->update([
            'name' => $request->name,
            'updateTime' => now(),
        ]);

        // dd($request->all()); // 確認有收到資料
        return redirect()->route('admin.major_category.list')->with('message', '更新成功');
    }

    // 刪除分類
    public function delete(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $category = Majorcategory::findOrFail($request->id);
        $category->delete();

        return redirect()->route('admin.major_category.list')->with('message', '刪除成功');
    }
}
