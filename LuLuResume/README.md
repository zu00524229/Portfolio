# 💼 SoulAdmin 個人專業網站 (Laravel 專案)

這是一個使用 Laravel 框架開發的個人網站平台，初衷是為了幫女友整合她的自我介紹、專業經歷與服務項目，同時也作為我學習 Laravel 的實戰練習。專案持續優化中，功能與模組會視需求持續擴充。

.........................持續更新中..........................

## ✨ 近期更新內容（2025/05）

-   ✅ **會員專區功能上線**：註冊成功後將依身份顯示「後台專區」或「會員專區」
-   ✅ **會員登入判斷**：判斷是否為 `管理員` 或 `一般會員`，顯示對應功能
-   ✅ **聯絡我表單串接後台**：前台留言後自動存入資料庫，後台可查詢與管理
-   ✅ **後台新增模組**：
    -   會員管理（僅支援查詢 / 編輯 / 刪除）
    -   聯絡我留言管理（查詢 / 編輯 / 刪除）

## 🔧 專案架構特色

-   使用 **Laravel 10.x** 開發
-   前台版型參考 [BootstrapMade - NiceSchool](https://bootstrapmade.com/nice-school-bootstrap-education-template/)
-   前後台登入系統與導覽列整合：
    -   登入、註冊、驗證密碼
    -   登入後依身份切換導覽列內容：
        -   管理員顯示「後台專區」
        -   會員顯示「會員專區」
-   完整後台管理系統模組：
    -   員工管理（Manager）CRUD
    -   專業分類管理（MajorCategory）CRUD
    -   專業內容管理（Major）CRUD
    -   會員管理（Player）編輯 / 刪除 / 查詢
    -   聯絡我留言管理（Contact）編輯 / 刪除 / 查詢
-   使用中介層 Middleware 驗證後台登入權限
-   使用 Session 判斷登入身份，顯示對應選單項目
-   Blade 模板引擎整合，Controller 與 Route 結構清晰

## ⚙️ 使用技術

-   Laravel Blade + Controller
-   Bootstrap 5 + 客製 SCSS
-   SQLite（原為 MySQL，改為 SQLite 方便測試與部署）
-   SweetAlert 提示訊息
-   Glightbox 圖片燈箱展示

## 🧪 開發環境與限制

-   僅於本地端環境（XAMPP + SQLite）測試
-   尚未部署至線上環境（無綁定網域與伺服器）
-   資料透過 SQLite 儲存，免額外設定資料庫帳密

## 🗂️ 專案路徑說明

-   前台首頁：`resources/views/front/index.blade.php`
-   玩家註冊：`resources/views/front/register.blade.php`
-   聯絡我表單：`resources/views/front/contact.blade.php`
-   後台入口：`/admin/home`（登入後自動導入）
    -   僅當 `session('role') === 'admin'` 才顯示後台入口連結
    -   玩家登入後僅能看到自己的「會員專區」

---

> 本專案為學習與練習之用，尚未開放商業用途與公開託管部署。
