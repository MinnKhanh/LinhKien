<div>
    <div class="d-flex mb-5">
        <div class="mr-3">
            <label for="" class="d-block">Tên</label>
            <input wire:model="searchName" class="form-control" id="name" placeholder="Tên sản phẩm">
        </div>
    </div>
    <table class="table container">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Code</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Brand</th>
                <th scope="col" class="text-center">Import Price</th>
                <th scope="col" class="text-center">Sale Price</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="fix text-center">Tool</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp
            @forelse ($products as $item)
                {{-- @php
                    dd($item['id']);
                @endphp --}}
                <tr>
                    <th scope="col" class="text-center align-middle ">{{ $index++ }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['code'] }}</th>
                    <th scope="col" class="text-center align-middle "> <img
                            src="{{ asset('storage/product/' . (isset($item['img'][0]) ? $item['img'][0]['image_name'] : '')) }}"
                            style="max-width: 20%;" alt=""></th>
                    <th scope="col" class="text-center align-middle ">{{ $item['product_name'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['brand'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['import_price'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['price'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['amount'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['description'] }}</th>
                    <th scope="col" class="text-center align-middle d-flex justify-content-center align-items-center"
                        style="height: 85px;">
                        <li class="list-inline-item icon-trash">
                            <a href="{{ route('admin.product.update', ['id' => $item['id']]) }}"
                                class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        </li>
                        <li class="list-inline-item icon-trash">
                            @if ($item['status'] == 1)
                                <button class="btn btn-success btn-sm rounded-0" type="button"
                                    wire:click="changeStatus({{ $item['id'] }},0)" data-toggle="tooltip"
                                    data-placement="top" title="hidden"><i class="fa fa-eye"></i></button>
                            @else
                                <button class="btn btn-secondary btn-sm rounded-0" type="button"
                                    wire:click="changeStatus({{ $item['id'] }},1)" data-toggle="tooltip"
                                    data-placement="top" title="show"><i class="fa fa-eye-slash"></i></button>
                            @endif
                        </li>
                        <li class="list-inline-item icon-trash">
                            <button class="btn btn-danger btn-sm rounded-0" type="button"
                                wire:click="removeProduct({{ $item['id'] }})" data-toggle="tooltip"
                                data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                        </li>
                    </th>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <div class="row mb-5">
        <div class="col-lg-12">
            @if (count($products) > 0)
                {{ $products->links() }}
            @endif

        </div>
    </div>
</div>
