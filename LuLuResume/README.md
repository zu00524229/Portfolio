# 💼 SoulAdmin 個人專業網站 (Laravel 專案)

這是一個使用 Laravel 框架開發的個人網站框架，原始動機是為了幫女友建立一個整合自我介紹、專業經歷與服務項目的網站平台，也同時作為我學習 Laravel 的實戰練習。

目前都還在施工中...

## 🔧 專案架構特色

-   使用 **Laravel 10.x** 開發
-   前台版型參考 [BootstrapMade - NiceSchool](https://bootstrapmade.com/nice-school-bootstrap-education-template/)
-   完整後台管理系統，包含：
    -   專業分類管理（MajorCategory）
    -   專業內容管理（Major）
    -   管理者登入驗證中介層（Middleware）
    -   Session 判斷顯示「後台專區」、「使用者暱稱」、「登入狀態切換」
    -   後台可建立員工帳戶、專業分類、專業內容 (card)
-   Blade 模板整合、Route 與 Controller 分工清楚

## ⚙️ 使用技術

-   Laravel Blade
-   Bootstrap 5 + 自訂 SCSS
-   MySQL
-   SweetAlert 訊息提示
-   圖片上傳與 `storage` 整合
-   分頁與搜尋功能

## 🧪 專案限制

-   本專案暫無部署線上版本（因無購買網域與免費資料庫方案）
-   所有功能僅於本機（XAMPP + Laravel）環境測試運作

## 🗂️ 路徑說明

-   前台入口：`resources/views/front/index.blade.php`
-   後台入口：`/admin/home`（需登入管理員）
    -   已撰寫 **Session 判斷邏輯**，僅當登入者身份為「管理員」 (`role === 'admin'`) 時，前台導覽列才會顯示「後台專區」按鈕。
    -   一般會員登入後不會看到該按鈕，避免誤觸與權限問題。

---

> 本專案純屬學習與個人練習使用，未作商業用途。
