<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LotteryResult;
use App\Models\Player;
use App\Models\Recharge;
use App\Models\Shipping;
use Illuminate\Http\Request;

class AdminPlayerController extends Controller
{
    public function playerList(Request $req)
    {
        // 檢查是否有搜尋關鍵字
        $keyword = $req->input('keyword');

        // 如果關鍵字是性別，將其轉換為數值
        $genderMapping = [
            '男' => 0,
            '女' => 1,
        ];
        // 如果關鍵字對應性別，取得對應的數值，否則為 null
        $genderValue = $genderMapping[$keyword] ?? null;

        // 根據關鍵字搜尋
        $playerList = Player::when($keyword, function ($query) use ($keyword, $genderValue) {
            $query->where(function ($q) use ($keyword, $genderValue) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('nickName', 'like', "%{$keyword}%")
                    ->orWhere('account', 'like', "%{$keyword}%")
                    ->orWhere('telephone', 'like', "%{$keyword}%")
                    ->orWhere('address', 'like', "%{$keyword}%")
                    ->orWhere('point', 'like', "%{$keyword}%")
                    ->orWhere('birthdate', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");

                // 若為性別搜尋，加入條件
                if (!is_null($genderValue)) {
                    $q->orWhere('gender', $genderValue);
                }
            });
        })->paginate(10);

        return view('admin.player.playerList', compact('playerList'));
    }

    public function rechargeList(Request $req)
    {
        $rechargeList = Recharge::with('player')->where("playerId", $req->Id)->paginate(10);

        return view('admin.player.rechargeList', compact('rechargeList'));
    }
}
