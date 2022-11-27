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
    <div>
        <div class="d-flex mb-5">
            <div class="mr-3">
                <label for="" class="d-block">Loại</label>
                <select wire:model="type" class="form-control">
                    <option value=1>Quảng cáo chính</option>
                    <option value=2>Quảng cáo giảm giá</option>
                </select>
            </div>
        </div>
        <table class="table container">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Tên</th>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col" class="text-center">Mô tả</th>
                    <th scope="col" class="text-center">Link</th>
                    @if ($type == 1)
                        <th scope="col" class="text-center">Trạng thái</th>
                    @endif
                    <th scope="col" class="fix text-center">Tool</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp

                @forelse ($introduces as $item)
                    <tr>
                        <th scope="col" class="text-center align-middle ">{{ $index++ }}</th>
                        <th scope="col" class="text-center align-middle ">{{ $item['title'] }}</th>
                        <th scope="col" class="text-center align-middle " style="height:5rem;width:5rem;"> <img
                                src='{{ isset($item['img'][0]) ? asset('storage/introduce/' . $item['img'][0]['image_name']) : '' }}'
                                style="width: 100%;" alt=""></th>
                        <th scope="col" class="text-center align-middle ">{{ $item['description'] }}</th>
                        <th scope="col" class="text-center align-middle ">{{ $item['link'] }}</th>
                        @if ($type == 1)
                            <th scope="col" class="text-center align-middle ">
                                <select class="form-control roles" wire:change="changeActive({{ $item['id'] }})">
                                    <option {{ $item['active'] == 0 ? 'selected' : '' }} value=0>Ẩn</option>
                                    <option {{ $item['active'] == 1 ? 'selected' : '' }} value=1>Hiện</option>
                                </select>
                            </th>
                        @endif
                        <th scope="col"
                            class="text-center align-middle d-flex justify-content-center align-items-center"
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
                @if (count($introduces) > 0)
                    {{ $introduces->links() }}
                @endif

            </div>
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
