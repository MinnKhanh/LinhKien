@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <div class="pro-qty">
                                        <input wire:model="quantity" id="count" type="text">
                                    </div>
                                </div>
                                <a wire:click="addToCart()" class="primary-btn addCart" style="color:white;">add to
                                    cart</a>
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
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Đánh giá sản
                                        phẩm</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Description</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>{{ $product['description'] }}</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
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
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
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
                                <div class="tab-pane mt-3" id="tabs-7" role="tabpanel">
                                    <div class="row">

                                        <form action="" id="formreview"
                                            class="col-md-12 product__details__tab__content__item">
                                            @csrf
                                            <input type="text" class="d-none" name="id"
                                                value={{ $product['id'] }}>
                                            <h5>Products Infomation</h5>
                                            <div class="d-flex my-3">
                                                <p class="mb-0 mr-2">Đánh giá của bạn * :</p>
                                                <div id="starrate"></div>
                                                <input type="number" class="d-none" id="rate" name="rate">
                                            </div>
                                            <div>
                                                <div class="form-group row">
                                                    <div class='col-6'>
                                                        <label for="message">Bình luận của bạn *</label>
                                                        <textarea id="message" name="review" cols="30" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class='col-6' style="margin-top: 32px">
                                                        <input type="button" value="Submit"
                                                            class="btn btn-primary px-3 rating">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="{{ asset('js/rating-star-icons/dist/rating.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.addCart').click(function(e) {
                var data = parseInt($('#count').val());

                @this.set('quantity', data);
            });
        });
    </script>
</div>
