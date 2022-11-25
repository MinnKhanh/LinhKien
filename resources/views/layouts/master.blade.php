<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Linh Kien</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    @livewireStyles
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    @stack('css')
    <style>
        .notifi {
            position: fixed;
            top: 1rem;
            right: 2rem;
        }

        .notification {
            /* display: block; */
            background-color: white;
            /* border: 1px solid; */
            outline: 1px solid gray;
            z-index: 1;
            border-radius: 2px;
        }

        .toast-header {
            padding: 0rem .5rem;
            background-color: #ffeb00c2;
        }

        .pagination {
            padding-top: 25px;
            text-align: center !important;
            justify-content: center;
        }

        .pagination li {
            text-align: center !important;
            margin: 0px .2rem;
        }

        .page-item.active .page-link {
            border-color: #111111;
            color: black !important;
            background: transparent;
        }

        .pagination .page-link {
            display: inline-block !important;
            font-size: 16px;
            font-weight: 700;
            color: #111111;
            height: 30px;
            width: 30px;
            border-radius: 50% !important;
            line-height: 30px;
            text-align: center;
            align-items: center;
            padding: 0;

        }

        .pagination li.active {
            border-color: #111111;
        }

        .pagination li:hover {
            border-color: #111111;
        }

        .category {
            color: gray !important;
        }

        .category:hover,
        .category:focus {
            text-decoration: none;
            outline: none;
            color: black !important;
        }

        #logo {
            max-width: 25% !important;
            position: absolute;
            top: 2px;
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="notifi">
        @if ($errors->has('msg'))
            <div role="alert" aria-live="assertive" aria-atomic="true" class="notification error msg mb-3"
                data-autohide="false">
                <div class="toast-header d-flex justify-content-between">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                        </svg>
                        <strong class="ml-1">Notification</strong>
                    </div>
                    <small class="text-muted"></small>
                </div>
                <div class="toast-body">
                    <div class="error">{{ $errors->first('msg') }}</div>
                </div>
            </div>
        @endif
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @if (auth()->check())

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @if (Auth::user()->can('Admin'))
                                        <a href="{{ route('admin.main.index') }}">Quản lý</a>
                                    @endif
                                    <a href="{{ route('user.update') }}">Cập nhật</a>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                    <a href="{{ route('user.changepassword') }}">Đổi mật khẩu</a>

                                    {{-- <a href="{{ route('password.confirm') }}">Đổi mật khẩu</a> --}}
                                @else
                                    <a href="{{ route('login') }}">Đăng nhập</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img id="logo" src="{{ asset('storage/home/logo.png') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="{{ $active == 1 ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="{{ $active == 2 ? 'active' : '' }}"><a
                                    href="{{ route('shop.index') }}">Shop</a></li>
                            <li class="{{ $active == 3 ? 'active' : '' }}"><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('service.aboutus') }}">About Us</a></li>
                                    <li><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                                    <li><a href="{{ route('service.blog') }}">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="{{ $active == 4 ? 'active' : '' }}"><a
                                    href="{{ route('order.index') }}">Order</a></li>
                            <li class="{{ $active == 5 ? 'active' : '' }}"><a href="./contact.html">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="{{ asset('img/icon/search.png') }}"
                                alt=""></a>
                        <a href="{{ route('user.favorite') }}"><img src="{{ asset('img/icon/heart.png') }}"
                                alt=""></a>
                        <a href="{{ route('cart.index') }}"><img src="{{ asset('img/icon/cart.png') }}"
                                alt="">
                            <span>0</span></a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    @yield('content')
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo" style="text-align: center">
                            <a href="#"><img src="{{ asset('storage/home/logo.png') }}"
                                    style="max-width: 30% !important;" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="img/payment.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Tiện ích</h6>
                        <ul>
                            <li><a href="#">Cửa hàng linh kiện</a></li>
                            <li><a href="#">hàng hóa ưa thích</a></li>
                            <li><a href="#">Linh kiện</a></li>
                            <li><a href="#">Bán hàng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Bán hàng</h6>
                        <ul>
                            <li><a href="#">Liên kết với chúng tôi</a></li>
                            <li><a href="#">Phương thức thanh toán</a></li>
                            <li><a href="#">Giao hàng</a></li>
                            <li><a href="#">Trả và đổi trả</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Sản phẩm mới</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2020
                            All rights reserved | This template is made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
    <!-- Js Plugins -->
    @livewireScripts
    @include('layouts._script')
    @stack('js')
    <script>
        if ($('.msg').length) {
            $('.error').toast('show')
            const myTimeout = setTimeout(function() {
                $('.error').toast('hide')
                clearTimeout(myTimeout);
            }, 2000);
        }
    </script>
</body>

</html>
