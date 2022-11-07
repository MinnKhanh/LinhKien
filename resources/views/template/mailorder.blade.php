@extends('layouts.layoutprint') @push('css')
    <style>
        li {
            list-style: none;
        }
    </style>
@endpush
@section('content')
    <div id="page-wrap">
        <div id="header" class="container-fluid text-center mb-5">
            <h6>Của Hàng Linh Kiện</h6>
            <h3>Hóa Đơn Thanh Toán</h3>
        </div>
        <div id="details" class="row mb-5">
            <div class="col col-xs-6 text-right">
                <ul>
                    <li class="col-xs-12 d-flex">
                        <p class="d-inline-block">Tên Khách Hàng: <span id="partner-name">{{ $order['name'] }}</span></p>
                    </li>

                    <li class="col-xs-12 d-flex">
                        <p class="d-inline-block">Địa Chỉ: <span id="partner-address">{{ $order['address'] }}</span></p>
                    </li>

                    <li class="col-xs-12 d-flex">
                        <p class="d-inline-block">Email: <span id="partner-tin-no">{{ $order['email'] }}</span></p>
                    </li>
                    <li class="col-xs-12 d-flex" style="">
                        <p class="d-inline-block">Phương Thức Thanh Toán: <span
                                id="partner-tin-no">{{ $order['paymentmethod'] == 1 ? 'Online' : 'Trả khi nhận' }}</span>
                        </p>
                    </li>

                </ul>

            </div>
            <div class="col col-xs-6">
                <div class="col col-xs-12 text-left">
                    <ul>
                        <li class="col-xs-12 d-flex">
                            <p class="d-inline-block">Điện Thoại: <span id="partner-phone" cols="13" rows="2"
                                    style="width: auto;">{{ $order['phone'] }}</span></p>

                        </li>
                        <li class="col-xs-12 d-flex">
                            <p class="d-inline-block">Ngày Tạo: <span class="date"
                                    id="fr-date">{{ $order['created_at'] }}</span></p>

                        </li>

                        <li class="col-xs-12 d-flex">
                            <p class="d-inline-block">Địa Chỉ Nhận: <span class="date"
                                    id="delivery-date">{{ $date }}</span></p>

                        </li>
                        <li class="col-xs-12 d-flex">
                            <p class="d-inline-block">Địa Chỉ Nhận: <span id="shipping-address"
                                    rows="3">{{ $order['address'] }}</span></p>

                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div id="note" class="mb-5 ml-4">
            <h3>Ghi chú:</h3>
            <div contenteditable="true">{{ $order['note'] }}
            </div>
        </div>
        <table id="items" class="text-center w-100">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Loại</th>
                    <th>Nhãn Hàng</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orderdetial as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $item['product_name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ number_format($item['quantity'] * $item['price']) }}</td>
                        <td>{{ $item['brand_name'] }}</td>
                        <td>{{ $item['category_name'] }}</td>
                    </tr>
                @empty
                @endforelse

                <tr>
                    <td colspan="6" class="total-line text-right">Tổng số lượng: </td>
                    <td class="blank">{{ $order['quantity'] }}</td>
                </tr>

                <tr>
                    <td colspan="6" class="total-line text-right">Tổng giá trị: </td>
                    <td colspan="1" class="blank"> {{ number_format($order['totalPrice']) }}</td>
                </tr>
            </tbody>
        </table>
        <br />
        <br />
        <br />
        <p class="text-center">Thông tin hóa đơn của cửa hang điện tử</p>
        <hr />
        <div id="terms">
            <h3>Terms &amp; Conditions</h3>
            <ol>
                <li contenteditable="true"> Please send a copy of Delivery Note along with stock.</li>
                <li contenteditable="true"> Please Mention the Delivery note no. on the transfer note.</li>
                <li contenteditable="true"> Freight Charges are not included.</li>
            </ol>

        </div>
    </div>
    @push('js')
        <script>
            window.addEventListener("DOMContentLoaded", (event) => {
                window.print();
            });
        </script>
    @endpush
@endsection
