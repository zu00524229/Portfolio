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

    public function lotteryList(Request $req)
    {
        $lotteryList = LotteryResult::with('awards.product', 'player')
            ->where("playerId", $req->Id)
            ->orderBy('createTime', 'desc')
            ->paginate(10);
        return view('admin.player.lotteryList', compact('lotteryList'));
    }

    public function shippingList(Request $req)
    {
        // 根據 ID 查詢玩家出貨資料
        $shippingList = Shipping::with('player')
            ->where("playerId", $req->Id)
            ->orderBy('createTime', 'desc') // 按 createTime 降序排序
            ->paginate(5);

        // 初始化一個空的陣列來存放每筆出貨資料的對應抽獎結果
        $shippingResults = [];

        // 收集每筆資料中的 lotteryIds，並查詢對應的 LotteryResult
        foreach ($shippingList as $shipping) {
            // 將每個出貨資料中的 lotteryIds 字串轉換為陣列
            $lotteryIds = explode(',', $shipping->lotteryIds);

            // 查詢對應的 LotteryResult
            $lotteryResults = LotteryResult::with('awards.product')
                ->whereIn('Id', $lotteryIds)
                ->get();

            // 將每筆出貨資料及對應的 LotteryResult 儲存起來
            $shippingResults[] = [
                'shipping' => $shipping,
                'lotteryResults' => $lotteryResults,
            ];
        }

        // 傳遞資料到視圖
        return view("admin.player.shippingList", compact('shippingList', 'shippingResults'));
    }

    public function rechargeAllList(Request $req)
    {
        // 檢查是否有搜尋關鍵字
        $keyword = $req->input('keyword');

        // 將其轉換為數值(1:信用卡付款、2:LINEPay、3:超商繳費)	
        $paymentTypeMapping = [
            '信用卡付款' => 1,
            'LINEPay' => 2,
            '超商繳費' => 3,
        ];

        // 根據關鍵字對應的付款方式數值，否則為 null
        $paymentTypeValue = $paymentTypeMapping[$keyword] ?? null;

        // 根據關鍵字搜尋
        $list = Recharge::with('player')
            ->when($keyword, function ($query) use ($keyword, $paymentTypeValue) {
                $query->where(function ($q) use ($keyword, $paymentTypeValue) {
                    // 搜尋 Recharge 資料表中的 point 欄位
                    $q->where('point', 'like', "%{$keyword}%")
                        ->orwhere('Id', 'like', "%{$keyword}%")
                        // 查詢關聯模型 Player 的 name 和 account 欄位
                        ->orWhereHas('player', function ($q) use ($keyword) {
                            $q->where('name', 'like', "%{$keyword}%")
                                ->orWhere('account', 'like', "%{$keyword}%");
                        });

                    // 如果有對應的付款方式，搜尋 paymentType 欄位
                    if (!is_null($paymentTypeValue)) {
                        $q->orWhere('paymentType', $paymentTypeValue);
                    }
                });
            })
            ->paginate(10);

        return view('admin.player.rechargeAllList', compact('list'));
    }

    public function lotteryAllList(Request $req)
    {
        $query = LotteryResult::with('awards.product', 'player');

        // 根據選擇的出貨狀態進行過濾
        if ($req->filled('enableShip')) {  // 使用 filled() 檢查是否有傳入出貨狀態
            $query->where('enableShip', $req->enableShip);
        }

        $lotteryList = $query->paginate(10);

        return view('admin.player.lotteryAllList', compact('lotteryList'));
    }


    public function shippingAllList(Request $req)
    {
        // 檢查是否有搜尋關鍵字
        $keyword = $req->input('keyword');

        // 查詢出貨資料
        $query = Shipping::with('player')->orderBy('createTime', 'desc');

        // 如果有關鍵字，篩選出貨資料
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('Id', 'like', "%$keyword%") // 尋找 Shipping 的 Id
                    ->orWhereHas('player', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'like', "%$keyword%") // 玩家名字
                            ->orWhere('account', 'like', "%$keyword%"); // 玩家帳號
                    });
            });
        }

        // 根據 ID 查詢玩家出貨資料
        $shippingList = $query->paginate(5);

        // 初始化一個空的陣列來存放每筆出貨資料的對應抽獎結果
        $shippingResults = [];

        // 收集每筆資料中的 lotteryIds，並查詢對應的 LotteryResult
        foreach ($shippingList as $shipping) {
            // 將每個出貨資料中的 lotteryIds 字串轉換為陣列
            $lotteryIds = explode(',', $shipping->lotteryIds);

            // 查詢對應的 LotteryResult
            $lotteryResults = LotteryResult::with('awards.product', 'player')
                ->whereIn('Id', $lotteryIds)
                ->get();

            // 將每筆出貨資料及對應的 LotteryResult 儲存起來
            $shippingResults[] = [
                'shipping' => $shipping,
                'lotteryResults' => $lotteryResults,
            ];
        }

        // 傳遞資料到視圖
        return view("admin.player.shippingAllList", compact('shippingList', 'shippingResults'));
    }
}
