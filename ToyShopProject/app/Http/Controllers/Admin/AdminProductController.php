<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Awards;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminProductController extends Controller
{
    public function list(Request $req)
    {
        // 檢查是否有搜尋關鍵字
        $keyword = $req->input('keyword');

        // 根據關鍵字搜尋
        $list = Product::with('category')->when($keyword, function ($query, $keyword) {
            return $query
                ->where('name', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orWhere('point', 'like', "%{$keyword}%")
                ->orWhereHas('category', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
        })->paginate(10);

        return view("admin.product.list", compact("list"));
    }

    public function add()
    {
        $categories = Category::all();
        return view("admin.product.add", compact("categories"));
    }

    public function insert(Request $req)
    {
        // 處理圖片並進行編碼
        $photos = $req->file('photos'); // 取得所有上傳的圖片
        $photoNames = []; // 用來儲存所有圖片的檔案名稱

        if ($photos) {
            // 確保目錄存在，使用遞迴建立目錄
            $directory = public_path("admin/images/product");
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // 逐一處理每張圖片
            foreach ($photos as $photo) {
                // 取得檔案名稱
                $fileName = time() . rand(1000, 9999) . "." . $photo->getClientOriginalExtension();

                // 將圖片移動到指定目錄
                $photo->move($directory, $fileName);

                // 儲存檔案名稱
                $photoNames[] = $fileName;
            }
        }

        // 將多個圖片名稱合併成字串（以逗號分隔），並儲存到資料庫
        $photoNamesString = implode(',', $photoNames);

        // 新增資料
        Product::Create([
            "name" => $req->name,
            "content" => $req->content,
            "point" => $req->point,
            "photo" => $photoNamesString,
            "categoryId" => $req->categoryId,
            "totalCount" => $req->totalCount,
            "stock" => $req->totalCount,
            "shippingDays" => $req->shippingDays
        ]);

        return redirect("/admin/product/list")->with("message", "新增成功!");
    }

    public function edit(Request $req)
    {
        $product = Product::with('category')->find($req->Id);
        $photos = $product->photo ? explode(',', $product->photo) : [];
        $categories = Category::all();
        return view("admin.product.edit", compact("product", "categories", "photos"));
    }

    public function update(Request $req)
    {
        $product = Product::find($req->Id);
        if ($product) {
            $directory = public_path("admin/images/product");

            // 確保圖片目錄存在
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // 處理新上傳的圖片
            $newPhotos = $req->file('photos');
            $newPhotoNames = [];

            if ($newPhotos) {
                // 刪除舊的圖片
                $existingPhotos = $product->photo ? explode(',', $product->photo) : [];
                foreach ($existingPhotos as $oldPhoto) {
                    $oldPhotoPath = $directory . '/' . $oldPhoto;
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath); // 刪除舊圖片檔案
                    }
                }

                // 上傳新圖片
                foreach ($newPhotos as $photo) {
                    $fileName = time() . rand(1000, 9999) . '.' . $photo->getClientOriginalExtension();
                    $photo->move($directory, $fileName);
                    $newPhotoNames[] = $fileName;
                }
            } else {
                // 若未選擇新圖片，保留目前的圖片
                $newPhotoNames = $product->photo ? explode(',', $product->photo) : [];
            }

            // 將多個圖片名稱合併成字串（以逗號分隔），並儲存到資料庫
            $photoNamesString = implode(',', $newPhotoNames);

            // 更新產品資料
            $product->update([
                "name" => $req->name,
                "content" => $req->content,
                "point" => $req->point,
                "photo" => $photoNamesString,
                "categoryId" => $req->categoryId,
                "totalCount" => $req->totalCount,
                'stock' => (($req->totalCount - $req->oldTotalCount) + $req->stock),
                "shippingDays" => $req->shippingDays,
                'updateTime' => now()
            ]);

            return redirect("/admin/product/list")->with("message", "更新成功!");
        }

        return redirect("/admin/product/list")->with("error", "產品未找到!");
    }


    public function delete(Request $req)
    {
        // 找到要刪除的產品
        $product = Product::find($req->Id);

        // 檢查是否有與該產品相關的獎項資料
        $awardCount = Awards::where('productId', $product->Id)->count();

        if ($awardCount > 0) {
            // 如果有相關獎項資料，顯示錯誤訊息
            Session::flash("error", "此產品仍有獎項資料，<br>請先刪除相關獎項資料!");
            return redirect("/admin/product/list");
        }

        if ($product) {
            $directory = public_path("admin/images/product");

            // 取得並刪除該產品的圖片
            $existingPhotos = $product->photo ? explode(',', $product->photo) : [];
            foreach ($existingPhotos as $oldPhoto) {
                $oldPhotoPath = $directory . '/' . $oldPhoto;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath); // 刪除圖片檔案
                }
            }

            // 刪除資料庫中的產品資料
            $product->delete();

            return redirect("/admin/product/list")->with("message", "刪除成功!");
        }
    }
}
