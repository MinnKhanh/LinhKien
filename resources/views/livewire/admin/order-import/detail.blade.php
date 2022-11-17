<div class="container py-3 py-md-5">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <div class="d-flex justify-content-between">
                    <h4>
                        Chi tiết đơn hàng - <span class="fw-bold">
                        </span>
                    </h4>
                    <div>
                        <a href="{{ route('admin.orderimport.index') }}" class="btn btn-primary text-white">Quay lại</a>
                        <a href="{{ route('admin.orderimport.printorder', ['id' => $idorder]) }}"
                            class="btn btn-success">In
                            hóa đơn</a>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12">
                        <div class="card bg-light p-2">
                            <h5 class="border-bottom">Thông tin người nhận</h5>
                            <p class="fw-bold">Tên khách hàng: {{ $order['name'] }}</p>
                            <p>Địa chỉ:
                                {{ $order['address'] }}
                            </p>
                            <p>Điện thoại: {{ $order['phone'] }}</p>
                            <p>Email: {{ $order['email'] }}</p>
                            <p>Ngày tạo: {{ $date }}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="table-responsive text-center">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orderdetails as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <th style="width: 100px">
                                            @if (count($item['img']))
                                                <img class="w-100"
                                                    src="{{ asset('storage/product/' . $item['img'][0]['image_name']) }}" />
                                            @else
                                                <img class="w-100"
                                                    src="https://whetstonefire.org/wp-content/uploads/2020/06/image-not-available.jpg" />
                                            @endif
                                        </th>
                                        <td>
                                            {{ $item['product_name'] }}
                                        </td>
                                        <td>
                                            {{ $item['quantity'] }}
                                        </td>
                                        <td>
                                            {{ $item['price'] }}
                                        </td>
                                        <td>
                                            {{ $item['price'] * $item['quantity'] }}
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="6">Chưa có sản phẩm nào</td>
                                @endforelse
                                <td colspan="6" class="text-end">
                                    <h6>
                                        Tổng: <span class="fw-bold">{{ number_format($order['totalPrice']) }}</span>Đ
                                    </h6>
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="mt-2 ml-2 mb-2">
                        Tổng cộng: <span class="text-danger fw-bold">{{ number_format($order['totalPrice']) }}</span>Đ
                    </h4>
                </div>


            </div>
        </div>
    </div>
</div>
