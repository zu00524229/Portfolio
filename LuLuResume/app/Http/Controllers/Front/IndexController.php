<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        return view("front.index");
    }

    public function login()
    {
        return view("front.login");
    }

    public function logout(Request $request)
    {
        Auth::logout(); // 登出Laravel 的認證系統

        // 清除自訂一玩家的session資料
        $request->session()->forget(['playerId', 'managerId', 'nickName', 'point', 'role']);

        // 安全性相關操作:重製session 與 Token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.login')->with('message', '已成功登出');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('account', 'password');

        // 管理員登入（Auth 使用 managers 表）
        if (Auth::attempt($credentials)) {
            $manager = Auth::user();

            session([
                'managerId' => $manager->Id,
                'nickName' => $manager->name,
                'role' => $manager->role ?? 'admin',
            ]);

            return redirect()->route('front.index')->with('message', '管理員登入成功！');
        }

        //玩家登入（自行比對 players 表）
        $player = Player::where('account', $credentials['account'])->first();
        if ($player && Hash::check($credentials['password'], $player->password)) {
            session([
                'playerId' => $player->Id,
                'nickName' => $player->nickName,
                'point' => $player->point,
            ]);
            session()->save();
            // dd(session()->all()); 

            return redirect()->route('front.index')->with('message', '玩家登入成功！');
        }
        // 登入失敗
        return redirect()->back()->withErrors(['error' => '帳號密碼錯誤']);
    }

    public function register()
    {
        return view("front.register");
    }

    public function postRegister(Request $request)
    {
        // 從 session 取得 ID
        $playerId = session('playerId');

        // 先檢查帳號是否已經存在
        $managerAccount = Player::where("account", $request->account)->first();

        if ($managerAccount) {
            return back()->with(["accountError" => "帳號已存在，請改用其他帳號!"])->withInput();
        }

        // 新增使用者到資料庫
        Player::create([
            'name' => $request->name,
            'nickName' => $request->nickName,
            'account' => $request->account,
            'password' => bcrypt($request->password),
            'telephone' => $request->telephone,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'role' => 'player', // ✅ 加上這行
            'createTime' => now(),
        ]);

        // 選擇回應 (例如登入或重新導向)
        return redirect()->route('front.login')->with('message', '註冊成功，請登入！');
    }

    public function forget()
    {
        return view("front.forget");
    }

    public function postForget(Request $req)
    {
        $account = $req->input('account');
        $newPassword = $req->input('newPassword');
        $reNewPassword = $req->input('reNewPassword');

        $data = Player::where('account', $account)->first();
        if ($data == null) {
            return back()->withErrors(['front.forget' => '無此帳號，請重新輸入']);
        }

        if ($newPassword !== $reNewPassword) {
            return back()->withErrors(['front.forget' => '密碼輸入不一致，請重新輸入']);
        }

        // 更新密碼
        DB::table('players')->where('account', $account)->update([
            'password' => Hash::make($newPassword), // 使用 Hash 加密密碼
        ]);

        // 更新成功提示
        return redirect()->route("front.login")->with('message', '密碼重置成功，請重新登入');
    }
}
