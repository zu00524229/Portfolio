<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPlayerController extends Controller
{
    // 會員列表
    public function list(Request $request)
    {

        $keyword = $request->input('keyword');
        // 支援使用者輸入"男"或"女"來查詢對應會員
        $genderMapping = ['男' => 0, '女' => 1];
        $genderValue = $genderMapping[$keyword] ?? null;

        $playerList = Player::when($keyword, function ($query) use ($keyword, $genderValue) {
            $query->where(function ($q) use ($keyword, $genderValue) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('nickName', 'like', "%{$keyword}%")
                    ->orWhere('account', 'like', "%{$keyword}%")
                    ->orWhere('telephone', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('birthdate', 'like', "%{$keyword}%");

                // 如果有符合的性別關鍵字，加入性別搜尋條件
                if (!is_null($genderValue)) {
                    $q->orWhere('gender', $genderValue);
                }
            });
        })->paginate(10);   // 每頁 10 筆 (分頁)

        return view('admin.player.list', compact('playerList'));
    }

    // 顯示會員資料編輯頁
    public function edit($id)
    {
        $player = Player::findOrFail($id);
        return view('admin.player.edit', compact('player'));
    }

    // 更新會員資料
    public function update(Request $req, $id)
    {
        $playerAccount = Player::where("account", $req->account)->where("id", "<>", $id)->first();
        if ($playerAccount) {
            return back()->withErrors(["error" => "帳號已存在，請使用其他帳號"])->withInput();
        }

        // 驗證機制
        $req->validate([
            'name' => 'required|string|max:255',
            'account' => 'required|string|max:50',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:20',
        ]);

        $player = Player::findOrFail($id);
        $player->update([
            'name' => $req->name,
            'nickName' => $req->nickName,
            'account' => $req->account,
            'password' => $req->filled('password') ? Hash::make($req->password) : $player->password,
            // 如果管理員有輸入密碼，就加密更新。如果沒有，保留原本密碼
            'telephone' => $req->telephone,
            'email' => $req->email,
            'address' => $req->address,
            'gender' => $req->gender,
            'birthdate' => $req->birthdate,
            'updateTime' => now(),
            'role' => $req->role ?? $player->role,
        ]);

        return redirect()->route('admin.player.list')->with('message', '會員資料更新成功');
    }

    // 刪除會員資料
    public function delete(Request $req)
    {
        Player::destroy($req->id);
        return redirect()->route('admin.player.list')->with('message', '會員已刪除');
    }
}
