@push('css')
    <style>
        .link:hover {
            color: blue !important;
        }

        .grouplist {
            background: #eeeeee;
            border-radius: 5px;
            padding: 1rem;
            position: relative;
        }

        .div-img {
            height: 5rem;
        }

        .div-img img {
            height: 100%;
        }
    </style>
@endpush
<div>
    <div class="container">
        <h4 class="row border-bottom ml-3 mt-4 mb-3">Danh sách phiếu giảm giá của bạn</h4>
        <div class="row">
            @forelse ($listcoupons as $item)
                <div class="mb-4 col-6">
                    <div class="w-100 grouplist">
                        <div class="offer-text" style="position: relative;width:50%;z-index: 1">
                            <h6 class="text-white text-uppercase" style="font-weight: 800;color: #000000d9 !important">
                                Giảm giá
                                {{ number_format($item['percent'], 0, ',', ',') }}{{ $item['unit'] == 1 ? '%' : 'Đ' }}
                            </h6>
                            <h3 class="text-white" style="font-weight: 700;color:#040404d9 !important;">
                                {{ $item['name'] }}</h3>
                            <p class="text-white"
                                style="height: 2.8rem;overflow:hidden;color:#000000d9 !important;margin-bottom:10px;">
                                {{ $item['description'] }}</p>
                            @if ($item['expiry'])
                                <div class="mb-1">Từ {{ $item['begin'] }} đến
                                    {{ $item['end'] }}</div>
                            @else
                                <div class="mb-2 text-center">Đã hết hạn</div>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('shop.index') }}" class="primary-btn">Mua Ngay</a>
                        </div>
                        <div class="img"
                            style="position: absolute;padding: 0.6rem;top: 0px;right: 0px;width: 50%;height: 100%;z-index:0;">
                            <img style="height: 100%;width:100%;border-radius: 5px;"
                                src="{{ asset('storage/discount/' . $item['img'][0]['image_name']) }}" alt="">
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
