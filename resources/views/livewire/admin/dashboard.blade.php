<div class="col-xl-9 col-sm-12 main container">
    <div class="row">
        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card bg-success bg-gradient">
                <div class="card-body">
                    <h2 class="card-title">Đơn đã bán</h2>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div class="ps-3">
                            {{-- <h6 id="total_orders">{{ $ordersnumbers }}</h6> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sales Card -->
        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card bg-danger bg-gradient">
                <div class="card-body">
                    <h2 class="card-title">Doanh Thu Tháng</h2>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        </div>
                        <div class="ps-3">
                            {{-- <h6 id="total_money">{{ $saless }}đ</h6> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Revenue Card -->
        <!-- Customers Card -->
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card customers-card bg-info bg-gradient">
                <div class="card-body">
                    <h2 class="card-title">Khách hàng mới</h2>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="ps-3">
                            {{-- <h6 id="total_user">{{ $customernumbers }}</h6> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Sales -->
        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">5 khách hàng mua nhiều nhất</h5>

                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tổng số đơn</th>
                                <th scope="col">Tổng số tiền</th>
                            </tr>
                        </thead>
                        <tbody id="recent_orders">
                            {{-- @forelse($top5Customers as $key => $item)
                                <tr>
                                    <td scope="col">{{ $key + 1 }}</td>
                                    <td scope="col">{{ $item->name }}</td>
                                    <td scope="col">{{ $item->email }}</td>
                                    <td scope="col">{{ $item->quantity }}</td>
                                    <td scope="col">{{ $item->total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Chưa có bản ghi</td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Recent Sales -->
        <!-- Top Selling -->
        <div class="col-12">
            <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                    <h5 class="card-title">5 sản phẩm bán chạy nhất</h5>

                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Tổng số lượng bán</th>
                            </tr>
                        </thead>
                        <tbody id="new_product">
                            {{-- @forelse($top5Products as $key => $item)
                                <tr>
                                    <td scope="col">{{ $key + 1 }}</td>
                                    <td>
                                        @php
                                            $img = App\Models\ProductImage::where('product_id', $item->id)
                                                ->pluck('image')
                                                ->first();
                                        @endphp
                                        @if ($img != null)
                                            <img src="{{ asset($img) }}" alt="{{ asset($img) }}"
                                                class="img-thumbnail"
                                                style="width: 150px; height: 150px; object-fit: cover" />
                                        @else
                                            <img class="img-thumbnail"
                                                style="width: 150px; height: 150px; object-fit: cover"
                                                src="https://whetstonefire.org/wp-content/uploads/2020/06/image-not-available.jpg"
                                                alt="" />
                                        @endif
                                    </td>
                                    <td scope="col">{{ $item->name }}</td>
                                    <td scope="col">{{ $item->total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Chưa có bản ghi</td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Top Selling -->
    </div>
</div>
