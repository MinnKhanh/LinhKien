@push('css')
    <style>
        .link:hover {
            color: blue !important;
        }
    </style>
@endpush
<div>
    <div class="d-flex mb-5">
        <div class="mr-3">
            <label for="" class="d-block">Tên</label>
            <input wire:model="searchName" class="form-control" id="name" placeholder="Tên nhãn hàng">
        </div>
    </div>
    <table class="table container">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Ảnh</th>
                <th scope="col" class="text-center">Tên</th>
                <th scope="col" class="text-center">Quốc gia</th>
                <th scope="col" class="text-center">Mô tả</th>
                <th scope="col" class="text-center">Website</th>
                <th scope="col" class="fix text-center">Công cụ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp

            @forelse ($brands as $item)
                <tr>
                    <th scope="col" class="text-center align-middle ">{{ $index++ }}</th>
                    <th scope="col" class="text-center align-middle " style="height:5rem;width:5rem;"> <img
                            src='{{ isset($item['img'][0]) ? asset('storage/brand/' . $item['img'][0]['image_name']) : '' }}'
                            style="width: 100%;" alt=""></th>
                    <th scope="col" class="text-center align-middle ">{{ $item['brand_name'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['brand_nation'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['brand_description'] }}</th>
                    <th scope="col" class="text-center align-middle "><a class="link"
                            style="color: #00b1ff; !important"
                            href="{{ $item['brand_website'] }}">{{ $item['brand_website'] }}</a>
                    </th>
                    <th scope="col" class="text-center align-middle d-flex justify-content-center align-items-center"
                        style="height: 85px;padding:0px">
                        <li class="list-inline-item icon-trash">
                            <a href="{{ route('admin.brand.update', ['id' => $item['id']]) }}"
                                class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        </li>
                        <li class="list-inline-item icon-trash">
                            <button class="btn btn-danger btn-sm rounded-0" type="button"
                                wire:click="removeBrand({{ $item['id'] }})" data-toggle="tooltip" data-placement="top"
                                title="Delete"><i class="fa fa-trash"></i></button>
                        </li>
                    </th>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <div class="row mb-5">
        <div class="col-lg-12">
            @if (count($brands) > 0)
                {{ $brands->links() }}
            @endif

        </div>
    </div>
</div>
