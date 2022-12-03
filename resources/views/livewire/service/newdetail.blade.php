@push('css')
    <style>
        .grouplist {
            background: #eeeeee;
            border-radius: 5px;
            padding: 1rem;
        }
    </style>
@endpush
<div>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 text-center mb-4">
                <h2 style="font-weight: 600">{{ $data['title'] }}</h2>
            </div>
            <div class="col-lg-12 text-center" style="height: 20rem;">
                <img style="width: 80%;height:100%; border-radius: 1rem"
                    src="{{ isset($data['img'][0]) ? asset('storage/news/' . $data['img'][0]['image_name']) : '' }}"
                    alt="">
            </div>
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="img/blog/details/blog-details.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__quote">
                        <p>{{ $data['description'] }}</p>
                    </div>
                    <div class="blog__details__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ isset($data['user']['img'][0]) ? asset('storage/user/' . $data['user']['img'][0]['image_name']) : '' }}"
                                            alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h5>{{ $data['user']['name'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__tags">
                                    <a>{{ $data['created_at'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog__details__comment mb-3">
                        <h4>Để lại bình luận</h4>
                        <form>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <input type="text" wire:model="name" placeholder="Tên">
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input type="text" wire:model="email" placeholder="Email">
                                </div>
                                {{-- <div class="col-lg-4 col-md-4">
                                    <input type="text" placeholder="Phone">
                                </div> --}}
                                <div class="col-lg-12 text-center">
                                    <textarea placeholder="Bình luận" wire:model="comment"></textarea>
                                    <button type="button" wire:click="sendComment" class="site-btn">Gửi bình
                                        luận</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane mb-5" id="tabs-6" role="tabpanel">
                        <div class="product__details__tab__content">
                            <h3 class="border-bottom">Danh sách bình luận</h3>
                            @forelse ($reviews as $item)
                                <div class="product__details__tab__content__item grouplist mt-3">
                                    <h6 style="font-weight: 600" class="mb-1">{{ $item['name'] }}</h6>
                                    <div class="ml-2">Thời gian: {{ $item['created_at'] }}</div>
                                    <p class="ml-2">Bình luận: {{ $item['comment'] }}</p>
                                </div>
                            @empty
                                Hiện chưa có đánh giá nào
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
