<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    public function playerInfo(Request $req)
    {
        // 從 session 取得 ID
        $playerId = session('playerId');

        // 根據 ID 查詢玩家資料
        $player = Player::where("Id", $playerId)->first();

        // 根據 ID 查詢玩家儲值資料
        $rechargeData = Recharge::with('player')
            ->where("playerId", $playerId)
            ->orderBy('createTime', 'desc') // 按 createTime 降序排序
            ->paginate(5);

        return view("front.player.playerInfo", compact('player', 'rechargeData'));
    }

    public function recharge()
    {
        return view("front.player.recharge");
    }

    public function postrecharge(Request $req)
    {
        // 從 session 取得 ID
        $playerId = session('playerId');
        $point = $req->input('point');
        $paymentType = $req->input('paymentType');

        if (!$point) {
            return back()->withErrors(['error' => '請先選擇代幣數量！']);
        }

        if (!$paymentType) {
            return back()->withErrors(['error' => '請先選擇付款方式！']);
        }

        // 取得當前登入的玩家
        $player = Player::where("Id", $playerId)->first();

        // 更新玩家的點數
        $player->point += $req->point;
        $player->save();

        // 更新 session 的玩家點數
        session(['point' => $player->point]);

        // 創建儲值記錄
        Recharge::create([
            'playerId' => $player->Id,
            'paymentType' => $req->paymentType,
            'point' => $req->point,
            'createTime' => now(),
        ]);
        return redirect("/front/player/playerInfo")->with('message', '您的點數已經加值成功!');
    }

    public function edit()
    {
        // 從 session 取得 ID
        $playerId = session('playerId');
        $player = Player::where("Id", $playerId)->first();

        return view("front.player.playerInfoEdit", compact("player"));
    }

    public function update(Request $req)
    {
        // 從 session 取得 ID
        $playerId = session('playerId');
        $player = Player::where("Id", $playerId)->first();

        // 先檢查帳號是否已經存在
        $managerAccount = Player::where("account", $req->account)->where("Id", "<>", $playerId)->first();

        if ($managerAccount) {
            return back()->with(["accountError" => "帳號已存在，請改用其他帳號!"])->withInput();
        }

        if ($player) {
            // 更新 session 的玩家名稱
            session(['nickName' => $req->nickName]);

            // 更新產品資料
            $player->update([
                "name" => $req->name,
                "nickName" => $req->nickName,
                "account" => $req->account,
                "password" => Hash::make($req->password), // 使用用戶輸入的密碼
                "telephone" => $req->telephone,
                "address" => $req->address,
                "gender" => $req->gender,
                "email" => $req->email,
                "birthdate" => $req->birthdate,
                "updateTime" => now(),
            ]);

            return redirect("/front/player/playerInfo")->with("message", "資料更新成功!");
        }
    }
}
