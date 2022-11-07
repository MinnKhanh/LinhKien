<div class="container py-3 py-md-5">
    <h3 class="w-100 text-center">Thông Tin Chi Tiết Hóa Đơn</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <div class="d-flex justify-content-between">
                    <h4>
                        Chi tiết đơn hàng - <span class="fw-bold">
                            {{ $order['status'] == 1 ? 'Đang sử lý' : ($order['status'] == 2 ? 'Đang giao' : ($order['status'] == 3 ? 'Đã nhận' : 'Bị hoàn lại')) }}
                        </span>
                    </h4>
                    <div>
                        <a href="{{ route('order.index') }}" class="btn btn-primary text-white">Quay lại</a>
                        <a href="{{ route('admin.orders.prictorder', ['id' => $idorder]) }}" class="btn btn-success"
                            wire:click='print'>In
                            hóa đơn</a>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-4">
                        <div class="card bg-light p-2">
                            <h5 class="border-bottom">Thông tin người nhận</h5>
                            <p class="fw-bold">Tên khách hàng: {{ $order['username'] }}</p>
                            <p>Địa chỉ:
                                {{ $order['address'] . '-' . $order['district'] . '-' . $order['city'] }}
                            </p>
                            <p>Điện thoại: {{ $order['phone'] }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-light p-2">
                            <h5 class="border-bottom">Hình thức giao hàng</h5>
                            <p>Giao trước: {{ $date }}</p>
                            <p>Đơn vị vẩn chuyển: <span class="fw-bold">Express</span></p>
                            <p>Phí vận chuyển: {{ number_format($order['ship'] + 20000) }}Đ</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-light p-2">
                            <h5 class="border-bottom">Hình thức thanh toán</h5>
                            <p>Phương thức:
                                {{ $order['paymentmethod'] === 1 ? 'Thanh toán Online' : 'Thanh toán khi nhận hàng' }}
                            </p>
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
                                    <h6>
                                        Discont: <span class="fw-bold">{{ number_format($order['discount']) }}</span>Đ
                                    </h6>
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="mt-2 ml-2 mb-2">
                        Tổng cộng: <span
                            class="text-danger fw-bold">{{ number_format($order['totalPrice'] + $order['ship']) }}</span>Đ
                    </h4>
                </div>

                {{-- @if ($order->status == 'Đã giao' || $order->status == 'Đã hủy' || $order->status == 'Giao hàng thất bại')
                @else
                    <div class="card bg-light mt-3">
                        <select wire:model="selected_status" class="form-select" aria-label="Default select example">
                            <option value="current">--Chọn trạng thái--</option>
                            <option value="Chờ xác nhận">Chờ xác nhận</option>
                            <option value="Đang xử lý">Đang xử lý</option>
                            <option value="Đang vận chuyển">Đang vận chuyển</option>
                            <option value="Đã giao">Đã giao</option>
                            <option value="Đã hủy">Đã hủy</option>
                            <option value="Giao hàng thất bại">Giao hàng thất bại</option>
                        </select>
                        <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete">Cập nhật</button>
                    </div>
                    <div wire:ignore.self class="modal fade" id="ModalDelete" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận cập nhật</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có muốn cập nhật trạng thái mới của đơn hàng không? Thao tác này không thể
                                        phục hồi!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-btn"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" wire:click="updateStatus"
                                        class="btn btn-primary text-white close-modal" data-bs-dismiss="modal">Dồng
                                        ý</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>
