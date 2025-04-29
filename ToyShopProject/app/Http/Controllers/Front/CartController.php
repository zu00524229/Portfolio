<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\LotteryResult;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function list()
    {
        // 從 session 取得 ID
        $playerId = session()->get('playerId');
        $list = LotteryResult::with('awards.product', 'player')
            ->where('playerId', $playerId)
            ->where('enableShip', '!=', 1)
            ->get();

        return view('front.cart.list', compact('list'));
    }

    public function shipping(Request $req)
    {
        // 從 session 取得 ID
        $playerId = session()->get('playerId');
        // 獲取所有的抽獎編號
        $lotteryIds = $req->input('lotteryId');

        // 建立一個空陣列來存放獎項的到貨天數
        $shippingDaysPool = [];

        foreach ($lotteryIds as $lotteryId) {
            // 獲取抽獎結果及相關獎項資料
            $lotteryResult = LotteryResult::with('awards.product')->where('Id', $lotteryId)->first();

            if ($lotteryResult && $lotteryResult->awards && $lotteryResult->awards->product) {
                // 獲取商品的出貨天數，假設有一個 `shippingDays` 欄位
                $shippingDays = $lotteryResult->awards->product->shippingDays;

                // 如果 shippingDays 有效，加入到陣列中
                if (!is_null($shippingDays)) {
                    $shippingDaysPool[] = $shippingDays;
                }

                // 將該抽獎結果的 enableShip 欄位設為 1 (已出貨)
                $lotteryResult->enableShip = 1;
                $lotteryResult->save(); // 儲存更新
            }
        }

        // 找出最大到貨天數
        $maxShippingDays = max($shippingDaysPool);

        // 計算到貨日期 (現在時間 + 最大天數)，僅保留年月日
        $arrivalDate = now()->addDays($maxShippingDays)->toDateString();

        // 將多個抽獎編號合併成字串（以逗號分隔），並儲存到資料庫
        $lotteryIdsString = implode(',', $lotteryIds);

        // 建立出貨記錄
        Shipping::create([
            "playerId" => $playerId,
            "lotteryIds" => $lotteryIdsString,
            "arrivalDate" => $arrivalDate
        ]);

        return redirect()->back()->with('message', '出貨成功!');
    }
}
