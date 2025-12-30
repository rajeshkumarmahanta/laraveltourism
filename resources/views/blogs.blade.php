@extends('layouts.app')
@section('page_title',$blogs_page->title)
@section('meta_keywords',$blogs_page->meta_keywords)
@section('meta_description',$blogs_page->meta_description)
@section('content')
<!-- =======================
Main Banner START -->
<section class="pt-0">
	<div class="container">
		<!-- Background image -->
		<div class="p-3 p-sm-5 rounded-3"
		style="
			background-image:
			linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
			url({{ asset( $blogs_page->image) }});
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		">	
		<!-- Banner title -->
			<div class="row"> 
				<div class="col-md-8 mx-auto my-5"> 
					<h1 class="text-center text-light">BLOGS</h1>
					<ul class="nav nav-divider h6 text-dark mb-0 justify-content-center">
						<li class="nav-item"><a class="text-light" href="{{ route('home') }}">Home</a></li>
						<li class="nav-item text-light">{{ count($blogs) }}  Blogs</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Main Banner END -->

<!-- =======================
Tour grid START -->
<section class="pt-0">
	<div class="container">
		<div class="row g-4">
			@foreach ($blogs as $blog)
			<div class="col-md-6 col-xl-4">
				<div class="card card-hover-shadow pb-0 h-100">
					<!-- Overlay item -->
					<div class="position-relative">
						<!-- Image -->
						 @if (!empty($blog->image))
						<img src="{{ asset($blog->image) }}" class="card-img-top blog-img" alt="Card image">
						@else
						<p>N/A</p>
						@endif
					</div>
					<!-- Image -->

					<!-- Card body START -->
					<div class="card-body px-3">
						<!-- Title -->
						<h5 class="card-title mb-0"><a href="{{route('blog.details',$blog->slug) }}" class="">{{ str($blog->title)->limit(50) }}</a></h5>
                        <p>{{$blog->short_description }}</p>
					</div>
					<!-- Card body END -->

					<!-- Card footer START-->
					<div class="card-footer pt-0">
						<!-- Price and Button -->
						<div class="d-sm-flex justify-content-sm-between align-items-center flex-wrap">
							<!-- Button -->
							<div class="mt-2 mt-sm-0">
								<a href="{{route('blog.details',$blog->slug) }}" class="btn btn-sm btn-primary mb-0">Read More</a>    
							</div>
						</div>
					</div>

				</div>
			</div>
			@endforeach
		</div> <!-- Row END -->

		<!-- Pagination -->
		<div class="row mt-3">
			<div class="col-12 tour-pagination">
			  {{ $blogs->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>
</section>
<!-- =======================
Tour grid END -->

@endsection
