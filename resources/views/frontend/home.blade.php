@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
    <section class="container mt-4 mb-grid-gutter">
        <div class="bg-faded-info rounded-3 py-4">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="px-4 pe-sm-0 ps-sm-5">
                        <span class="badge bg-danger" class="badge badge-blue-large">🔊TIMELINE SÂN CHƠI ENGLISH BEAT 2024 ☀️</span>
                        <h3 class="mt-4 mb-1 text-body fw-light">[NÓNG] - AN GIANG, CHÀO ĐÓN SÂN CHƠI CHINH PHỤC TIẾNG ANH ENGLISH BEAT</h3>
                        <h2 class="mb-1">English Beat 2024 sẽ đồng hành cùng các bạn trẻ tại tỉnh An Giang khám phá năng lực tiếng anh của bản thân và tìm ra được 1 lộ trình phù hợp cho riêng mình</h2>
                        <p class="h5 text-body fw-light">Số lượng quà cực khủng</p>
                        <a href="https://www.facebook.com/mobifonetinhangiang" class="btn btn-accent" >Tìm hiểu hơn về cuộc thi</a>
                    </div>
                </div>
                <div class="col-md-6"><img src="{{ asset('public/img/123456.jpg') }}" /></div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="tns-carousel border-end">
            <div class="tns-carousel-inner" data-carousel-options="{ &quot;nav&quot;: false, &quot;controls&quot;: false, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;loop&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;360&quot;:{&quot;items&quot;:2},&quot;600&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
                
            </div>
        </div>
    </section>
    @foreach($loaigoidata as $lgd)
    <section class="container pt-3 pb-2">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
            <h2 class="h3 mb-0 pt-3 me-2">{{ $lgd->tenloai }}</h2>
                <div class="pt-3">
                    <a class="btn btn-outline-accent btn-sm" href="{{ route('frontend.goidata', ['tenloai_slug' => $lgd->tenloai_slug]) }}">
                        Xem tất cả<i class="ci-arrow-right ms-1 me-n1"></i>
                    </a>
                </div>
        </div>
        <div class="row pt-2 mx-n2">
            @foreach($lgd->GoiData->take(4) as $gd)
                <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <a class="card-img-top d-block overflow-hidden" href="{{route('frontend.goidata.chitiet', ['tenloai_slug' => $lgd->tenloai_slug, 'tengoicuoc_slug' => $gd->tengoicuoc_slug]) }}">
                            <img src="{{ env('APP_URL') . '/storage/app/' . $gd->hinhanh }}" />
                        </a>
                    <div class="card-body py-2">
                        <a class="product-meta d-block fs-xs pb-1" href="#"></a>
                            <h3 class="product-title fs-sm">
                                <a href="{{ route('frontend.goidata.chitiet', ['tenloai_slug' => $lgd->tenloai_slug, 'tengoicuoc_slug' => $gd->tengoicuoc_slug]) }}"></a>
                            </h3>
        <div class="d-flex justify-content-between">
            <div class="product-price">
                <span class="text-accent"><small></small></span>
                </div>
                </div>
            </div>
                <div class="card-body card-body-hidden">
                    <a class="btn btn-primary btn-sm d-block w-100 mb-2" href="{{ route('frontend.giohang.them', ['tengoicuoc_slug' => $gd->tengoicuoc_slug]) }}">
                        <i class="ci-cart fs-sm me-1"></i>Thêm vào giỏ hàng
                    </a>
                </div>
        </div>
        <hr class="d-sm-none">
        </div>
        @endforeach
        </div>
    </section>
@endforeach
@endsection
