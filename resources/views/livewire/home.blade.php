@push('css')
    <style>
        .hero__items {
            height: auto !important;
            padding-top: 4rem !important;
            padding-bottom: 4rem;
            background-position: center;

        }

        .categories__hot__deal img {
            height: 20rem !important;
        }

        .img-fluid {
            height: 260px;

        }

        .priceitem {
            font-size: .9rem
        }

        .link {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0px;
            left: 0px;
            /* z-index: -1; */
        }

        .img-fluid {
            z-index: -1;
            width: 100%;
            position: absolute;
            height: 100%;

        }

        .product-offer {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .offer-text {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
    </style>
@endpush
<div>
    <section class="hero mt-5">
        <div class="hero__slider owl-carousel mb-5">
            @forelse ($slides as $item)
                <div class="hero__items set-bg"
                    data-setbg="{{ asset('storage/introduce/' . $item['img'][0]['image_name']) }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                                <div class="hero__text">
                                    <h6>{{ $item['subtitle'] }}</h6>
                                    <h2>{{ $item['title'] }}</h2>
                                    <p>{{ $item['description'] }}</p>
                                    <a href="{{ $item['link'] }}" class="primary-btn">Mua Ngay <span
                                            class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

            {{-- <div class="hero__items set-bg" data-setbg="{{ asset('storage/home/2.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Siêu Linh Kiện</h6>
                                <h2>Giá cả hợp lý</h2>
                                <p>Chất lượng đi đôi với giá thành, số lương lớn đa dạng với nhiều chủng
                                    loại khác nhau, mẫu mã đa dạng thỏa sưc lựa chọn sản phẩm mà bạn cần
                                    cho việc học hoặc làm việc.</p>
                                <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- Hero Section End -->



    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Sản phẩm ưa chuộng</li>
                        <li data-filter=".new-arrivals">Sản phẩm mới</li>
                        <li data-filter=".hot-sales">Sản phẩm bán chạy nhất</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                @forelse ($bestsellers as $item)
                    <div wire:key="itemproduct-{{ $item['id'] }}"
                        class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                style='background-image: url("{{ asset('storage/product/' . $item['img'][0]['image_name']) }}");'
                                data-setbg="{{ asset('storage/product/' . $item['img'][0]['image_name']) }}">
                                <a class="link" href="{{ route('shop.detail', ['id' => $item['id']]) }}"></a>
                                <ul class="product__hover">
                                    @if (auth()->check())
                                        <li wire:click="addFavorite({{ $item['id'] }})"><a><img
                                                    src="img/icon/heart.png" alt=""></a>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}"><img src="img/icon/heart.png"
                                                    alt=""></a>
                                        </li>
                                    @endif
                                    <li><a><img src="img/icon/search.png" alt=""></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $item['product_name'] }}</h6>
                                @if (auth()->check())
                                    <a wire:click="addToCart({{ auth()->user()->id }},{{ $item['id'] }},1,{{ $item['price'] }},'{{ $item['product_name'] }}')"
                                        style="cursor: pointer;" class="add-cart">+ Add To Cart</a>
                                @else
                                    <a href="{{ route('login') }}" style="cursor: pointer;" class="add-cart">+ Add To
                                        Cart</a>
                                @endif
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>{{ number_format($item['price'], 0, ',', ',') }} Đ</h5>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
                @forelse ($newarrival as $item)
                    <div wire:key="itemproduct-{{ $item['id'] }}"
                        class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                style='background-image: url("{{ asset('storage/product/' . $item['img'][0]['image_name']) }}");'
                                data-setbg="{{ asset('storage/product/' . $item['img'][0]['image_name']) }}">
                                <a class="link" href="{{ route('shop.detail', ['id' => $item['id']]) }}"></a>
                                <ul class="product__hover">
                                    <li wire:click="addFavorite({{ $item['id'] }})"><a><img src="img/icon/heart.png"
                                                alt=""></a>
                                    </li>
                                    <li><a><img src="img/icon/search.png" alt=""></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $item['product_name'] }}</h6>
                                <a wire:click="addToCart(1,{{ $item['id'] }},1,{{ $item['price'] }},'{{ $item['product_name'] }}')"
                                    style="cursor: pointer;" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>{{ number_format($item['price'], 0, ',', ',') }} Đ</h5>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Đa dạng <br /> <span>Chất lượng cao</span> <br /> Giá cả hợp lý</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="{{ asset('storage/home/31.png') }}" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>10%</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            @forelse ($discounts as $item)
                <div class="col-md-6">
                    <div class="product-offer mb-30" style="height: 300px;">
                        <img class="img-fluid"
                            src="{{ asset('storage/introduce/' . $item['img'][0]['image_name']) }}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase"
                                style="font-weight: 800;color: #000000d9 !important">
                                Giảm giá
                                {{-- {{ $item['percent'] }} {{ $item['percent'] == 1 ? '%' : 'Đ' }} --}}
                                {{ number_format($item['percent'], 0, ',', ',') }}{{ $item['unit'] == 1 ? '%' : 'Đ' }}
                            </h6>
                            <h3 class="text-white" style="font-weight: 700;color:#ffffffd9 !important;">
                                {{ $item['title'] }}</h3>
                            <p class="text-white" style="color:#ffffffd9 !important;">
                                {{ $item['description'] }}</p>
                            @if ($item['expiry'])
                                <div class="col-12 mb-2 text-center">Từ {{ $item['begin'] }} đến
                                    {{ $item['end'] }}</div>
                            @else
                                <div class="col-12 mb-2 text-center">Đã hết hạn</div>
                            @endif
                            {{-- <a href="#" class="primary-btn" data-toggle="modal"
                                data-target="#discount_{{ $item['id'] }}">Nhận Ngay</a> --}}
                            @if (auth()->check())
                                <button type="button" class="primary-btn adddiscount"
                                    data-id={{ $item['relate_id'] }}>
                                    {{ $item['discount']['discount_user'] ? 'Đã Nhận' : 'Nhận' }}
                                </button>
                            @else
                                <a class="btn btn-primary" href="{{ route('auth.login') }}">Nhận</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>
    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/home/22.jpg') }}">
                        </div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/home/23.jpg') }}">
                        </div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/home/24.jpg') }}">
                        </div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/home/25.jpg') }}">
                        </div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/home/26.jpg') }}">
                        </div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/home/27.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h3 style="color: black" class="mb-5">Chủng loại đa dạng</h3>
                        <p>Có vô só loại thiết bị hưu ích đa dang mà bạn cần, với nhiều lựa chọn phong phu
                            và đa dạng</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Latest News</span>
                        <h2>Supplier</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($brands as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg"
                                data-setbg="{{ asset('storage/home/' . (isset($item['img'][0]) ? $item['img'][0]['image_name'] : '')) }}">
                            </div>
                            <div class="blog__item__text">
                                <h5>{{ $item['brand_description'] }}</h5>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('click', '.adddiscount', function() {
                let id = parseInt($(this).attr('data-id'));
                window.livewire.emit('addDiscountToUser', {
                    0: id
                });
            })
        })
    </script>
</div>
