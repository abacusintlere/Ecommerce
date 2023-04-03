<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item" >
                                <a title="Hotline: (+123) 456 789" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>


                            <li class="menu-item lang-menu menu-item-has-children parent">
                                <a title="English" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-en.png') }}" alt="lang-en"></span>English<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="submenu lang" >
                                    <li class="menu-item" ><a title="hungary" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-hun.png') }}" alt="lang-hun"></span>Hungary</a></li>
                                    <li class="menu-item" ><a title="german" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-ger.png') }}" alt="lang-ger" ></span>German</a></li>
                                    <li class="menu-item" ><a title="french" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-fra.png') }}" alt="lang-fre"></span>French</a></li>
                                    <li class="menu-item" ><a title="canada" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-can.png') }}" alt="lang-can"></span>Canada</a></li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-has-children parent" >
                                <a title="Dollar (USD)" href="#">Dollar (USD)<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="submenu curency" >
                                    <li class="menu-item" >
                                        <a title="Pound (GBP)" href="#">Pound (GBP)</a>
                                    </li>
                                    <li class="menu-item" >
                                        <a title="Euro (EUR)" href="#">Euro (EUR)</a>
                                    </li>
                                    <li class="menu-item" >
                                        <a title="Dollar (USD)" href="#">Dollar (USD)</a>
                                    </li>
                                </ul>
                            </li>

                            @auth

                                <li class="menu-item menu-item-has-children parent" >
                                    <a title="My Account" href="#">My Account ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu curency" >
                                        {{-- For Admin --}}
                                        @role('Admin')
                                            <li class="menu-item" >
                                                <a title="Admin Dashboard" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="Categories" href="{{ route('admin.categories') }}">Categories</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="All Products" href="{{ route('admin.products') }}">All Products</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="All Orders" href="{{ route('admin.orders') }}">All Orders</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="Manage Home Sliders" href="{{ route('admin.sliders') }}">Manage Home Sliders</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="Manage Home Categories" href="{{ route('admin.home.categories') }}">Manage Home Categories</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="Manage Home Categories" href="{{ route('admin.sale.settings') }}">Manage Sale Settings</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="All Coupons" href="{{ route('admin.coupons') }}">All Coupons</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="All Contact Messages" href="{{ route('admin.contact.messages') }}">All Contact Us</a>
                                            </li>
                                        @endrole
                                        {{-- For User  --}}
                                        @role('User')
                                            <li class="menu-item" >
                                                <a title="User Dashboard" href="{{ route('user.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="My All Orders" href="{{ route('user.orders') }}">My Orders</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a title="Change Password" href="{{ route('user.password.change') }}">Change Password</a>
                                            </li>
                                        @endrole
                                        <li class="menu-item" >
                                            <a title="Pound (GBP)" href="#">Profile</a>
                                        </li>
                                        <form action="{{ route('logout')}}" method="post" id="logout">
                                            @method('post')
                                            @csrf
                                            <li class="menu-item" >
                                                <a title="Pound (GBP)" onclick="event.preventDefault(); document.getElementById('logout').submit();" href="#">Logout</a>
                                            </li>
                                        </form>

                                    </ul>
                                </li>
                            @else
                                <li class="menu-item" ><a title="Register or Login" href="{{ route('login') }}">Login</a></li>
                                <li class="menu-item" ><a title="Register or Login" href="{{ route('register') }}">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="index.html" class="link-to-home"><img src="{{ asset('assets/images/logo-top-1.png') }}" alt="mercado"></a>
                    </div>

                    {{-- Include Header Search Bar --}}
                    @livewire('header-search-component')

                    <div class="wrap-icon right-section">
                        {{-- Wishlist Component --}}
                        @livewire('wish-list-count-component')

                        {{-- Cart Component --}}
                        @livewire('cart-count-component')
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">
                <div class="header-nav-section">
                    <div class="container">
                        <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
                            <li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top new items</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top Selling</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top rated items</a><span class="nav-label hot-label">hot</span></li>
                        </ul>
                    </div>
                </div>

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                            <li class="menu-item home-icon">
                                <a href="{{ route('home') }}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('about.us') }}" class="link-term mercado-item-title">About Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('shop') }}" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('cart') }}" class="link-term mercado-item-title">Cart</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('checkout') }}" class="link-term mercado-item-title">Checkout</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('contact.us') }}" class="link-term mercado-item-title">Contact Us</a>
                            </li>																	
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>