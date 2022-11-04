<div>
    <table class="table container">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="fix text-center">Tool</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp

            @forelse ($categories as $item)
                <tr>
                    <th scope="col" class="text-center align-middle ">{{ $index++ }}</th>
                    <th scope="col" class="text-center align-middle " style="height:5rem;width:5rem;"> <img
                            src='{{ isset($item['img'][0]) ? asset('storage/product/' . $item['img'][0]['image_name']) : '' }}'
                            style="width: 100%;" alt=""></th>
                    <th scope="col" class="text-center align-middle ">{{ $item['category_name'] }}</th>
                    <th scope="col" class="text-center align-middle ">{{ $item['description'] }}</th>
                    <th scope="col" class="text-center align-middle d-flex justify-content-center align-items-center"
                        style="height: 85px;padding:0px">
                        <li class="list-inline-item icon-trash">
                            <a href="{{ route('admin.category.update', ['id' => $item['id']]) }}"
                                class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        </li>
                        <li class="list-inline-item icon-trash">
                            <button class="btn btn-danger btn-sm rounded-0" type="button"
                                wire:click="removeCategory({{ $item['id'] }})" data-toggle="tooltip"
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
            @if (count($categories) > 0)
                {{ $categories->links() }}
            @endif

        </div>
    </div>
</div>
