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
            <label for="" class="d-block">Tiều đề</label>
            <input wire:model="searchTitle" class="form-control" id="name" placeholder="Tiêu đề">
        </div>
    </div>
    <table class="table container">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Tiêu đề</th>
                <th scope="col" class="text-center">Mô tả</th>
                <th scope="col" class="fix text-center">Tool</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp

            @forelse ($listnews as $item)
                <tr>
                    <th scope="col" class="text-center align-middle ">{{ $index++ }}</th>
                    <th scope="col" class="text-center align-middle " style="height:5rem;width:5rem;"> <img
                            src='{{ isset($item['img'][0]) ? asset('storage/news/' . $item['img'][0]['image_name']) : '' }}'
                            style="width: 100%;" alt=""></th>
                    <th scope="col" class="text-center align-middle ">{{ $item['title'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['description'] }}</th>
                    <th scope="col" class="text-center align-middle d-flex justify-content-center align-items-center"
                        style="height: 85px;padding:0px">
                        <li class="list-inline-item icon-trash">
                            <a href="{{ route('admin.inforshop.editnew', ['id' => $item['id']]) }}"
                                class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        </li>
                        <li class="list-inline-item icon-trash">
                            <button class="btn btn-danger btn-sm rounded-0" type="button"
                                wire:click="removeNew({{ $item['id'] }})" data-toggle="tooltip" data-placement="top"
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
            @if (count($listnews) > 0)
                {{ $listnews->links() }}
            @endif

        </div>
    </div>
</div>
