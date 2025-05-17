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

                if (!is_null($genderValue)) {
                    $q->orWhere('gender', $genderValue);
                }
            });
        })->paginate(10);

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

        $player = Player::findOrFail($id);
        $player->update([
            'name' => $req->name,
            'nickName' => $req->nickName,
            'account' => $req->account,
            'password' => $req->filled('password') ? Hash::make($req->password) : $player->password,
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
