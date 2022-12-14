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

            .link {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0px;
                left: 0px;
                /* z-index: -1; */
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
                                        <a data-toggle="collapse" data-target="#collapseOne">Ph??n loa??i</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll" tabindex="1"
                                                    style="overflow-y: hidden; outline: none;">
                                                    <li>
                                                        <label class="d-block" for="categories-0"><a>T????t
                                                                ca??</a></label>
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
                                        <a data-toggle="collapse" data-target="#collapseTwo">Nha??n ha??ng</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <li wire:key="itembrand-0">
                                                        <label class="d-block" for="brand-0"><a>T????t
                                                                ca??</a></label>
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
                                        <a data-toggle="collapse" data-target="#collapseThree">Gia??</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li>
                                                        <label class="d-block" for="price-0"><a>T????t
                                                                ca??</a></label>
                                                        <input type="radio" id="price-0" class="d-none"
                                                            wire:model="price" name="price" value="">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-1"><a>0,00??
                                                                - 100.000??</a></label>
                                                        <input type="radio" id="price-1" class="d-none"
                                                            wire:model="price" name="price" value="0-10000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-2"><a>150.000?? -
                                                                300.000??</a></label>
                                                        <input type="radio" id="price-2" class="d-none"
                                                            wire:model="price" name="price" value="150000-300000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-3"><a>300.000?? -
                                                                400.000??</a></label>
                                                        <input type="radio" id="price-3" class="d-none"
                                                            wire:model="price" name="price" value="300000-400000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-4"><a>400.000?? -
                                                                600.000??</a></label>
                                                        <input type="radio" id="price-4" class="d-none"
                                                            wire:model="price" name="price" value="400000-600000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-5"><a>600.000?? -
                                                                750.000??</a></label>
                                                        <input type="radio" id="price-5" class="d-none"
                                                            wire:model="price" name="price" value="500000-750000">
                                                    </li>
                                                    <li>
                                                        <label class="d-block" for="price-6"><a>750.000??+</a></label>
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
                                    {{-- <p>Showing 1???5 of 126 results</p> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="d-flex align-items-center justify-content-end">
                                    <p>Sort by:</p>
                                    <select wire:model="typefilter" id="typefilter" class="ml-1">
                                        <option value="price">Gia??</option>
                                        <option value="created_at">Th????i gian</option>
                                    </select>
                                    <select wire:model="filter" class="ml-1">
                                        <option value="asc">T??ng d????n</option>
                                        <option value="desc">Gia??m d????n</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($products as $item)
                            <div wire:key="itemproduct-{{ $item['id'] }}" class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    @if (count($item['Discount']) > 0)
                                        <div
                                            style="position: absolute;background: #ff0000a8;top: 0px;left: 21px;z-index: 1;padding: 10px 2px;">
                                            {{ number_format($item['Discount'][0]['percent'], 0, ',', ',') }}{{ $item['Discount'][0]['unit'] == 1 ? '%' : '??' }}
                                        </div>
                                    @endif
                                    <div></div>
                                    <div class="product__item__pic set-bg"
                                        style='background-image: url("{{ asset('storage/product/' . $item['img'][0]['image_name']) }}");'
                                        data-setbg="{{ asset('storage/product/' . $item['img'][0]['image_name']) }}">
                                        <a class="link"
                                            href="{{ route('shop.detail', ['id' => $item['id']]) }}"></a>
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
                                            <a href="{{ route('login') }}" style="cursor: pointer;"
                                                class="add-cart">+ Add To
                                                Cart</a>
                                        @endif
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>{{ number_format($item['price'], 0, ',', ',') }} ??</h5>
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
        document.addEventListener('DOMContentLoaded', function() {
            $(".nice-scroll").niceScroll()
        })
    </script>

</div>
