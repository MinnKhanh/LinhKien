<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="fa-solid fa-list menu-icon"></i>
        <span class="menu-title">Loại sản phẩm</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin/category') }}">Danh sách loại sản phẩm</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin/category/create') }}">Thêm loại sản phẩm</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#material" aria-expanded="false" aria-controls="material">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Chất liệu</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="material">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin/material') }}">Danh sách chất liệu</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin/material/create') }}">Thêm chất liệu</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
        <i class="fa-solid fa-boxes-stacked menu-icon"></i>
        <span class="menu-title">Sản phẩm</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin/product') }}">Danh sách sản phẩm</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin/product/create') }}">Thêm sản phẩm</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/color') }}">
        <i class="fa-solid fa-palette menu-icon"></i>
        <span class="menu-title">Màu</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/slider') }}">
        <i class="fa-sharp fa-solid fa-photo-film menu-icon"></i>
        <span class="menu-title">Slider</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/orders') }}">
        <i class="fa-solid fa-clipboard-list menu-icon"></i>
        <span class="menu-title">Đơn hàng</span>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="documentation/documentation.html">
        <i class="fas fa-chart-pie menu-icon"></i>
        <span class="menu-title">Thống kê</span>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/admin/customers') }}">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Khách hàng</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa-solid fa-newspaper menu-icon"></i>
        <span class="menu-title">Tin tức</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa-sharp fa-solid fa-ticket menu-icon"></i>
        <span class="menu-title">Mã giảm giá</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa-solid fa-store menu-icon"></i>
        <span class="menu-title">Thông tin cửa hàng</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-comment-alt menu-icon"></i>
        <span class="menu-title">Liên hệ</span>
      </a>
    </li>
    
  </ul>
</nav>

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
