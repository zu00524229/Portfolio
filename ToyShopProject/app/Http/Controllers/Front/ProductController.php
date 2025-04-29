<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Awards;
use App\Models\Category;
use App\Models\LotteryResult;
use App\Models\Player;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productAllList(Request $req)
    {
        $query = Product::query();
        // 如果有關鍵字搜尋
        if ($req->filled('keyword')) {
            $keyword = $req->input('keyword');
            $query->where('name', 'like', "%$keyword%")->orWhere('point', 'like', "%$keyword%");
        }

        // 如果需要同時獲取商品資料，可以一併查詢
        $productsByUpdateTime = Product::orderBy('createTime', 'desc')->take(8)->get();
        $products = Product::paginate(12); // 用 paginate 來分頁
        $categories = Category::all();
        $keywordProduct = $query->get();

        return view('front.product.productAllList', compact('products', 'categories', 'productsByUpdateTime', 'keywordProduct'));
    }

    public function productCategoryList(Request $req)
    {
        // 取得所有分類資料
        $categories = Category::all();

        // 確保分類存在
        $category = Category::with('products')->findOrFail($req->Id);

        // 基本的分類商品查詢
        $query = $category->products();

        // 如果有關鍵字搜尋
        if ($req->filled('keyword')) {
            $keyword = $req->input('keyword');
            // 針對名稱或點數進行關鍵字搜尋
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('point', 'like', "%$keyword%");
            });
        }

        // 分頁查詢分類下的商品
        $products = $category->products()->paginate(12);
        $keywordProduct = $query->get();

        return view('front.product.productCategoryList', compact('category', 'products', 'categories', 'keywordProduct'));
    }

    public function productList(Request $req)
    {
        $categories = Category::all();
        $award = Awards::where('productId', (int)$req->Id)->orderBy('level', 'ASC')->get();  //更改資料型別才能顯示
        // 根據商品ID獲取該商品及其相關資料
        $products = Product::with('award')->find($req->Id); // 確保該商品存在
        $totalStock = $award->sum('stock');       // 總剩餘數
        $totalCount = $award->sum('totalCount'); // 總獎項數
        session()->put('productId', $req->Id);

        return view('front.product.productList', compact('award', 'products', 'totalCount', 'totalStock', 'categories')); // 傳遞商品和獎項資料
    }

    public function lottery(Request $req)
    {
        // 確保有提交參數
        $number = $req->input('number');
        $awards = Awards::where('productId', $req->productId)->get();
        $productId = $req->productId;
        if (!empty($productId)) {
            session()->put("productId", $productId);
        }

        if (empty($productId)) {
            $productId = session()->get("productId");
        }

        $product = Product::where('Id', $productId)->first();


        // 從 session 取得 ID
        $playerId = session()->get('playerId');
        // 取得當前登入的玩家
        $player = Player::where("Id", $playerId)->first();

        // 確認玩家點數是否足夠
        if ($player->point < ($product->point * $number)) {
            return back()->withErrors(['error' => '點數不足，請先去儲值專區加值！']);
        }

        // 儲存抽獎結果
        $lotteryResults = [];

        // 重新計算每次抽獎時的獎池
        for ($i = 0; $i < $number; $i++) {
            // 建立一個空陣列來存放所有可抽獎的項目
            $prizePool = [];

            // 將每個獎項依照其 stock 數量加入獎池
            foreach ($awards as $award) {
                for ($j = 0; $j < $award->stock; $j++) {
                    $prizePool[] = $award;
                }
            }

            // 如果獎池為空，則停止抽獎
            if (count($prizePool) == 0) {
                return back()->withErrors(['error' => '此商品已經全部售完，請選擇其他商品!']);
            }

            // 隨機抽取獎項
            $randomKey = array_rand($prizePool);

            // 抽中的獎項
            $winner = $prizePool[$randomKey];

            // 更新獎項庫存
            $winner->stock--;
            $winner->save();

            // 更新商品庫存
            $product->stock--;
            $product->save();

            // 更新玩家點數
            $player->point -= $product->point;
            $player->save();

            // 儲存每次抽中的結果
            LotteryResult::create([
                'playerId' => $player->Id,
                'awardsId' => $winner->Id,
            ]);

            // 將抽中的獎品結果儲存到結果陣列
            $lotteryResults[] = [
                'name' => $winner->name,
                'level' => $winner->level,
            ];
        }

        // 更新 session 的玩家點數
        session(['point' => $player->point]);

        return redirect("/front/product/productList/{$productId}")->with('lotteryResults', $lotteryResults);
    }
}
