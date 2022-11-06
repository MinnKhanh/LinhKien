<div>
    <table class="table container">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Khách hàng</th>
                <th scope="col" class="text-center">Địa chỉ</th>
                <th scope="col" class="text-center">Điện thoại</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Giảm giá</th>
                <th scope="col" class="text-center">Số lượng</th>
                <th scope="col" class="text-center">Phương thức thanh toán</th>
                <th scope="col" class="text-center">Trạng thái</th>
                <th scope="col" class="text-center">Tổng giá</th>
                <th scope="col" class="text-center">Ngày tạo</th>
                <th scope="col" class="fix text-center">Tool</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $item)
                <tr>
                    <th scope="col" class="text-center align-middle " style="height:5rem;width:5rem;">
                        {{ $item['name'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['address'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['phone'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['email'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['discount'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['quantity'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['paymentmethod'] }}</th>
                    <th scope="col" class="text-center align-middle ">
                        <select id="">
                            <option {{ $item['status'] == 1 ? 'selected' : '' }} value=1>Đang chờ sử lý</option>
                            <option {{ $item['status'] == 2 ? 'selected' : '' }} value=2>Đang vận chuyển</option>
                            <option {{ $item['status'] == 3 ? 'selected' : '' }} value=3>Đã nhận</option>
                            <option {{ $item['status'] == 4 ? 'selected' : '' }} value=4>Đã hoàn trả</option>
                        </select>
                    </th>
                    <th scope="col" class="text-center align-middle ">{{ $item['totalPrice'] }}</th>
                    <th scope="col" class="text-center align-middle d-flex justify-content-center align-items-center"
                        style="height: 85px;padding:0px">
                        {{-- <li class="list-inline-item icon-trash">
                            <a href="" class="btn btn-warning btn-sm rounded-0" type="button"
                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                    class="fa fa-pencil"></i></a>
                        </li>
                        <li class="list-inline-item icon-trash">
                            <button class="btn btn-danger btn-sm rounded-0" type="button" disabled
                                wire:click="removeOrder({{ $item['id'] }})" data-toggle="tooltip"
                                data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                        </li> --}}
                    </th>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <div class="row mb-5">
        <div class="col-lg-12">
            {{-- @if (count($categories) > 0)
                {{ $categories->links() }}
            @endif --}}

        </div>
    </div>
</div>
