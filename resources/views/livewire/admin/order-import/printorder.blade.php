 @push('css')
     <style>
         li {
             list-style: none;
         }
     </style>
 @endpush
 <div id="page-wrap">
     <div id="header" class="container-fluid text-center mb-5">
         <h6>Của Hàng Linh Kiện</h6>
         <h3>Hóa Đơn Thanh Toán</h3>
     </div>
     <div id="details" class="row mb-5">
         <div class="col col-xs-6 text-right">
             <ul>
                 <li class="col-xs-12">
                     <p class="d-inline-block">Tên Nhà Cung Cấp: </p><span id="partner-name">{{ $order['name'] }}</span>
                 </li>

                 <li class="col-xs-12">
                     <p class="d-inline-block">Địa Chỉ: </p><span id="partner-address">{{ $order['address'] }}</span>
                 </li>

                 <li class="col-xs-12">
                     <p class="d-inline-block">Email: </p><span id="partner-tin-no">{{ $order['email'] }}</span>
                 </li>

             </ul>

         </div>
         <div class="col col-xs-6">
             <div class="col col-xs-12 text-left">
                 <ul>
                     <li class="col-xs-12">
                         <p class="d-inline-block">Điện Thoại: </p>
                         <span id="partner-phone" cols="13" rows="2"
                             style="width: auto;">{{ $order['phone'] }}</span>
                     </li>
                     <li class="col-xs-12">
                         <p class="d-inline-block">Ngày Tạo: </p>
                         <span class="date" id="fr-date">{{ $order['created_at'] }}</span>
                     </li>

                     <li class="col-xs-12">
                         <p class="d-inline-block">Địa Chỉ Nhận: </p>
                         <span class="date" id="delivery-date">{{ $date }}</span>
                     </li>
                     <li class="col-xs-12">
                         <p class="d-inline-block">Địa Chỉ Nhận: </p>
                         <span id="shipping-address" rows="3">{{ $order['address'] }}</span>
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
             @forelse ($orderdetails as $item)
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
