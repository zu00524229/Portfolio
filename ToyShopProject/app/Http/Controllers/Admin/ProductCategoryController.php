<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function list()
    {
        $list = Category::paginate(5);
        return view("admin.productCategory.list", compact("list"));
    }

    public function add()
    {
        return view("admin.productCategory.add");
    }

    public function insert(Request $req)
    {
        // 新增資料
        Category::Create([
            'name' => $req->name,
        ]);
        return redirect("/admin/productCategory/list")->with("message", "新增成功!");
    }

    public function edit(Request $req)
    {
        $list = Category::find($req->Id);
        return view("admin.productCategory.edit", compact("list"));
    }

    public function update(Request $req)
    {
        $list = Category::find($req->Id);
        if ($list) {
            $list->update([
                'name' => $req->name,
                'updateTime' => now()
            ]);
            
            // 更新成功，重定向
            return redirect("/admin/productCategory/list")->with("message", "更新成功!");
        }
    }

    public function delete(Request $req)
    {
        Category::destroy($req->Id);
        return redirect("/admin/productCategory/list")->with("message", "刪除成功!");
    }
}
