<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    // 會員專區首頁
    public function dashboard()
    {
        $playerId = session('playerId');
        if (!$playerId) {
            return redirect()->route('front.login')->withErrors(['error' => '請先登入會員']);
        }

        $player = Player::find($playerId);
        return view('front.player.dashboard', compact('player'));
    }

    // 修改個人資料表單
    public function edit()
    {
        $playerId = session('playerId');
        if (!$playerId) {
            return redirect()->route('front.login')->withErrors(['error' => '請先登入會員']);
        }

        $player = Player::find($playerId);
        return view('front.player.edit', compact('player'));
    }

    // 儲存會員資料
    public function update(Request $req)
    {
        $playerId = session('playerId');
        if (!$playerId) {
            return redirect()->route('front.login')->withErrors(['error' => '請先登入會員']);
        }

        $player = Player::find($playerId);

        $req->validate([
            'name' => 'required|string|max:255',
            'nickName' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $player->update([
            'name' => $req->name,
            'nickName' => $req->nickName,
            'email' => $req->email,
            'telephone' => $req->telephone,
            'address' => $req->address,     //住址
            'birthdate' => $req->birthdate,
            'updateTime' => now(),
            'password' => $req->password ? Hash::make($req->password) : $player->password,
        ]);

        session(['nickName' => $player->nickName]);

        return redirect()->route('front.player.dashboard')->with('message', '會員資料更新成功！');
    }

    // 玩家註冊資料處理
    public function postRegister(Request $request)
    {
        // 檢查帳號是否重複
        if (Player::where('account', $request->account)->exists()) {
            return back()->with('accountError', '帳號已被使用')->withInput();
        }

        // 建立新玩家資料
        Player::create([
            'name' => $request->name,
            'nickName' => $request->nickName,
            'account' => $request->account,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'createTime' => now(),
            'updateTime' => now(),
        ]);

        return redirect('/front/login')->with('message', '註冊成功！請登入');
    }
}
