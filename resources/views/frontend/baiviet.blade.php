@extends('layouts.frontend')
@section('title', 'Bài viết')
@section('content')	
		
		<div class="bg-secondary py-4">
			<div class="container d-lg-flex justify-content-between py-2 py-lg-3">
				<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
							<li class="breadcrumb-item">
								<a class="text-nowrap" href="#"><i class="ci-home"></i>Trang chủ</a>
							</li>
							<li class="breadcrumb-item text-nowrap active" aria-current="page">Tin tức</li>
						</ol>
					</nav>
				</div>
				<div class="order-lg-1 pe-lg-4 text-center text-lg-start">
					<h1 class="h3 mb-0">Tin tức</h1>
				</div>
			</div>
		</div>
		
		<div class="container pb-5 mb-2 mb-md-4">
			<div class="pt-3 mt-md-3">
				<div class="masonry-grid" data-columns="3">
					<article class="masonry-grid-item">
						<div class="card">
							<a class="blog-entry-thumb" href="#">
								<img class="card-img-top" src="img/02.jpg" />
							</a>
							<div class="card-body">
								<h2 class="h6 blog-entry-title"><a href="#">Global Travel and Vacations on a Tight Budget</a></h2>
								<p class="fs-sm" style="text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim...</p>
								<a class="btn-tag me-2 mb-2" href="#">Personal finance</a>
							</div>
							<div class="card-footer d-flex align-items-center fs-xs">
								<a class="blog-entry-meta-link" href="#">
									<div class="blog-entry-author-ava"><img src="img/03.jpg" /></div>Emma Gallaher
								</a>
								<div class="ms-auto text-nowrap">
									<a class="blog-entry-meta-link text-nowrap" href="#">Aug 15</a>
									<span class="blog-entry-meta-divider mx-2"></span>
									<a class="blog-entry-meta-link text-nowrap" href="#"><i class="ci-eye"></i>8</a>
								</div>
							</div>
						</div>
					</article>
					<article class="masonry-grid-item">
						<div class="card">
							<a class="blog-entry-thumb" href="#">
								<img class="card-img-top" src="img/02.jpg" />
							</a>
							<div class="card-body">
								<h2 class="h6 blog-entry-title"><a href="#">Global Travel and Vacations on a Tight Budget</a></h2>
								<p class="fs-sm" style="text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim...</p>
								<a class="btn-tag me-2 mb-2" href="#">Personal finance</a>
							</div>
							<div class="card-footer d-flex align-items-center fs-xs">
								<a class="blog-entry-meta-link" href="#">
									<div class="blog-entry-author-ava"><img src="img/03.jpg" /></div>Emma Gallaher
								</a>
								<div class="ms-auto text-nowrap">
									<a class="blog-entry-meta-link text-nowrap" href="#">Aug 15</a>
									<span class="blog-entry-meta-divider mx-2"></span>
									<a class="blog-entry-meta-link text-nowrap" href="#"><i class="ci-eye"></i>8</a>
								</div>
							</div>
						</div>
					</article>
					<article class="masonry-grid-item">
						<div class="card">
							<a class="blog-entry-thumb" href="#">
								<img class="card-img-top" src="img/02.jpg" />
							</a>
							<div class="card-body">
								<h2 class="h6 blog-entry-title"><a href="#">Global Travel and Vacations on a Tight Budget</a></h2>
								<p class="fs-sm" style="text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim...</p>
								<a class="btn-tag me-2 mb-2" href="#">Personal finance</a>
							</div>
							<div class="card-footer d-flex align-items-center fs-xs">
								<a class="blog-entry-meta-link" href="#">
									<div class="blog-entry-author-ava"><img src="img/03.jpg" /></div>Emma Gallaher
								</a>
								<div class="ms-auto text-nowrap">
									<a class="blog-entry-meta-link text-nowrap" href="#">Aug 15</a>
									<span class="blog-entry-meta-divider mx-2"></span>
									<a class="blog-entry-meta-link text-nowrap" href="#"><i class="ci-eye"></i>8</a>
								</div>
							</div>
						</div>
					</article>
				</div>
				<hr class="mb-4">
				
				<nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
					<ul class="pagination">
						<li class="page-item"><a class="page-link" href="#"><i class="ci-arrow-left me-2"></i>Prev</a></li>
					</ul>
					<ul class="pagination">
						<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">4</a></li>
						<li class="page-item"><a class="page-link" href="#">5</a></li>
					</ul>
					<ul class="pagination">
						<li class="page-item"><a class="page-link" href="#" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</main>
	@endsection	
	
