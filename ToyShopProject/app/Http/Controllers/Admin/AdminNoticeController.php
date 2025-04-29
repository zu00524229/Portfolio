<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class AdminNoticeController extends Controller
{
    public function list(Request $req)
    {
        // 檢查是否有搜尋關鍵字
        $keyword = $req->input('keyword');

        // 根據關鍵字搜尋
        $list = Notice::when($keyword, function ($query, $keyword) {
            return $query
                ->where('title', 'like', "%{$keyword}%")
                ->orWhere('subtitle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%");
        })->paginate(10);
        
        return view("admin.notice.list", compact("list"));
    }

    public function add()
    {
        return view("admin.notice.add");
    }

    public function insert(Request $req)
    {
        // 處理圖片並進行編碼
        $photo = $req->photo;
        $fileName = time() . "." . $photo->getClientOriginalExtension();

        // 確保目錄存在，使用遞迴建立目錄
        $directory = public_path("admin/images/notice");
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // 將圖片移動到指定目錄
        $photo->move($directory, $fileName);

        // 新增資料
        Notice::Create([
            'title' => $req->title,
            'subtitle' => $req->subtitle,
            'photo' => $fileName,
            'content' => $req->content
        ]);
        return redirect("/admin/notice/list")->with("message", "新增成功!");
    }

    public function edit(Request $req)
    {
        $notice = Notice::find($req->Id);
        return view("admin.notice.edit", compact("notice"));
    }

    public function update(Request $req)
    {
        $notice = Notice::find($req->Id);
        if ($notice) {

            // 檢查是否有新的圖片上傳
            if ($req->hasFile('photo')) {
                // 確保圖片目錄存在
                $directory = public_path("admin/images/notice");

                // 刪除舊的圖片檔案
                $oldPhotoPath = $directory . '/' . $notice->photo;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }

                // 上傳新的圖片
                $newPhoto = $req->file('photo');
                $newPhotoName = time() . "." . $newPhoto->getClientOriginalExtension();
                $newPhoto->move($directory, $newPhotoName);

                // 更新資料庫中的圖片路徑
                $notice->photo = $newPhotoName;
            }

            $notice->update([
                'title' => $req->title,
                'subtitle' => $req->subtitle,
                'content' => $req->content,
                'updateTime' => now()
            ]);

            // 儲存圖片路徑
            $notice->save();

            // 更新成功，重定向
            return redirect("/admin/notice/list")->with("message", "更新成功!");
        }
    }

    public function delete(Request $req)
    {
        Notice::destroy($req->Id);
        return redirect("/admin/notice/list")->with("message", "刪除成功!");
    }
}
