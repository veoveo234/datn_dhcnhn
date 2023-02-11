<div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            {{-- <div class="row"> --}}
                <a class="navbar-brand logo_h" href="{{ route('index') }}"><img src="{{ asset('assets/img/logo001.png') }}" alt="" style="height: 85px"></a>
                <ul class="nav-shop" id="cart-mobile" style="padding-bottom: 0;">
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}">
                            <button>
                                <i class="far fa-user" style="font-size: 32px; color: #384aeb;"></i>
                            </button>
                        </a>
                    </li>
                    <li class=""><a href=""><i class="fas fa-heart" style="font-size: 32px; color: #384aeb;"></i></a></li>
                    <li class="nav-item cart-box mr-0">
                        <button>
                            <i class="fas fa-luggage-cart" style="font-size: 32px; color: #f53d2d;"></i>
                            <span class="nav-shop__circle" style="font-size: 15px; padding: 1px 9px; top: -13px; right: -24px;">3</span>
                        </button>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent" style="flex-direction: column; position: relative;">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li>
                            <div class="searchbar" style="position: absolute; left: 0;">
                                <input class="search_input" id="search_input_text" type="text" name="" placeholder="Tìm kiếm...">
                                <a href="#" class="search_icon" onclick="search_product()"><i class="fas fa-search"></i></a>
                                <ul class="result_search mt-2 bg-white" style="display: none;max-height: 400px;overflow-y:auto" >
                                    <li class="p-2 bg-white" > <a href="#"> sarn phaarm 1</a></li>
                                    <li class="p-2 bg-white" >sarn phaarm 1</li>
                                    <li class="p-2 bg-white" >sarn phaarm 1</li>
                                    <li class="p-2 bg-white" >sarn phaarm 1</li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('index') }}">Trang chủ</a></li>
                        <li class="nav-item {{ Request::is('women', 'women/*') ? 'active' : '' }}">
                            <a href="{{ route('women.index') }}" class="nav-link">Đồ nữ</a>
                        </li>
                        <li class="nav-item {{ Request::is('men', 'men/*') ? 'active' : '' }}">
                            <a href="{{ route('men.index') }}" class="nav-link">Đồ nam</a>
                        </li>
                        <li class="nav-item {{ Request::is('mix-fashion', 'mix-fashion/*') ? 'active' : '' }}">
                            <a href="{{ route('fashion.directional') }}" class="nav-link">Phối đồ</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog.user.index') }}">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('affiliate.introduce') }}">Affiliate</a></li>
                    </ul>
                </div>
                {{-- <div class="container" style="position: absolute; top: 100%;">
                    <div class="row">
                        <div class="col-md-8 offset-2 col-sm-10 col-10">
                            <div class="p-4" style="background: #fff; border-radius: 6px; opacity: 0;" id="load-data-live">
                                <div class="list-group" id="data-live-search">

                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <ul class="nav navbar-nav menu_nav ml-auto mr-auto" id="user-pc">
                    @if(session()->has('member_id'))
                    <li class="nav-item active submenu dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"><i class="far fa-user" style="font-size: 32px;"></i> </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('information') }}">Tài khoản của tôi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Đăng xuất</a></li>
                        </ul>
                    </li>
                    @else
                        <li class="nav-item active submenu dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-user" style="font-size: 32px;"></i></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('login-view') }}">Đăng nhập</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register-view') }}">Đăng ký</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <ul class="nav-shop" id="cart-pc">
                    <li class="mr-0"><a href=""><i class="fas fa-heart" style="font-size: 32px; color: #384aeb;"></i></a></li>
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}">
                            <button>
                                <i class="fas fa-luggage-cart" style="font-size: 32px; color: #f53d2d;"></i>
                                <div id="load-count">
                                    @if (isset($count))
                                        <span class="nav-shop__circle count-cart" style="font-size: 15px; padding: 1px 9px; top: -13px; right: -24px;">{{ $count }}</span>
                                    @endif
                                </div>
                            </button>
                        </a>
                    </li>
                </ul>
            {{-- </div> --}}
        </div>
    </nav>
</div>
