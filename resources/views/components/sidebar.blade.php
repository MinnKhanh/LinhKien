<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.main.index') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#type" role="button" aria-expanded="false"
                aria-controls="type">
                <i class="fa-solid fa-list menu-icon"></i>
                <span class="menu-title">Loại sản phẩm</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="type">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.index') }}">Danh sách loại
                            sản
                            phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.create') }}">Thêm loại sản
                            phẩm</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product" role="button" aria-expanded="false"
                aria-controls="product">
                <i class="fa-solid fa-boxes-stacked menu-icon"></i>
                <span class="menu-title">Sản phẩm</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.product.index') }}">Danh sách sản
                            phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.product.create') }}">Thêm sản
                            phẩm</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#brand" role="button" aria-expanded="false"
                aria-controls="brand">
                <i class="fa-solid fa-shopping-cart menu-icon"></i>
                <span class="menu-title">Nhãn hàng</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="brand">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.brand.index') }}">Danh sách nhã
                            hàng</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.brand.create') }}">Thêm nhãn
                            hàng</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#vendor" role="button" aria-expanded="false"
                aria-controls="vendor">
                <i class="fa-solid fa-shop menu-icon"></i>
                <span class="menu-title">Nhà cung cấp</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="vendor">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.vendor.index') }}">Danh sách nhà
                            cung
                            cấp</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.vendor.create') }}">Thêm nhà cung
                            cấp</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="fa-solid fa-clipboard-list menu-icon"></i>
                <span class="menu-title">Đơn hàng</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#import" role="button" aria-expanded="false"
                aria-controls="import">
                <i class="fa-solid fa-receipt menu-icon"></i>
                <span class="menu-title">Nhập hàng</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="import">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.orderimport.index') }}">Danh sách
                            hóa đơn nhập</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.orderimport.create') }}">Tạo
                            hóa
                            đơn nhập</a></li>
                </ul>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.customers.index') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Người dùng</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" role="button" aria-expanded="false"
                aria-controls="type">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Người dùng</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.customers.index') }}">Danh
                            sách người dùng</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.customers.create') }}">Tạo
                            tài khoản</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#intro" role="button" aria-expanded="false"
                aria-controls="intro">
                <i class="fa-solid fa-store menu-icon"></i>
                <span class="menu-title">Introduces</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="intro">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.introduce.index') }}">Danh quảng
                            cáo</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.introduce.createslideintro') }}">Tạo
                            Slide giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.introduce.creatediscountintro') }}">Tạo
                            phiếu giảm giá</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.introduce.customizeslideintro') }}">Thiết lập side quảng cáo</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.statistical.index') }}">
                <i class="fa-sharp fa-solid fa-bar-chart menu-icon"></i>
                <span class="menu-title">Thống kê</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#new" role="button" aria-expanded="false"
                aria-controls="new">
                <i class="fa-solid fa-newspaper menu-icon"></i>
                <span class="menu-title">Tin tức</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="new">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.inforshop.listnews') }}">Danh
                            các bản tin</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.inforshop.createnew') }}">Tạo
                            bản tin</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#discount" role="button" aria-expanded="false"
                aria-controls="discount">
                <i class="fa-sharp fa-solid fa-ticket menu-icon"></i>
                <span class="menu-title">Mã Giảm giá</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="discount">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.discount.index') }}">Danh
                            sách khuyến mãi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.discount.create') }}">Tạo
                            phiếu khuyến mãi</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.inforshop.aboutus') }}">
                <i class="fa-solid fa-store menu-icon"></i>
                <span class="menu-title">Thông tin cửa hàng</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-comment-alt menu-icon"></i>
                <span class="menu-title">Liên hệ</span>
            </a>
        </li> --}}
        <li class="mt-5"
            style="    background-color: blue;
    width: 100%;
    padding: 10px;
    border-radius: 3px;padding-left: 2rem;">
            <a class="" style="color:white;font-weight: 900;" href="{{ route('home') }}">
                <i class="fas fa-arrow-left menu-icon"></i>
                <span class="menu-title ml-1">Quay lại cửa hàng</span>
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
