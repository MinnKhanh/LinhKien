<div>
    <div class="d-flex mb-5">
        <div class="mr-3">
            <label for="" class="d-block">Tên</label>
            <input wire:model="searchName" class="form-control" id="name" placeholder="Tên khách hàng">
        </div>
        <div class="mr-3">
            <label for="" class="d-block">Số điện thoại</label>
            <input wire:model="searchPhone" class="form-control" id="name" placeholder="Tên khách hàng">
        </div>
        <div class="mr-3">
            <label for="" class="d-block">Email</label>
            <input wire:model="searchEmail" class="form-control" id="name" placeholder="Tên khách hàng">
        </div>
        <div class="mr-3">
            <label for="" class="d-block">Thời gian tạo</label>
            <input type="date" class="end form-control ml-1" style="height: 35px" wire:model="searchCreateDate"
                class="">
        </div>
        <div class="mr-3">
            <label for="" class="d-block">Quyền</label>
            <select class="custom-select" wire:model="permission">
                @forelse ($roles as $key=>$itemrole)
                    <option value={{ $key }}>
                        {{ $itemrole }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="container-fluid" style="overflow-x: scroll;">
        <table class="table w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Tên</th>
                    <th scope="col" class="text-center">Địa chỉ</th>
                    <th scope="col" class="text-center">Điện thoại</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Thành phố</th>
                    <th scope="col" class="text-center">Quận/Huyện</th>
                    <th scope="col" class="text-center">Ngày tạo</th>
                    <th scope="col" class="text-center">Quyền</th>
                    <th scope="col" class="fix text-center">Tool</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $item)
                    <tr>
                        <td scope="col" class="text-center align-middle " style="height:5rem;width:5rem;">
                            {{ $item['name'] }}
                        </td>
                        <td scope="col" class="text-center align-middle ">{{ $item['address'] }}</td>
                        <td scope="col" class="text-center align-middle ">
                            {{ !$item['phone'] ? 'Trống' : $item['phone'] }}</td>
                        <td scope="col" class="text-center align-middle ">
                            {{ !$item['email'] ? 'Trống' : $item['email'] }}</td>
                        <td scope="col" class="text-center align-middle ">
                            {{ !$item['city'] ? 'Trống' : $item['city'] }}
                        </td>
                        <td scope="col" class="text-center align-middle ">
                            {{ !$item['district'] ? 'Trống' : $item['district'] }}</td>
                        <td scope="col" class="text-center align-middle ">{{ $item['created_at']->format('d/m/Y') }}
                        </td>
                        <td scope="col" class="text-center align-middle ">
                            @php
                                $user = App\Models\User::where('id', $item['id'])->first();
                            @endphp
                            <select class="form-control roles" data-user={{ $item['id'] }}>
                                @forelse ($roles as $key=>$itemrole)
                                    <option {{ $user->can($itemrole) ? 'selected' : '' }} value={{ $key }}>
                                        {{ $itemrole }}</option>
                                @empty
                                @endforelse
                            </select>
                        </td>
                        <td scope="col"
                            class="text-center align-middle d-flex justify-content-center align-items-center"
                            style="height: 85px;padding:0px">
                            <li class="list-inline-item icon-plus">
                                <a class="btn btn-warning btn-sm rounded-0"
                                    href="{{ route('admin.customers.edit', ['id' => $item['id']]) }}"><i
                                        class="fa fa-pencil"></i></a>
                            </li>
                            <li class="list-inline-item icon-trash">
                                <button class="btn btn-danger btn-sm rounded-0" type="button"
                                    wire:click="removeUser({{ $item['id'] }})" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </li>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12">
            @if (count($customers) > 0)
                {{ $customers->links() }}
            @endif

        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('change', '.roles', function() {
                console.log('cos chay nah')
                let role = parseInt($(this).val());
                let userid = parseInt($(this).attr('data-user'));
                console.log(role, userid)
                window.livewire.emit('changeRole', {
                    0: role,
                    1: userid
                });
            })
        })
    </script>
@endpush
