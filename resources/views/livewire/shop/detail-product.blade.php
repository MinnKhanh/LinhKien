@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .grouplist {
            background: #eeeeee;
            border-radius: 5px;
            padding: 1rem;
        }

        .div-img {
            height: 5rem;
        }

        .div-img img {
            height: 100%;
        }

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endpush
<div>
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @forelse ($product['img'] as $item)
                                <li class="nav-item">
                                    <a class="nav-link  @if ($loop->first) active @endif"
                                        data-toggle="tab" href="#tabs-{{ $item['id'] }}" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                            data-setbg="{{ asset('storage/product/' . $item['image_name']) }}">
                                        </div>
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            @forelse ($product['img'] as $item)
                                <div class="tab-pane @if ($loop->first) active @endif"
                                    id="tabs-{{ $item['id'] }}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{ asset('storage/product/' . $item['image_name']) }}" alt="">
                                    </div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product['product_name'] }}</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>{{ number_format($product['price'], 0, ',', ',') }} Đ</h3>
                            <p>{{ $product['description'] }}</p>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="">
                                        <input wire:model="quantity" class="form-control" type="number">
                                    </div>
                                </div>
                                @if (auth()->check())
                                    <a wire:click="addToCart()" class="primary-btn addCart" style="color:white;">add to
                                        cart</a>
                                @else
                                    <a href="{{ route('login') }}" class="primary-btn addCart" style="color:white;">add
                                        to
                                        cart</a>
                                @endif

                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span> 3812912</li>
                                    <li><span>Categories:</span> Clothes</li>
                                    <li><span>Tag:</span> Clothes, Skin, Body</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li wire:click="changeActive(1)" class="nav-item">
                                    <a class="nav-link {{ $active == 1 ? 'active' : '' }}" data-toggle="tab"
                                        href="#tabs-5" role="tab">Mô tả</a>
                                </li>
                                <li wire:click="changeActive(2)" class="nav-item">
                                    <a class="nav-link {{ $active == 2 ? 'active' : '' }}" data-toggle="tab"
                                        href="#tabs-6" role="tab">Đánh giá của người dùng</a>
                                </li>
                                @if (auth()->check())
                                    <li wire:click="changeActive(3)" class="nav-item">
                                        <a class="nav-link {{ $active == 3 ? 'active' : '' }}" data-toggle="tab"
                                            href="#tabs-7" role="tab">Đánh giá sản
                                            phẩm</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane {{ $active == 1 ? 'active' : '' }}" id="tabs-5"
                                    role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Description </p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>{{ $product['description'] }}</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>{{ $product['product_name'] }}</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane {{ $active == 2 ? 'active' : '' }}" id="tabs-6"
                                    role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <h3 class="border-bottom">Danh sách đánh giá</h3>
                                        @forelse ($listrates as $item)
                                            <div class="product__details__tab__content__item grouplist">
                                                <div>{{ $item['name'] }}</div>
                                                <div class="rating ml-2 mb-2">
                                                    @for ($i = 1; $i < $item['number_stars']; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </div>
                                                <div class="ml-2">Thời gian: {{ $item['created_at'] }}</div>
                                                <p class="ml-2 mb-2">{{ $item['review'] }}</p>
                                                <div class="w-100 ml-2">
                                                    <div class="d-flex flex-wrap">
                                                        @forelse (count($item['img']) ? $item['img'] : [] as $itemimg)
                                                            <div class="mr-1 div-img">
                                                                <img class="imgrate"
                                                                    src="{{ asset('storage/rate/' . $itemimg['image_name']) }}"
                                                                    alt="Snow">
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            Hiện chưa có đánh giá nào
                                        @endforelse
                                    </div>
                                </div>
                                <div class="tab-pane {{ $active == 3 ? 'active' : '' }}" id="tabs-7"
                                    role="tabpanel">
                                    @if ($create == 2)
                                        <div
                                            class="col-12 d-flex align-items-center justify-content-center flex-column mt-5">
                                            <h5 class="mb-3">Đã đánh giá</h5>
                                            <div class="form-group row">
                                                <div class='col-6'>
                                                    <input type="button" value="Đánh giá lại"
                                                        wire:click="update()" class="btn btn-primary px-3 rating">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($create == 1)
                                        <div class="row mt-4">

                                            <div action="" id="formreview" class="col-md-12">
                                                <input type="text" class="d-none" name="id"
                                                    value={{ $product['id'] }}>
                                                <h4 class="mb-4">Để lại một đanh giá</h4>
                                                {{-- <div class="d-flex my-3">
                                                    <p class="mb-0 mr-2">Đánh giá của bạn * :</p>
                                                    <div id="starrate"></div>
                                                    <input type="number" wire:model.defer="star" class="d-none"
                                                        id="rate" name="rate">
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col-12 col-md-6" style="font-size: 2em;">
                                                        <p class="mb-0 mr-2">Đánh giá của bạn * :</p>
                                                        <div id="dataReview" data-rating-stars="5"
                                                            data-rating-input="#dataInput"></div>
                                                    </div>
                                                    <div class="col-12 col-md-6 d-none">
                                                        <input type="text" wire:model.defer="star"
                                                            id="dataInput" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group row">
                                                        <div class='col-6'>
                                                            <label for="message">Bình luận của bạn *</label>
                                                            <textarea wire:model.defer='message' id="message" name="review" cols="30" rows="5"
                                                                class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <div class="checkout__input">
                                                                <p> {{ isset($isedit) ? 'Thên Ảnh' : 'Ảnh' }}<span>*</span>
                                                                </p>
                                                                <input type="file" multiple
                                                                    wire:model.defer="photos">
                                                                <p class="error">
                                                                    @error('photos')
                                                                        <strong>{{ $message }}</strong>
                                                                    @enderror
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <div class="w-100">
                                                                <div class="d-flex flex-wrap">
                                                                    @forelse ($photos ? $photos : [] as $item)
                                                                        <div class="col-3">
                                                                            <img src='{{ $item->temporaryUrl() }}'
                                                                                alt="">
                                                                        </div>
                                                                    @empty
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class='col-6' style="margin-top: 32px">
                                                            <input type="button" value="Submit"
                                                                wire:click="sendMessage()"
                                                                class="btn btn-primary px-3 rating">
                                                        </div>
                                                    </div>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
            </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @forelse ($listProductSuggest as $item)
                    <div wire:key="itemproduct-{{ $item['id'] }}" class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                style='background-image: url("{{ asset('storage/product/' . $item['img'][0]['image_name']) }}");'
                                data-setbg="{{ asset('storage/product/' . $item['img'][0]['image_name']) }}">
                                <ul class="product__hover">
                                    <li wire:click="addFavorite({{ $item['id'] }})"><a><img
                                                src="{{ asset('img/icon/heart.png') }}" alt=""></a>
                                    </li>
                                    <li><a><img src="{{ asset('img/icon/search.png') }}" alt=""></a>
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
    @push('js')
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

        <script src="{{ asset('js/rating-star-icons/dist/rating.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $(document).on('click', '#dataReview', function() {
                    @this.set('star', parseInt($('#dataInput').val()));
                })
                var modal = document.getElementById("myModal");
                var img = document.getElementById("myImg");
                var modalImg = document.getElementById("img01");
                var captionText = document.getElementById("caption");
                $(document).on('click', '.imgrate', function() {
                    modal.style.display = "block";
                    modalImg.src = $(this).attr('src');
                    captionText.innerHTML = $(this).attr('alt');
                })

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }








                // code star
                // $('.addCart').click(function(e) {
                //     var data = parseInt($('#count').val());

                //     @this.set('quantity', data);
                // });
                window.addEventListener('star', event => {
                    ! function(t) {
                        var e = {};

                        function r(a) {
                            if (e[a]) return e[a].exports;
                            var s = e[a] = {
                                i: a,
                                l: !1,
                                exports: {}
                            };
                            return t[a].call(s.exports, s, s.exports, r), s.l = !0, s.exports
                        }
                        r.m = t, r.c = e, r.d = function(t, e, a) {
                            r.o(t, e) || Object.defineProperty(t, e, {
                                enumerable: !0,
                                get: a
                            })
                        }, r.r = function(t) {
                            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t,
                                Symbol.toStringTag, {
                                    value: "Module"
                                }), Object.defineProperty(t, "__esModule", {
                                value: !0
                            })
                        }, r.t = function(t, e) {
                            if (1 & e && (t = r(t)), 8 & e) return t;
                            if (4 & e && "object" == typeof t && t && t.__esModule) return t;
                            var a = Object.create(null);
                            if (r.r(a), Object.defineProperty(a, "default", {
                                    enumerable: !0,
                                    value: t
                                }), 2 & e && "string" != typeof t)
                                for (var s in t) r.d(a, s, function(e) {
                                    return t[e]
                                }.bind(null, s));
                            return a
                        }, r.n = function(t) {
                            var e = t && t.__esModule ? function() {
                                return t.default
                            } : function() {
                                return t
                            };
                            return r.d(e, "a", e), e
                        }, r.o = function(t, e) {
                            return Object.prototype.hasOwnProperty.call(t, e)
                        }, r.p = "", r(r.s = 0)
                    }([function(t, e) {
                        const r = {
                            value: parseInt($('#dataInput').val()),
                            stars: 5,
                            half: !1,
                            emptyStar: "far fa-star",
                            halfStar: "fas fa-star-half-alt",
                            filledStar: "fas fa-star",
                            color: "#fcd703",
                            readonly: !1,
                            click: function(t) {
                                console.error("No click callback provided!")
                            }
                        };
                        jQuery.fn.extend({
                            rating: function(t = {}) {
                                return this.each((function() {
                                    $(this).attr("rating") && $(this).empty(),
                                        this.stars = t.value ? t.value : r
                                        .value, this.readonly = t.readonly ? t
                                        .readonly : r.readonly, this.getStars =
                                        function() {
                                            return $(this).find($("i"))
                                        }, $(this).css({
                                            color: t.color ? t.color : r
                                                .color
                                        }).attr("rating", !0), this.readonly ||
                                        ($(this).off("mousemove").on(
                                            "mousemove", (function(e) {
                                                let a = t.half ? t
                                                    .half : r.half;
                                                if (this.getStars()
                                                    .index(e.target) >=
                                                    0)
                                                    if (a) {
                                                        $(this).find(
                                                                "i")
                                                            .attr(
                                                                "class",
                                                                t
                                                                .emptyStar ?
                                                                t
                                                                .emptyStar :
                                                                r
                                                                .emptyStar
                                                            );
                                                        let a = .5;
                                                        $(this).find(
                                                                "i")
                                                            .css({
                                                                width: $(
                                                                        this
                                                                    )
                                                                    .find(
                                                                        "i"
                                                                    )
                                                                    .outerWidth()
                                                            }), e
                                                            .offsetX >
                                                            $(e.target)
                                                            .outerWidth() /
                                                            2 && (a =
                                                                1);
                                                        let s = this
                                                            .getStars()
                                                            .index(e
                                                                .target
                                                            ) + a;
                                                        for (let e =
                                                                0; e <
                                                            this
                                                            .getStars()
                                                            .length; e++
                                                        ) e + .5 <
                                                            s ? $(this
                                                                .getStars()[
                                                                    e])
                                                            .attr(
                                                                "class",
                                                                t
                                                                .filledStar ?
                                                                t
                                                                .filledStar :
                                                                r
                                                                .filledStar
                                                            ) : e <
                                                            s && $(this
                                                                .getStars()[
                                                                    e])
                                                            .attr(
                                                                "class",
                                                                t
                                                                .halfStar ?
                                                                t
                                                                .halfStar :
                                                                r
                                                                .halfStar
                                                            )
                                                    } else {
                                                        $(this).find(
                                                                "i")
                                                            .attr(
                                                                "class",
                                                                t
                                                                .emptyStar ?
                                                                t
                                                                .emptyStar :
                                                                r
                                                                .emptyStar
                                                            );
                                                        let a = this
                                                            .getStars()
                                                            .index(e
                                                                .target
                                                            ) + 1;
                                                        for (let e =
                                                                0; e <
                                                            this
                                                            .getStars()
                                                            .length; e++
                                                        ) e < a &&
                                                            $(this
                                                                .getStars()[
                                                                    e])
                                                            .attr(
                                                                "class",
                                                                t
                                                                .filledStar ?
                                                                t
                                                                .filledStar :
                                                                r
                                                                .filledStar
                                                            )
                                                    }
                                            })), $(this).off("mouseout").on(
                                            "mouseout", (function(t) {
                                                this.printStars()
                                            })), $(this).off("click").on(
                                            "click", (function(e) {
                                                if (t.half ? t.half : r
                                                    .half) {
                                                    let t = .5;
                                                    e.offsetX > $(e
                                                            .target)
                                                        .outerWidth() /
                                                        2 && (t = 1),
                                                        this.stars =
                                                        this.getStars()
                                                        .index(e
                                                            .target) + t
                                                } else this.stars = this
                                                    .getStars().index(e
                                                        .target) + 1;
                                                (t.click ? t.click : r
                                                    .click)({
                                                    stars: this
                                                        .stars,
                                                    event: e
                                                })
                                            })));
                                    const e = t.stars ? t.stars : r.stars;
                                    for (let a = 0; a < e; a++) {
                                        let e = $("<i></i>").addClass(t
                                            .emptyStar ? t.emptyStar : r
                                            .emptyStar).appendTo($(this));
                                        if (this.readonly || e.css({
                                                cursor: "pointer"
                                            }), a > 1e3) return
                                    }
                                    if (this.printStars = function() {
                                            if (t.half ? t.half : r.half) {
                                                $(this).find("i").attr("class",
                                                    t.emptyStar ? t
                                                    .emptyStar : r.emptyStar
                                                );
                                                for (let e = 0; e < this
                                                    .stars; e++) e < this
                                                    .stars - .5 ? $(this
                                                        .getStars()[e]).attr(
                                                        "class", t.filledStar ?
                                                        t.filledStar : r
                                                        .filledStar) : $(this
                                                        .getStars()[e]).attr(
                                                        "class", t.halfStar ? t
                                                        .halfStar : r.halfStar)
                                            } else {
                                                $(this).find("i").attr("class",
                                                    t.emptyStar ? t
                                                    .emptyStar : r.emptyStar
                                                );
                                                for (let e = 0; e < this
                                                    .stars; e++) $(this
                                                    .getStars()[e]).attr(
                                                    "class", t.filledStar ?
                                                    t.filledStar : r
                                                    .filledStar)
                                            }
                                        }, this.stars > 0) {
                                        this.printStars();
                                        (t.click ? t.click : r.click)({
                                            stars: this.stars
                                        })
                                    }
                                }))
                            }
                        }), $((function() {
                            $("[data-rating-stars]").each((function() {
                                let t = {},
                                    e = /^data-rating\-(.+)$/;
                                $.each($(this).get(0).attributes, (function(r,
                                    a) {
                                    if (e.test(a.nodeName)) {
                                        let r = a.nodeName.match(e)[
                                            1];
                                        t[r] = a.nodeValue
                                    }
                                })), null != t.input && (t.click = function(
                                    e) {
                                    $(t.input).val(e.stars)
                                }), $(this).rating(t)
                            }))
                        }))
                    }]);
                });
            });
        </script>
    @endpush

</div>
