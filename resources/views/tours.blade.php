@extends('layouts.app')
@section('page_title',$tours_page->title)
@section('meta_keywords',$tours_page->meta_keywords)
@section('meta_description',$tours_page->meta_description)
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
			url({{ asset( $tours_page->image) }});
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		">	
		<!-- Banner title -->
			<div class="row"> 
				<div class="col-md-8 mx-auto my-5"> 
					<h1 class="text-center text-light">Tours</h1>
					<ul class="nav nav-divider h6 text-dark mb-0 justify-content-center">
						<li class="nav-item"><a class="text-light" href="{{ route('home') }}">Home</a></li>
						<li class="nav-item text-light">{{ count($tours) }}  Tours</li>
					</ul>
				</div>
			</div>
		</div>

		<!-- Search START -->
		<div class="row mt-n4 mt-sm-n7">
			<div class="col-11 mx-auto">
				
				<!-- Booking from START -->
				<div class="bg-mode shadow p-4 rounded-3">

					<!-- Main search START -->
					<form class="form-control-bg-transparent bg-mode rounded-3" action="{{ route('tour.search') }}" method="GET">
						<div class="row g-4 align-items-center">

							<div class="col-xl-10">
								<div class="row g-4">
									<!-- Location -->
									<div class="col-md-6 col-lg-4">
										<label class="h6 fw-normal mb-0">Location</label>
										<!-- Input field -->
										<div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
											<input type="text" class="form-control" name="location" placeholder="Tour location">
										</div>
									</div>
	
									<!-- Check in -->
									<div class="col-md-6 col-lg-8">
										<label class="h6 fw-normal mb-0">Tours</label>
										<!-- Input field -->
										<div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
											<input type="text" class="form-control" name="tour" placeholder="Search tours">
										</div>
									</div>
								</div>
							</div>
	
							<!-- Button -->
							<div class="col-xl-2">
								<div class="d-grid">
									<button type="submit" class="btn btn-lg btn-dark mb-0">Search</button>
								</div>
							</div>
						</div>
					</form>
					<!-- Main search END -->
				</div>
				<!-- Booking from END -->
			</div>
		</div>
		<!-- Search END -->
	</div>
</section>
<!-- =======================
Main Banner END -->

<!-- =======================
Tour grid START -->
<section class="pt-0">
	<div class="container">
		<!-- Filter and content START -->
		<div class="row g-4 align-items-center justify-content-between mb-4">
			<!-- Content -->
			<div class="col-12 col-xl-8">
				<h5 class="mb-0">
					Showing {{ $tours->firstItem() }}–{{ $tours->lastItem() }} of {{ $tours->total() }} results
				</h5>
			</div>
		</div>
		<!-- Filter and content END -->

		<div class="row g-4">
			@foreach ($tours as $tour)
			<div class="col-md-6 col-xl-4">
				<div class="card card-hover-shadow pb-0 h-100">
					<!-- Overlay item -->
					<div class="position-relative">
						<!-- Image -->
						 @if (!empty($tour->featured_image))
						<img src="{{ asset($tour->featured_image) }}" class="card-img-top tour-img" alt="Card image">
						@else
						<p>N/A</p>
						@endif
						<!-- Overlay -->
						<div class="card-img-overlay d-flex flex-column p-4 z-index-1">
							<!-- Card overlay top -->
							<div> <span class="badge text-bg-dark">{{ $tour->location }}</span> </div>
							<!-- Card overlay bottom -->
							<div class="w-100 mt-auto">
								<!-- Card category -->
								<span class="badge text-bg-white fs-6">{{ $tour->duration }}</span>
							</div>
						</div>
					</div>
					<!-- Image -->

					<!-- Card body START -->
					<div class="card-body px-3">
						<!-- Title -->
						<h5 class="card-title mb-0"><a href="{{ route('tour.details',$tour->slug) }}" class="">{{ $tour->title }}</a></h5>
						<span class="small">{{ $tour->category->name }}</span>
					</div>
					<!-- Card body END -->

					<!-- Card footer START-->
					<div class="card-footer pt-0">
						<!-- Price and Button -->
						<div class="d-sm-flex justify-content-sm-between align-items-center flex-wrap">
							<!-- Price -->
							<div class="gap-2">

								@if($tour->discount_price && $tour->discount_price < $tour->price)
									<h5 class="fw-normal text-success mb-0">{{ $currency }}{{ number_format($tour->discount_price, 2) }}</h5>
									<span class="text-decoration-line-through text-muted">{{ $currency }}{{ number_format($tour->price, 2) }}</span>
								@else
									<h5 class="fw-normal text-success mb-0">{{ $currency }}{{ number_format($tour->price, 2) }}</h5>
								@endif
							</div>
							<!-- Button -->
							<div class="mt-2 mt-sm-0">
								<a href="{{ route('tour.details',$tour->slug) }}" class="btn btn-sm btn-primary mb-0">View Details</a>    
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
			  {{ $tours->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>
</section>
<!-- =======================
Tour grid END -->

@endsection
