<div class="main-navbar shadow-sm sticky-top">
  <div class="top-navbar ">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
          <h5 class="brand-name"><img src="https://vuoncaymini.com/wp-content/uploads/2021/08/logo-vuon-cay-mini-official.png" alt="logo" style="width: 150px" /></h5>
        </div>
        <div class="col-md-5 my-auto">
          <form role="search" action="{{ url('products/set_keyword') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <input name="search" type="search" placeholder="Tìm kiếm sản phẩm..." class="form-control" value="{{ session()->get('key_word') }}" />
              <button class="btn border btn_search" type="submit">
                <i class="fa fa-search text-white"></i>
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-5 my-auto">
          <ul class="nav justify-content-end">
            <li class="nav-item">
              <a class="nav-link" href="/cart"> <i class="fa fa-shopping-cart"></i> Giỏ hàng (<livewire:user.cart.cart-count />) </a>
            </li>
            <!-- Right Side Of Navbar -->
            <!-- Authentication Links -->
            @guest @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __("Đăng nhập") }}</a>
            </li>
            @endif @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __("Đăng ký") }}</a>
            </li>
            @endif @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-user"></i> {{ Auth::user()->name }} </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Thông tin cá nhân</a>
                </li>
                <li>
                  <a class="dropdown-item" href="/change_password"><i class="fa-solid fa-unlock"></i></i> Đổi mật khẩu</a>
                </li>
                <li>
                  <a class="dropdown-item" href="/orders"><i class="fa fa-list"></i> Đơn hàng của tôi</a>
                </li>
                <li>
                  <a class="dropdown-item" href="/cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();"
                    ><i class="fa fa-sign-out"></i>
                    {{ __("Đăng xuất") }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
              </ul>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid container">
      <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="/"
        ><img src="https://vuoncaymini.com/wp-content/uploads/2021/08/logo-vuon-cay-mini-official.png" alt="logo" style="width: 150px"
      /></a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/">Trang Chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/products">Sản Phẩm</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about_us">Về Chúng Tôi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact">Liên Hệ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="care">Cẩm nang cây cảnh</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="delivery_policy">Chính sách giao hàng</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>

<script type="text/javascript">
  const currentUrl = window.location.href;
  const nav_items = document.getElementsByClassName("nav-item");
  for (let i = 0; i < nav_items.length; i++) {
    let nav_links = nav_items[i].getElementsByClassName("nav-link");
    for (let j = 0; j < nav_links.length; j++) {
      if (nav_links[j].href == currentUrl) {
        nav_items[i].classList.add("active");
      }
    }
  }
</script>
