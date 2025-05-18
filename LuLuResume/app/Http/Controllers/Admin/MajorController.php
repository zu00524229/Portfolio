<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\MajorCategory;
use Illuminate\Support\Facades\Storage;

class MajorController extends Controller
{
    public function list()
    {
        $majors = Major::with('majorCategory')->orderBy('createTime', 'desc')->paginate(10);
        return view('admin.major.list', compact('majors'));
    }

    public function add()
    {
        $categories = MajorCategory::all();
        return view('admin.major.add', compact('categories'));
    }

    public function insert(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'majorId' => 'required|exists:majorcategories,id',
            'name' => 'required',
            'photo' => 'nullable|image',
            'content' => 'nullable|string',
        ]);

        $photoPath = null;
        if ($req->hasFile('photo')) {
            $photoPath = $req->file('photo')->store('majors', 'public');
        }

        Major::create([
            'majorId' => $req->majorId,
            'name' => $req->name,
            'photo' => $photoPath,
            'content' => $req->content,
            'createTime' => now(),
        ]);

        return redirect()->route('admin.major.list')->with('message', '新增成功！');
    }

    public function edit(Request $req)
    {
        $major = Major::findOrFail($req->id);
        $categories = MajorCategory::all();
        return view('admin.major.edit', compact('major', 'categories'));
    }

    public function update(Request $req)
    {
        $major = Major::findOrFail($req->id);

        $req->validate([
            'name' => 'required',
            'photo' => 'nullable|image',
            'content' => 'nullable|string',
        ]);

        if ($req->hasFile('photo')) {
            // 刪除舊圖
            if ($major->photo) {
                Storage::disk('public')->delete($major->photo);
            }
            $major->photo = $req->file('photo')->store('majors', 'public');
        }

        $major->majorId = $req->input('majorId');
        $major->name = $req->name;
        $major->content = $req->content;
        $major->updateTime = now();
        $major->save();

        return redirect()->route('admin.major.list')->with('message', '更新成功！');
    }

    public function delete(Request $req)
    {
        // dd($req->all());
        $major = Major::findOrFail($req->id);
        if ($major->photo) {
            Storage::disk('public')->delete($major->photo);
        }
        $major->delete();
        return redirect()->route('admin.major.list')->with('message', '刪除成功！');
    }
}
