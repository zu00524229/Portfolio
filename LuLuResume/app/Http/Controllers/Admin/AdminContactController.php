<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    // 聯絡資料列表
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $contacts = Contact::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('subject', 'like', "%{$keyword}%")
                ->orWhere('message', 'like', "%{$keyword}%");
        })->latest()->paginate(10);

        return view('admin.contact.list', compact('contacts'));
    }

    // 編輯表單
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));
    }

    // 更新聯絡資料
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->only([
            'name',
            'email',
            'phone',
            'line',
            'subject',
            'message'
        ]));

        return redirect()->route('admin.contact.list')->with('message', '更新成功!');
    }

    // 刪除聯絡資料
    public function delete(Request $request)
    {
        Contact::destroy($request->id);
        return redirect()->route('admin.contact.list')->with('message', '刪除成功!');
    }
}
