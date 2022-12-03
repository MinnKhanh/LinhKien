<div>
    <section class="breadcrumb-blog set-bg" data-setbg="{{ asset('storage/news/vonke.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Tin Tức</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @forelse ($news as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg"
                                data-setbg="{{ isset($item['img'][0]) ? asset('storage/news/' . $item['img'][0]['image_name']) : '' }}">
                            </div>
                            <div class="blog__item__text">
                                <span><img src="img/icon/calendar.png"
                                        alt="">{{ $item['created_at']->format('d/m/Y') }}</span>
                                <h5>{{ $item['title'] }}</h5>
                                <a href="{{ route('service.newdetail', ['new' => $item['id']]) }}">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>
</div>
