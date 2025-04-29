<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Awards;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAwardsController extends Controller
{
    public function list(Request $req)
    {
        $list = Awards::with('product')->where('productId', $req->Id)->paginate(10);
        $product = Product::find($req->Id);
        $allTotalCount = Awards::with('product')->where('productId', $req->Id)->sum('totalCount'); // 計算商品總數總和
        $allStock = Awards::with('product')->where('productId', $req->Id)->sum('stock'); // 計算商品庫存總和
        return view("admin.productAwards.list", compact("list", "product", "allTotalCount", "allStock"));
    }

    public function add(Request $req)
    {
        $list = Awards::with('product')->where('productId', $req->Id)->first();
        $product = Product::find($req->Id);
        return view("admin.productAwards.add", compact("list", "product"));
    }

    public function insert(Request $req)
    {
        // 取得商品資料
        $product = Product::find($req->Id);

        // 確保所有必填欄位的陣列長度一致
        $levels = $req->input('levels', []);
        $names = $req->input('names', []);
        $totalCounts = $req->input('totalCounts', []);

        // 驗證必填欄位的長度是否一致
        if (count($levels) !== count($names) || count($names) !== count($totalCounts)) {
            return redirect()->back()->withErrors('提交的資料不完整，請檢查所有欄位是否正確填寫。');
        }

        // 計算獎項的總數總和
        $totalAwardCount = array_sum($totalCounts);

        // 驗證獎項總數是否等於商品總數
        if ($totalAwardCount !== $product->totalCount) {
            return redirect()->back()->with("error", "獎項總數 ($totalAwardCount) 與商品總數 ({$product->totalCount}) 不一致，請檢查提交的資料。")->withInput();
        }

        // 逐一處理每一筆資料
        for ($i = 0; $i < count($levels); $i++) {
            Awards::create([
                'productId' => $product->Id,
                'level' => $levels[$i],
                'name' => $names[$i],
                'totalCount' => $totalCounts[$i],
                'stock' => $totalCounts[$i] // 預設庫存為總數
            ]);
        }

        // 返回成功訊息
        return redirect("/admin/productAwards/list/{$product->Id}")->with('message', '新增成功!');
    }

    public function edit(Request $req)
    {
        $awards = Awards::with('product')->find($req->Id);
        return view("admin.productAwards.edit", compact("awards"));
    }

    public function update(Request $req)
    {
        $awards = Awards::with('product')->find($req->Id);
        if ($awards) {
            $awards->update([
                'level' => $req->level,
                'name' => $req->name,
                'totalCount' => $req->totalCount,
                'stock' => (($req->totalCount - $req->oldTotalCount) + $req->stock),
                'updateTime' => now()
            ]);

            // 更新成功，重定向
            return redirect("/admin/productAwards/list/{$awards->product->Id}")->with("message", "更新成功!");
        }
    }

    public function delete(Request $req)
    {
        $awards = Awards::with('product')->find($req->Id);
        Awards::destroy($req->Id);
        return redirect("/admin/productAwards/list/{$awards->product->Id}")->with("message", "刪除成功!");
    }
}
