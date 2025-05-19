<nav class="mt-2"> <!--begin::Sidebar Menu-->
    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <!-- 員工管理 -->
        <li class="nav-item mt-3">
            <a href="/admin/manager/list" class="nav-link d-flex align-items-center">
                <i class="nav-icon bi bi-people-fill fs-4 me-2"></i>
                <p class="mb-0">員工管理</p>
            </a>
        </li>
        <!--會員管理-->
        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-people-fill fs-4 me-2"></i>
                <p>
                    會員管理
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ms-4"> <a href="/admin/player/list" class="nav-link"> <i
                            class="nav-icon bi bi-receipt-cutoff fs-5"></i>
                        <p>會員資料</p>
                    </a> </li>
            </ul>
        </li>
        <!-- 商品管理 -->
        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill fs-4 me-2"></i>
                <p>
                    專業管理
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ms-4"> <a href="/admin/major-category/list" class="nav-link"> <i
                            class="nav-icon bi bi-receipt-cutoff fs-5"></i>
                        <p>業務分類</p>
                    </a> </li>
                <li class="nav-item ms-4"> <a href="/admin/major/list" class="nav-link"> <i
                            class="nav-icon bi bi-tags-fill fs-5"></i>
                        <p>業務內容</p>
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
            <a href="{{ route('admin.contact.list') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-envelope-fill fs-4 me-2"></i>
                <p class="mb-0">聯絡我們</p>
            </a>
        </li>


    </ul> <!--end::Sidebar Menu-->
</nav>
