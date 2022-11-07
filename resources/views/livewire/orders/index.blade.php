<div>
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>List Order</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>List Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex mb-5 ml-5 mt-5">
        <div class="mr-3">
            <label for="" class="d-block">Trạng thái</label>
            <select wire:model="status" class="custom-select" id="statuss">
                <option value=0>Tất cả</option>
                <option value=1>Đang chờ sử lý</option>
                <option value=2>Đang vận chuyển</option>
                <option value=3>Đã nhận</option>
                <option value=4>Đã hoàn trả</option>
            </select>
        </div>
        <div class="mr-3">
            <label for="" class="d-block">Thời gian</label>
            <div class="d-flex"> <input type="date" class="begin form-control mr-1" style="height: 35px"
                    wire:model="searchFromDate" class=""> ~
                <input type="date" class="end form-control ml-1" style="height: 35px" wire:model="searchToDate"
                    class="">
            </div>

        </div>
    </div>
    <div class="container-fluid" style="overflow-x: scroll;">
        <table class="table w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Khách hàng</th>
                    <th scope="col" class="text-center">Địa chỉ</th>
                    <th scope="col" class="text-center">Điện thoại</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Giảm giá</th>
                    <th scope="col" class="text-center">Số lượng</th>
                    <th scope="col" class="text-center">Phương thức</th>
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col" class="text-center">Tổng giá</th>
                    <th scope="col" class="text-center">Ngày tạo</th>
                    <th scope="col" class="fix text-center">Tool</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $item)
                    <tr>
                        <td scope="col" class="text-center align-middle " style="height:5rem;width:5rem;">
                            {{ $item['name'] }}
                        </td>
                        <td scope="col" class="text-center align-middle ">{{ $item['address'] }}</td>
                        <td scope="col" class="text-center align-middle ">{{ $item['phone'] }}</td>
                        <td scope="col" class="text-center align-middle ">{{ $item['email'] }}</td>
                        <td scope="col" class="text-center align-middle ">{{ $item['discount'] }}</td>
                        <td scope="col" class="text-center align-middle ">{{ $item['quantity'] }}</td>
                        <td scope="col" class="text-center align-middle ">{{ $item['paymentmethod'] }}</td>
                        <td scope="col" class="text-center align-middle ">
                            @if ($item['status'] == 1)
                                {{ 'Đang chờ sử lý' }}
                            @elseif($item['status'] == 2)
                                {{ 'Đang vận chuyển' }}
                            @elseif($item['status'] == 3)
                                {{ 'Đã nhận' }}
                            @else
                                {{ 'Đã hoàn trả' }}
                            @endif
                        </td>
                        <td scope="col" class="text-center align-middle ">{{ $item['totalPrice'] }}</td>
                        <td scope="col" class="text-center align-middle ">{{ $item['created_at']->format('d/m/Y') }}
                        </td>
                        <td scope="col"
                            class="text-center align-middle d-flex justify-content-center align-items-center"
                            style="height: 85px;padding:0px">
                            <li class="list-inline-item icon-trash">
                                {{-- <form action="{{ route('order.detail') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value={{ $item['id'] }}>
                                    <button type="submit" class="btn btn-warning btn-sm rounded-0" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-eye"></i></button>
                                </form> --}}
                                <a href="{{ route('order.detail', ['id' => $item['id']]) }}"
                                    class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-eye"></i></a>
                            </li>
                            <li class="list-inline-item icon-trash">
                                <button class="btn btn-success btn-sm rounded-0" type="button"
                                    wire:click="Export({{ $item['id'] }})" data-toggle="tooltip" data-placement="top"
                                    title="Delete"><i class="fa fa-print"></i></button>
                            </li>
                            @if ($item['status'] == 1)
                                <li class="list-inline-item icon-trash">
                                    <button class="btn btn-danger btn-sm rounded-0" type="button"
                                        wire:click="removeOrder({{ $item['id'] }})" data-toggle="tooltip"
                                        data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                </li>
                            @endif

                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12">
            @if (count($orders) > 0)
                {{ $orders->links() }}
            @endif

        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.statusitem').change(function() {
                let id = parseInt($(this).attr('data-id'));
                let statuschange = parseInt($(this).val());
                console.log(id, statuschange)
                window.livewire.emit('changestatus', {
                    0: id,
                    1: statuschange
                });
            })
        })
    </script>
@endpush
