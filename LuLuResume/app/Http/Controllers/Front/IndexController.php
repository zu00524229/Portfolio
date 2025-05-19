<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Major;
use App\Models\Majorcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    // 首頁
    public function index()
    {
        $majors = Major::all();                                         // 撈出所有專業資料
        $categories = MajorCategory::all();                             // 撈取MajorCategory
        return view("front.index", compact('majors', 'categories'));    // 傳給前台首頁
    }

    // 登入頁面
    public function login()
    {
        // 顯示front.login頁面
        return view("front.login");
    }

    // 登出頁面 
    public function logout(Request $req)
    {
        Auth::logout(); // 登出Laravel 的認證系統

        // 清除自訂一玩家的session資料
        $req->session()->forget(['playerId', 'managerId', 'nickName', 'point', 'role']);

        // 安全性相關操作:重製session 與 Token
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        // 重新回傳route(front.login)，並套用message
        return redirect()->route('front.login')->with('message', '已成功登出');
    }

    // 登入請求(管理員、玩家)
    public function postLogin(Request $req)
    {
        // 取得帳號與密碼輸入值
        $credentials = $req->only('account', 'password');

        /*
        |--------------------------------------------------
        | 管理員登入流程（優先處理）
        | 使用 Laravel Auth 系統搭配預設 guard（預設會查 managers 資料表）
        |--------------------------------------------------
        */
        // 嘗試登入為管理員
        if (Auth::attempt($credentials)) {
            $manager = Auth::user();

            // 將必要資訊存入 session
            session([
                'managerId' => $manager->Id,
                'nickName' => $manager->name,
                'role' => $manager->role ?? 'admin',
            ]);

            return redirect()->route('front.index')->with('message', '管理員登入成功！');
        }

        /*
        |--------------------------------------------------
        | 玩家登入流程（手動驗證方式）
        | 自行查詢 players 資料表，並比對加密密碼（Hash::check）
        |--------------------------------------------------
        */
        //玩家登入（自行比對 players 表）
        $player = Player::where('account', $credentials['account'])->first();
        if ($player && Hash::check($credentials['password'], $player->password)) {
            //  成功登入玩家，存入 session
            session([
                'playerId' => $player->id,
                'nickName' => $player->nickName,
                'role' => 'player',
            ]);

            session()->save();  // 實務上會自動保存，但加這行保險
            // dd(session()->all());

            return redirect()->route('front.index')->with('message', '玩家登入成功！');
        }

        // 若未通過返回原頁面，登入失敗
        return redirect()->back()->withErrors(['error' => '帳號密碼錯誤']);
    }


    // 顯示忘記密碼
    public function forget()
    {
        return view("front.forget");
    }

    // 處理重設密碼
    public function postForget(Request $req)
    {
        $account = $req->input('account');
        $newPassword = $req->input('newPassword');
        $reNewPassword = $req->input('reNewPassword');

        // 檢查帳號是否存在
        $data = Player::where('account', $account)->first();
        if ($data == null) {
            return back()->withErrors(['front.forget' => '無此帳號，請重新輸入']);
        }

        // 確認密碼是否一致
        if ($newPassword !== $reNewPassword) {
            return back()->withErrors(['front.forget' => '密碼輸入不一致，請重新輸入']);
        }

        // 更新密碼(用 Hash 加密)
        DB::table('players')->where('account', $account)->update([
            'password' => Hash::make($newPassword), // 使用 Hash 加密密碼
        ]);

        // 重新回傳route(front.login)頁面，套用提示訊息 message
        return redirect()->route("front.login")->with('message', '密碼重置成功，請重新登入');
    }
}
