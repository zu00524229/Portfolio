<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function logout()
    {
        // 清除 session
        session()->flush();
        return redirect()->route('front.index')->with('message', "成功登出!");
    }

    public function postLogin(Request $request)
    {
        // 驗證帳號密碼
        $account = $request->input('account');
        $password = $request->input('password');

        $player = Player::where('account', $account)->first();

        if ($player && Hash::check($password, $player->password)) {
            // 登入成功，儲存 session
            session(['playerId' => $player->Id, 'point' => $player->point, 'nickName' => $player->nickName]);

            // 檢查是否有儲存 intended_url，若有則重定向回該頁面，否則重定向到首頁
            $redirectUrl = session()->get('intended_url', route('front.index')); // 預設重定向到首頁
            session()->forget('intended_url'); // 登入後清除 intended_url

            return redirect($redirectUrl)->with('message', '成功登入！');
        } else {
            // 登入失敗
            return back()->withInput()->withErrors(['error' => '帳號或密碼錯誤']);
        }
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
            "name" => $request->name,
            "nickName" => $request->nickName,
            "account" => $request->account,
            "password" => Hash::make($request->password), // 使用用戶輸入的密碼
            "telephone" => $request->telephone,
            "address" => $request->address,
            "gender" => $request->gender,
            "email" => $request->email,
            "birthdate" => $request->birthdate,
            "createTime" => now(),
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

    public function contact(Request $req) 
    {
        Contact::create([
            "name" => $req->name,
            "phone" => $req->phone,
            "email" => $req->email,
            "message" => $req->message,
        ]);

        return redirect()->route("front.index")->with('message', '您的建議已經成功送出囉!');
    }
}
