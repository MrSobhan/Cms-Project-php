<section x-cloak class="sidebar" :class="open || 'inactive'">
    <div class="d-flex align-items-center justify-content-between justify-content-lg-center">
        <h4 class="fw-bold">MR.LEGEND</h4>
        <i @click="toggle" class="d-lg-none fs-1 bi bi-x"></i>
    </div>
    <div class="mt-4">
        <ul class="list-unstyled">
            <li class="sidebar-item active">
                <a class="sidebar-link" href="../panel/">
                    <i class="me-2 bi bi-grid-fill"></i>
                    <span>داشبورد</span>
                </a>
            </li>

            <li x-data="dropdown" class="sidebar-item">
                <div @click="toggle" class="sidebar-link">
                    <i class="me-2 bi bi-shop"></i>
                    <span>فروشگاه</span>
                    <i class="ms-auto bi bi-chevron-down"></i>
                </div>
                <ul x-show="open" x-transition class="submenu">
                    <li class="submenu-item">
                        <a href="../shop/">لیست فروشگاه ها</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">ایجاد فروشگاه</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">ویرایش فروشگاه</a>
                    </li>
                </ul>
            </li>

            <li x-data="dropdown" class="sidebar-item">
                <div @click="toggle" class="sidebar-link">
                    <i class="me-2 bi bi-box-seam"></i>
                    <span>محصولات</span>
                    <i class="ms-auto bi bi-chevron-down"></i>
                </div>
                <ul x-show="open" x-transition class="submenu">
                    <li class="submenu-item">
                        <a href="../product/">لیست محصولات</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">ایجاد محصول</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">ویرایش محصول</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="../product/discount.php">
                    <i class="me-2 bi bi-percent"></i>
                    <span>تخفیف ها</span>
                </a>
            </li>

            <li x-data="dropdown" class="sidebar-item">
                <div @click="toggle" class="sidebar-link">
                    <i class="me-2 bi bi-people-fill"></i>
                    <span>کاربران</span>
                    <i class="ms-auto bi bi-chevron-down"></i>
                </div>
                <ul x-show="open" x-transition class="submenu">
                    <li class="submenu-item">
                        <a href="../users/">لیست کاربران</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">ایجاد کاربران</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">ویرایش کاربران</a>
                    </li>
                </ul>
            </li>

            <li x-data="dropdown" class="sidebar-item">
                <div @click="toggle" class="sidebar-link">
                    <i class="me-2 bi bi-chat-dots-fill"></i>
                    <span>کامنت ها</span>
                    <i class="ms-auto bi bi-chevron-down"></i>
                </div>
                <ul x-show="open" x-transition class="submenu">
                    <li class="submenu-item">
                        <a href="../users/comments.php">لیست کامنت ها</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">کامنت های تایید شده</a>
                    </li>
                    <li class="submenu-item">
                        <a href="#">کامنت های تایید نشده</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</section>