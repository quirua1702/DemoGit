@extends('layouts.frontend')
@section('title', 'Tuyển dụng')
@section('content')
		<div class="bg-secondary py-4">
			<div class="container d-lg-flex justify-content-between py-2 py-lg-3">
				<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
							<li class="breadcrumb-item">
								<a class="text-nowrap" href="#"><i class="ci-home"></i>Trang chủ</a>
							</li>
							<li class="breadcrumb-item text-nowrap active" aria-current="page">Chi tiết</li>
						</ol>
					</nav>
				</div>
				<div class="order-lg-1 pe-lg-4 text-center text-lg-start">
					<h1 class="h3 mb-0">TUYỂN DỤNG NHÂN VIÊN KINH DOANH</h1>
				</div>
			</div>
		</div>
		
		<div class="container pb-5">
			<div class="row justify-content-center pt-3 mt-md-3">
				<div class="col-12">
					<div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-n1">
						<div class="d-flex align-items-center fs-sm mb-2">
							<a src="{{ asset('public/img/avtt/avt.jpg') }}">
								<div >
								</div>
								Trần Văn Qui
							</a>
							<span class="blog-entry-meta-divider"></span>
							<a class="blog-entry-meta-link" href="#">Jul 17</a>
						</div>
						<div class="fs-sm mb-2">
							<a class="blog-entry-meta-link text-nowrap" href="#" data-scroll>
							<i class="ci-eye"></i>3</a>
						</div>
					</div>
					
					<p style="text-align:justify"></p>
					<p style="text-align:justify"></p>
					<p style="text-align:justify"></p>
					<p style="text-align:justify">Quyền Lợi:
								Mức lương cạnh tranh và hoa hồng hấp dẫn.
								Chế độ phúc lợi đầy đủ theo quy định của công ty.
								Cơ hội thăng tiến và phát triển nghề nghiệp.
								Môi trường làm việc trẻ trung, sáng tạo và thân thiện.</p>
					<p style="text-align:justify">Liên Hệ:
Ứng viên quan tâm vui lòng gửi hồ sơ và CV về địa chỉ email: [mobifone@gmail.com] trước ngày [21-04-2024]. Chúng tôi sẽ liên hệ lại để xếp lịch phỏng vấn. Đối với thông tin chi tiết hơn, vui lòng liên hệ hotline: [0973528348].</p>
					
					<div class="d-flex flex-wrap justify-content-between pt-2 pb-4 mb-1">
						<div class="mt-3 me-3">
							<a class="btn-tag me-2 mb-2" href="#">#kinh doanh</a>
							<a class="btn-tag mb-2" href="#">#simso</a>
						</div>
						<div class="mt-3">
							<span class="d-inline-block align-middle text-muted fs-sm me-3 mt-1 mb-2">Share post:</span>
							<a class="btn-social bs-facebook me-2 mb-2" href="https://www.facebook.com/mobifonetinhangiang"><i class="ci-facebook"></i></a>
							<a class="btn-social bs-twitter me-2 mb-2" href="#"><i class="ci-twitter"></i></a>
							<a class="btn-social bs-pinterest me-2 mb-2" href="#"><i class="ci-pinterest"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="bg-secondary py-5">
			<div class="container py-3">
				<h2 class="h4 text-center pb-4">Bài viết cùng chuyên mục</h2>
				<div class="tns-carousel">
					<div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: false, &quot;autoHeight&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 20},&quot;900&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 30}}}">
						<article>
							<a class="blog-entry-thumb mb-3" href="#"></a>
							<div class="d-flex align-items-center fs-sm mb-2">
								<a class="blog-entry-meta-link" href="#">by Ngọc Mẫn</a>
								<span class="blog-entry-meta-divider"></span>
								<a class="blog-entry-meta-link" href="#">Sep 16</a>
							</div>
							<h3 class="h6 blog-entry-title"><a href="#">Hiện tại còn ứng tuyển không ạ.</a></h3>
						</article>
						<article>
							<a class="blog-entry-thumb mb-3" href="#"></a>
							<div class="d-flex align-items-center fs-sm mb-2">
								<a class="blog-entry-meta-link" href="#">by Minh Thuận</a>
								<span class="blog-entry-meta-divider"></span>
								<a class="blog-entry-meta-link" href="#">Sep 16</a>
							</div>
							<h3 class="h6 blog-entry-title"><a href="#">Mình muốn ứng tuyển.</a></h3>
						</article>
						<article>
							<a class="blog-entry-thumb mb-3" href="#"></a>
							<div class="d-flex align-items-center fs-sm mb-2">
								<a class="blog-entry-meta-link" href="#">by Ánh Linh</a>
								<span class="blog-entry-meta-divider"></span>
								<a class="blog-entry-meta-link" href="#">Sep 16</a>
							</div>
							<h3 class="h6 blog-entry-title"><a href="#">Đã nộp hồ sơ chờ check ạ.</a></h3>
						</article>
						
					</div>
				</div>
			</div>
		</div>
	</main>
	@endsection