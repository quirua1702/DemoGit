@extends('layouts.frontend')
@section('title', 'Tìm kiếm')
@section('content')
 		
<div class="bg-dark pt-4">
			<div class="container pt-2 pb-3 pt-lg-3 pb-lg-4">
				<div class="d-lg-flex justify-content-between pb-3">
					<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
								<li class="breadcrumb-item">
									<a class="text-nowrap" href="{{route('frontend.home')}}"><i class="ci-home"></i>Trang chủ</a>
								</li>
								<li class="breadcrumb-item text-nowrap active" aria-current="page">Tìm kiếm</li>
							</ol>
						</nav>
					</div>
					<div class="order-lg-1 pe-lg-4 text-center text-lg-start">
						<h1 class="h3 text-light mb-0">Tất cả {{count($goidata)}} gói data</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="container pb-5 mb-2 mb-md-4">
			<div class="row pt-3 mx-n2">
			@foreach($goidata as $gd)
				<div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
					<div class="card product-card">
						<a class="card-img-top d-block overflow-hidden" href="{{route('frontend.goidata.chitiet', $gd->tengoicuoc_slug) }}">
							<img src="{{ env('APP_URL') . '/storage/app/' . $gd->hinhanh }}"/>
						</a>
						<div class="card-body py-2">
							<a class="product-meta d-block fs-xs pb-1" href="333"></a>
							<h3 class="product-title fs-sm">
								<a href="111"></a>
							</h3>
							<div class="d-flex justify-content-between">
								<div class="product-price">
									<span class="text-accent">{{ number_format($gd->dongia, 0, ',', '.') }}<small>đ</small></span>
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
				<hr class="my-3">
			
		</div>
	</main>
<div class="paginationWrap">{{$goidata->links()}}</div>
@endsection