<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <div class="user">
            <div class="avatar-sm float-left mr-2">
                <img src="{{ asset('admin-assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        Hizrian
                        <span class="user-level">Administrator</span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav nav-primary">
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a data-toggle="" href="{{ url('admin') }}" class="collapsed" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Manage</h4>
            </li>
            <li class="nav-item {{ Request::is('admin/brand') ? 'active' : '' }}">
                <a data-toggle="" href="{{ route('brand.index') }}">
                    <i class="fas fa-boxes"></i>
                    <p>Manage Brand</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/product', 'admin/category') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#product">
                    <i class="fas fa-th-list"></i>
                    <p>Manage Product</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="product">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('category.index') }}">
                                <span class="sub-item">Danh mục sản phẩm</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}">
                                <span class="sub-item">Quản lý sản phẩm</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sub-item">Quản lý comment sản phẩm</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-toggle="collapse" href="#blog">
                    <i class="flaticon-interface-6"></i>
                    <p>Manage Blog</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="blog">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('category-blog.index') }}">
                                <span class="sub-item">Danh mục bài viết</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}">
                                <span class="sub-item">Quản lý các bài viết</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sub-item">Quản lý comment bài viết</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('manage-cart.index') }}">
                    <i class="flaticon-cart-1"></i>
                    <p>Manage Order</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/affiliate/*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#affiliate">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Manage Affiliate</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="affiliate">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('partner.index') }}">
                                <span class="sub-item">Quản lý các tài khoản</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rose.index') }}">
                                <span class="sub-item">Quản lý các tỉ lệ hoa hồng</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('program.index') }}">
                                <span class="sub-item">Quản lý các chương trình</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-toggle="collapse" href="#user-admin">
                    <i class="fas fa-users-cog"></i>
                    <p>Manage User Admin</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="user-admin">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="#">
                                <span class="sub-item">User đang chờ phê duyệt</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sub-item">Quản lý phân quyền các User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('admin/discount-code') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#manage-code">
                    <i class="fas fa-qrcode"></i>
                    <p>Manage Code</p>
                    {{-- <span class="badge badge-success">4</span> --}}
                </a>
                <div class="collapse" id="manage-code">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('discount.index') }}">
                                <span class="sub-item">Quản lý mã code</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-toggle="collapse" href="#submenu">
                    <i class="fas fa-bars"></i>
                    <p>Menu Levels</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="submenu">
                    <ul class="nav nav-collapse">
                        <li>
                            <a data-toggle="collapse" href="#subnav1">
                                <span class="sub-item">Level 1</span>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="subnav1">
                                <ul class="nav nav-collapse subnav">
                                    <li>
                                        <a href="#">
                                            <span class="sub-item">Level 2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="sub-item">Level 2</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#subnav2">
                                <span class="sub-item">Level 1</span>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="subnav2">
                                <ul class="nav nav-collapse subnav">
                                    <li>
                                        <a href="#">
                                            <span class="sub-item">Level 2</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sub-item">Level 1</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="mx-4 mt-2">
                <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span
                        class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a>
            </li>
        </ul>
    </div>
</div>
