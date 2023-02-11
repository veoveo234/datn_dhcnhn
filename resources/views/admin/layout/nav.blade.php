<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="./assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">James Brown</div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="active" href="{{ url('admin') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li class="{{ Request::is('admin/brand') ? 'active' : '' }}">
                <a href="{{ route('brand.index') }}"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Quản lý thương hiệu</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
                <a href="{{ route('category.index') }}"><i class="sidebar-item-icon fa fa-list-alt" aria-hidden="true"></i>
                    <span class="nav-label">Danh mục sản phẩm</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/product') ? 'active' : '' }}">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Quản lý sản phẩm</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('product.index') }}">Sản phẩm</a>
                    </li>
                    <li>
                        <a href="">Comment sản phẩm</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="{{ Route::is('category-blog.index') ? 'active' : null }}"><i class="sidebar-item-icon fa fa-table"></i>
                    <span class="nav-label">Quản lý bài viết</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('category-blog.index') }}">Danh mục bài viết</a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}">Quản lý bài viết</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/discount-code/*') ? 'active' : '' }}">
                <a href="javascript:;"><i class="sidebar-item-icon ti-gift"></i>
                    <span class="nav-label">Mã khuyến mại</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{route('discount.index')}}">Chương trình khuyến mại</a>
                    </li>
                    <li>
                        <a href="{{ route('discount.add')}}">Thêm mới mã giảm giá</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/member/*') ? 'active' : '' }}">
                <a href="{{ route('member.index') }}"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Quản lý khách hàng</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/staff/*') ? 'active' : '' }}">
                <a href="{{ route('staff.index') }}"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Quản lý nhân viên</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/config_home/*') ? 'active' : '' }}">
                <a href="{{ route('confighome.edit') }}"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Quản lý giao diện</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/affiliate/*') ? 'active' : '' }}">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-map"></i>
                    <span class="nav-label">Tiếp thị liên kết</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('partner.index') }}">Quản lý cộng tác viên</a>
                    </li>
                    <li>
                        <a href="{{ route('rose.index') }}">Quản lý tỉ lệ hoa hồng</a>
                    </li>
                    <li>
                        <a href="{{ route('program.index') }}">Quản lý các chương trình</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/manage-cart') ? 'active' : '' }}">
                <a href="{{ route('manage.cart.index') }}"><i class="sidebar-item-icon fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="nav-label">Quản lý đơn hàng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('statistical.index') }}"><i class="sidebar-item-icon ti-notepad"></i>
                    <span class="nav-label">Báo cáo</span>
                </a>
            </li>
            {{-- <li class="heading">PAGES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-envelope"></i>
                    <span class="nav-label">Mailbox</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="mailbox.html">Inbox</a>
                    </li>
                    <li>
                        <a href="mail_view.html">Mail view</a>
                    </li>
                    <li>
                        <a href="mail_compose.html">Compose mail</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="calendar.html"><i class="sidebar-item-icon fa fa-calendar"></i>
                    <span class="nav-label">Calendar</span>
                </a>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-file-text"></i>
                    <span class="nav-label">Pages</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="invoice.html">Invoice</a>
                    </li>
                    <li>
                        <a href="profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="login.html">Login</a>
                    </li>
                    <li>
                        <a href="register.html">Register</a>
                    </li>
                    <li>
                        <a href="lockscreen.html">Lockscreen</a>
                    </li>
                    <li>
                        <a href="forgot_password.html">Forgot password</a>
                    </li>
                    <li>
                        <a href="error_404.html">404 error</a>
                    </li>
                    <li>
                        <a href="error_500.html">500 error</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Menu Levels</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="javascript:;">Level 2</a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <span class="nav-label">Level 2</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-3-level collapse">
                            <li>
                                <a href="javascript:;">Level 3</a>
                            </li>
                            <li>
                                <a href="javascript:;">Level 3</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>
