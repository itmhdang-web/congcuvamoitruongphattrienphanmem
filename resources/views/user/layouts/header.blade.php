<div class="header">
    <div class="header-top">
        <div class="wrap-content">
            <div class="info-header">
                <img src="{{ asset('assets/user/images/logo.png') }}" style="height: 2.5em" />
                <span class="font-weight-bold pl-3" style="font-size: x-large;">InfinityShop</span>
            </div>
            <div class="menu">
                <div>
                    <ul class="menu-main menu_desktop">
                        <li><a class="transition {{ $name == '' || $name == 'page-user-home' ? 'active' : '' }}" href="{{ route('page-user-home') }}" title="Trang chủ">Trang chủ</a></li>
                        <li>
                            <a class="transition {{ $name == 'page-user-product-list' ? 'active' : '' }}" href="{{ route('page-user-product-list') }}" title="sản phẩm">sản phẩm</a>
                        </li>
                        <li><a class="transition {{ $name == 'page-about-us' ? 'active' : '' }}" href="{{ route('page-about-us') }}" title="Giới thiệu">Giới thiệu</a></li>
                        <li class="ml-auto li-last">
                            <div class="search w-clear">
                                <input type="text" id="keyword" name="keyword" placeholder="Nhập từ khoá..." />
                                <a type="button" class="btn-search"><i class="fas fa-search"></i></a>
                            </div>
                            <a href="{{ route('page-user-cart-list') }}" class="li-cart d-block">
                                <div class="cart">
                                    <div class="ico-cart">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                    <div class="quantity-item">
                                        {{ is_array(session('cart')) ? count(session('cart')) : 0}}
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="wap-social-login">
                @if (isset(Auth::guard('user')->user()->id))
                    <div class="info-user dropdown">
                        <a class="d-flex align-items-center show-dropdown" data-toggle="dropdown" href="">
                            <div class="avtar_user"><img class="" onerror="src='{{ asset('assets/user/images/noimage.png') }}'"
                                src="{{ asset('upload/avatar/' . Auth::guard('user')->user()->avatar) }}"
                                alt="Alt Photo" style="" /></div>
                            <span class="name_user ml-2">{{ Auth::guard('user')->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu">
                            @if(Auth::guard('user')->user()->role === 'admin')
                                <a class="dropdown-item" href="{{ route('page-admin-home') }}">Trang quản lý</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('page-user-profile') }}">Thông tin cá nhân</a>
                            <a class="dropdown-item" href="{{ route('page-user-pwd-change') }}">Đổi mật khẩu</a>
                            <a class="dropdown-item" href="{{ route('page-user-order-list') }}">Lịch sử mua hàng</a>
                            <a class="dropdown-item" href="{{ route('do-user-logout') }}"><span>Đăng xuất</span> <i class="fa fa-sign-out"></i></a>
                        </div>
                    </div>
                @else
                    <div class="wrap-login-register">
                        <div class="wrap-login">
                            <a href="{{ route('page-user-login') }}" class="" data-replace="Đăng nhập">
                                <span>Đăng nhập</span>
                                <i class="fa-solid fa-arrow-right-to-bracket ml-1"></i>
                            </a>
                        </div>
                        <div class="line-deco"></div>
                        <div class="wrap-register">
                            <a href="{{ route('page-user-register') }}" class="" data-replace="Đăng ký">
                                <span>Đăng ký</span>
                                <i class="fa-solid fa-user-plus ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
