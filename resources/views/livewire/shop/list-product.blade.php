<div>
    @push('css')
        <style>
            select {
                -webkit-tap-highlight-color: transparent;
                background-color: #fff;
                border-radius: 5px;
                border: solid 1px #e8e8e8;
                box-sizing: border-box;
                clear: both;
                cursor: pointer;
                display: block;
                float: left;
                font-family: inherit;
                font-size: 14px;
                font-weight: normal;
                height: 42px;
                line-height: 40px;
                outline: none;
                padding-left: 18px;
                padding-right: 30px;
                position: relative;
                text-align: left !important;
                -webkit-transition: all 0.2s ease-in-out;
                transition: all 0.2s ease-in-out;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;

                user-select: none;
                white-space: nowrap;
                width: auto;
            }
        </style>
    @endpush
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" wire:model="nameSearch" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll" tabindex="1"
                                                    style="overflow-y: hidden; outline: none;">
                                                    <li>
                                                        <label class="d-block" for="categories-0"><a>Tất
                                                                cả</a></label>
                                                        <input type="radio" id="categories-0" wire:model="category"
                                                            class="d-none" name="category" value="0">
                                                    </li>
                                                    @forelse ($categories as $item)
                                                        <li wire:key="itemcategory-{{ $item['id'] }}">
                                                            <label class="d-block"
                                                                for="categories-{{ $item['id'] }}"><a>{{ $item['category_name'] }}</a></label>
                                                            <input type="radio" id="categories-{{ $item['id'] }}"
                                                                class="d-none" wire:model="category" name="category"
                                                                value="{{ $item['id'] }}">
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <li wire:key="itembrand-0">
                                                        <label class="d-block" for="brand-0"><a>Tất cả</a></label>
                                                        <input type="radio" id="brand-0" class="d-none"
                                                            wire:model="brand" name="brand" value="">
                                                    </li>
                                                    @forelse ($brands as $item)
                                                        <li wire:key="itembrand-{{ $item['id'] }}">
                                                            <label class="d-block"
                                                                for="brand-{{ $item['id'] }}"><a>{{ $item['brand_name'] }}</a></label>
                                                            <input type="radio" id="brand-{{ $item['id'] }}"
                                                                class="d-none" wire:model="brand" name="brand"
                                                                value="{{ $item['id'] }}">
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li>
                                                        <label class="d-block" for="price-0"><a>Tất cả</a></label>
                                                        <input type="radio" id="price-0" class="d-none"
                                                            wire:model="price" name="price" value="">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-1"><a>0,00đ
                                                                - 100.000đ</a></label>
                                                        <input type="radio" id="price-1" class="d-none"
                                                            wire:model="price" name="price" value="0-10000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-2"><a>150.000đ -
                                                                300.000đ</a></label>
                                                        <input type="radio" id="price-2" class="d-none"
                                                            wire:model="price" name="price" value="150000-300000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-3"><a>300.000đ -
                                                                400.000đ</a></label>
                                                        <input type="radio" id="price-3" class="d-none"
                                                            wire:model="price" name="price" value="300000-400000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-4"><a>400.000đ -
                                                                600.000đ</a></label>
                                                        <input type="radio" id="price-4" class="d-none"
                                                            wire:model="price" name="price" value="400000-600000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-5"><a>600.000đ -
                                                                750.000đ</a></label>
                                                        <input type="radio" id="price-5" class="d-none"
                                                            wire:model="price" name="price" value="500000-750000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-6"><a>750.000đ+</a></label>
                                                        <input type="radio" id="price-6" class="d-none"
                                                            wire:model="price" name="price" value="750000">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    {{-- <p>Showing 1–5 of 126 results</p> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="d-flex align-items-center justify-content-end">
                                    <p>Sort by:</p>
                                    <select wire:model="typefilter" id="typefilter" class="ml-1">
                                        <option value="price">Giá</option>
                                        <option value="created_at">Thời gian</option>
                                    </select>
                                    <select wire:model="filter" class="ml-1">
                                        <option value="asc">Tăng dần</option>
                                        <option value="desc">Giảm dần</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($products as $item)
                            <div wire:key="itemproduct-{{ $item['id'] }}" class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg"
                                        style='background-image: url("{{ asset('storage/product/' . $item['img'][0]['image_name']) }}");'
                                        data-setbg="{{ asset('storage/product/' . $item['img'][0]['image_name']) }}">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>
                                            <li><a href="#"><img src="img/icon/search.png" alt=""></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>{{ $item['product_name'] }}</h6>
                                        <a wire:click="addToCart(1,{{ $item['id'] }},1,{{ $item['price'] }},{{ $item['name'] }})"
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
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($products) > 0)
                                {{ $products->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     // $('#typefilter').change(function() {
        //     //     let data = $('#typefilter').val();
        //     //     console.log( data)
        //     // })
        // })
    </script>

</div>
