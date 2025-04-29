<nav class="mt-2"> <!--begin::Sidebar Menu-->
    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <!-- 員工管理 -->
        <li class="nav-item mt-3">
            <a href="/admin/manager/list" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-people-fill fs-4 me-2"></i>
                <p class="mb-0">員工管理系統</p>
            </a>
        </li>
        <!-- 商品管理 -->
        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill fs-4 me-2"></i>
                <p>
                    商品管理系統
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ms-4"> <a href="/admin/product/list" class="nav-link"> <i class="nav-icon bi bi-receipt-cutoff fs-5"></i>
                        <p>商品管理</p>
                    </a> </li>
                <li class="nav-item ms-4"> <a href="/admin/productCategory/list" class="nav-link"> <i class="nav-icon bi bi-tags-fill fs-5"></i>
                        <p>商品類別管理</p>
                    </a> </li>
            </ul>
        </li>
        <!-- 公告管理 -->
        <li class="nav-item">
            <a href="/admin/notice/list" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-megaphone-fill fs-4 me-2"></i>
                <p class="mb-0">公告管理系統</p>
            </a>
        </li>
        <!-- 聯絡我們 -->
        <li class="nav-item">
            <a href="/admin/contact/contactList" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-envelope-fill fs-4 me-2"></i>
                <p class="mb-0">聯絡我們</p>
            </a>
        </li>
        <!-- 玩家相關資料 -->
        <li class="nav-item mt-5">
            <a href="/admin/player/playerList" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-controller fs-4 me-2"></i>
                <p class="mb-0">玩家相關資料</p>
            </a>
        </li>
        <!-- 玩家儲值紀錄 -->
        <li class="nav-item">
            <a href="/admin/player/rechargeAllList" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-cash-coin fs-4 me-2"></i>
                <p class="mb-0">儲值紀錄</p>
            </a>
        </li>
        <!-- 玩家抽獎紀錄 -->
        <li class="nav-item">
            <a href="/admin/player/lotteryAllList" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-gift-fill fs-4 me-2"></i>
                <p class="mb-0">抽獎紀錄</p>
            </a>
        </li>
        <!-- 玩家出貨紀錄 -->
        <li class="nav-item">
            <a href="/admin/player/shippingAllList" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-truck fs-4 me-2"></i>
                <p class="mb-0">出貨紀錄</p>
            </a>
        </li>
    </ul> <!--end::Sidebar Menu-->
</nav>