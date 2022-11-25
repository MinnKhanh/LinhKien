@push('css')
    <style>
        .link:hover {
            color: blue !important;
        }
    </style>
@endpush
<div>
    @php
        use App\Enums\Typediscount;
    @endphp
    <table class="table container">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Code</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">Begin</th>
                <th scope="col" class="text-center">End</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Sử dụng</th>
                <th scope="col" class="fix text-center">Tool</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp

            @forelse ($listdata as $item)
                <tr>
                    <th scope="col" class="text-center align-middle ">{{ $index++ }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['code'] }}</th>
                    <th scope="col" class="text-center align-middle " style="height:5rem;width:5rem;"> <img
                            src='{{ isset($item['img'][0]) ? asset('storage/discount/' . $item['img'][0]['image_name']) : '' }}'
                            style="width: 100%;" alt=""></th>
                    <th scope="col" class="text-center align-middle ">{{ $item['name'] }}</th>
                    <th scope="col" class="text-center align-middle ">
                        {{ Typediscount::getTypesOfDiscount($item['type']) }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['begin'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['end'] }}</th>
                    <th scope="col" class="text-center align-middle ">
                        {{ $item['percent'] }}{{ $item['unit'] == 1 ? '%' : 'Đ' }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['description'] }}</th>
                    <th scope="col" class="text-center align-middle ">
                        <select class="form-control use" data-id="{{ $item['id'] }}" data-type="{{ $item['type'] }}"
                            data-product="{{ $item['relation_id'] }}">
                            <option {{ $item['apply'] == 0 ? 'selected' : '' }} value=0>Không được sử dụng</option>
                            <option {{ $item['apply'] == 1 ? 'selected' : '' }} value=1>Đang được sử dụng</option>
                        </select>
                    </th>
                    <th scope="col" class="text-center align-middle d-flex justify-content-center align-items-center"
                        style="height: 85px;padding:0px">
                        <li class="list-inline-item icon-trash">
                            <a href="{{ route('admin.discount.edit', ['id' => $item['id']]) }}"
                                class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        </li>
                        <li class="list-inline-item icon-trash">
                            <button class="btn btn-danger btn-sm rounded-0" type="button"
                                wire:click="removeDiscount({{ $item['id'] }})" data-toggle="tooltip"
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
            @if (count($listdata) > 0)
                {{ $listdata->links() }}
            @endif

        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('change', '.use', function() {
                console.log('cos chay nah')
                let use = parseInt($(this).val());
                let id = parseInt($(this).attr('data-id'));
                let type = parseInt($(this).attr('data-type'));
                let product = $(this).attr('data-product') ? parseInt($(this).attr('data-product')) : 0;
                window.livewire.emit('changeApply', {
                    0: use,
                    1: id,
                    2: type,
                    3: product
                });
            })
        })
    </script>
@endpush
