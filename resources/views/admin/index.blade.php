@extends('layouts.masteradmin')
@section('content')
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
                                <h6 id="total_orders">{{ $ordersnumber }}</h6>
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
                                <h6 id="total_money">{{ number_format($sales, 0, ',', ',') }} Đ</h6>
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
                                <h6 id="total_user">{{ $customernumber }}</h6>
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
                                @forelse($listbestcustomer as $key => $item)
                                    <tr>
                                        <td scope="col">{{ $key + 1 }}</td>
                                        <td scope="col">{{ $item['name'] }}</td>
                                        <td scope="col">{{ $item['email'] }}</td>
                                        <td scope="col">{{ $item['count'] }}</td>
                                        <td scope="col">{{ number_format($item['money'], 0, ',', ',') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Chưa có bản ghi</td>
                                    </tr>
                                @endforelse
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
                                @forelse($listbestproduct as $key => $item)
                                    <tr>
                                        <td scope="col">{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('storage/product/' . (isset($item['img'][0]) ? $item['img'][0]['image_name'] : '')) }}"
                                                style="max-width: 100%;" alt="">
                                        </td>
                                        <td scope="col">{{ $item['product_name'] }}</td>
                                        <td scope="col">{{ $item['money'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Chưa có bản ghi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Top Selling -->
        </div>
    </div>
@endsection
