<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactList(Request $req)
    {
        // 檢查是否有搜尋關鍵字
        $keyword = $req->input('keyword');

        // 根據關鍵字搜尋
        $list = Contact::when($keyword, function ($query, $keyword) {
            return $query
                ->where('name', 'like', "%{$keyword}%")
                ->orWhere('phone', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
        })->orderBy('createTime', 'desc')->paginate(10);

        return view('admin.contact.contactList', compact('list'));
    }
}
