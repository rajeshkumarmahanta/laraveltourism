@extends('layouts.app')
@section('page_title',$tour->title ?? '')
@section('meta_keywords',$tour->meta_keywords ?? '')
@section('meta_description',$tour->meta_description ?? '')
@section('content')

<!-- =======================
Main Banner START -->
<section class="pt-4 pt-lg-5">
	<div class="container position-relative">
		@if(session('success'))
			<div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		<!-- Title and button START -->
		<div class="row">
			<div class="col-12">
				<!-- Meta -->
				<div class="d-md-flex justify-content-md-between mb-3">
					<!-- Title -->
					<div>
						<h1 class="fs-2">{{ $tour->title }}</h1>
						<ul class="nav nav-divider text-body">
							<li class="nav-item"></li>
							<li class="nav-item">{{ $tour->duration ?? '' }}</li>
							<li class="nav-item">{{ $tour->category->name }}</li>
							<li class="nav-item">{{ $tour->location }}</li>
						</ul>
					</div>

				</div>

			</div>
		</div>
		<!-- Title and button END -->

		<!-- Image gallery START -->
		 @if(!empty($tour->featured_image))
			<div class="row">
				<div class="col-12">
					<a href="{{ asset($tour->featured_image) }}" class="glightbox">
						<img src="{{ asset($tour->featured_image) }}" class="w-100">
					</a>
				</div>
			</div>
		 
		@endif
		<!-- Image gallery END -->

	</div>
</section>
<!-- =======================
Main Banner END -->

<!-- =======================
Tabs-content START -->
<section class="pt-4 pt-md-5">
	<div class="container">
		<div class="row g-4 g-md-5">
			<!-- Tabs Content START -->
			<div class="col-xl-8">
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show my-2" role="alert">
						{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif
				<div class="card bg-transparent p-0">
					<!-- Card header -->
					<div class="card-header bg-transparent border-bottom p-0 pb-3">
						<h3 class="mb-0">{{ $tour->title }}</h3>
					</div>

					<!-- Card body START -->
					<div class="card-body p-0 pt-3">
						{{ $tour->description }}
					</div>
					<!-- Card body END -->
				</div>
			</div>
			<!-- Tabs Content END -->

			<!-- Right side content START -->
			<aside class="col-xl-4">
				<div class="row g-4">
					<!-- Book now item START -->
					<div class="col-md-6 col-xl-12">
						<div class="card card-body border bg-transparent">
							<!-- Title -->
							@php
								$price = $tour->price;
								$discountPrice = $tour->discount_price;

								$discountPercent = 0;
								if (!empty($discountPrice) && $discountPrice < $price) {
									$discountPercent = round((($price - $discountPrice) / $price) * 100);
								}
							@endphp

							<div class="hstack gap-2 mb-1 align-items-end position-relative">

								@if(!empty($discountPrice) && $discountPrice < $price)

									<!-- Discount Badge -->
									<span class="badge bg-danger position-absolute top-0 end-0">
										{{ $discountPercent }}% OFF
									</span>

									<!-- Discount Price -->
									<h3 class="card-title mb-0 text-success">
										₹ {{ number_format($discountPrice) }}
									</h3>

									<!-- Original Price -->
									<small class="text-muted text-decoration-line-through fs-6">
										₹{{ number_format($price) }}
									</small>

								@else

								<!-- Normal Price -->
								<h3 class="card-title mb-0">
									₹{{ number_format($price) }}
								</h3>

								@endif
							</div>
							<!-- Button -->
							<div class="d-grid gap-2">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</button>
								<button class="btn btn-outline-primary mb-0" type="button" data-bs-toggle="modal" data-bs-target="#enquiryModal">
									<i class="bi bi-eye fa-fw me-2"></i>Send Inquiry
								</button>
							</div>

						</div>
					</div>
					<!-- Book now item END -->

					<!-- Help item START -->
					<div class="col-md-6 col-xl-12">
						<div class="card card-body bg-light p-4">
							@if($similarTours->count())
							<h5 class="mb-3">Similar Tours</h5>
							<div class="similar-tour-list">

								@foreach($similarTours as $item)
									<a href="{{ route('tour.details',$item->slug) }}"
									class="d-flex gap-3 align-items-center text-decoration-none mb-3">

										<!-- Image -->
										<img src="{{ asset($item->featured_image) }}"
											alt="{{ $item->title }}"
											class="rounded">

										<!-- Content -->
										<div>
											<h6 class="mb-1">
												{{ str($item->title)->limit(40)  }}
											</h6>

											<small class="text-muted">
												{{ $item->category->name }}
											</small>
										</div>

									</a>
								@endforeach

							</div>
							@endif
						</div>
					</div>
					<!-- Help item END -->
				</div>
			</aside>
			<!-- Right side content END -->

		</div> <!-- Row END -->
	</div>
</section>
<!-- =======================
Tabs-content END -->
<!-- Booking Modal -->
<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="bookingModalLabel">Tour Booking Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
			<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="tour_id" value="{{ $tour->id }}">
				<input type="hidden" name="price" value="{{ $tour->discount_price ?? $tour->price }}">
				<!-- Full Name -->
				<div class="mb-3">
					<label class="form-label">Full Name</label>
					<input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
				</div>

				<div class="row">
					<!-- Email -->
					<div class="col-md-6 mb-3">
						<label class="form-label">Email Address</label>
						<input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
					</div>

					<!-- Phone -->
					<div class="col-md-6 mb-3">
						<label class="form-label">Phone Number</label>
						<input type="text" name="phone" class="form-control" placeholder="+91 9876543210" required>
					</div>
				</div>

				<div class="row">
					<!-- Travel Date -->
					<div class="col-md-6 mb-3">
						<label class="form-label">Travel Date</label>
						<input type="date" name="travel_date" class="form-control" required>
					</div>

					<!-- Number of Travelers -->
					<div class="col-md-6 mb-3">
						<label class="form-label">Number of Travelers</label>
						<input type="number" name="travenlers_no" class="form-control" min="1" value="1" required>
					</div>
				</div>

				<!-- Pickup Address -->
				<div class="mb-3">
					<label class="form-label">Pickup Address</label>
					<textarea class="form-control" name="pickup_address" rows="2" placeholder="Enter pickup location" required></textarea>
				</div>

				<div class="row">
					<!-- ID Proof Type -->
					<div class="col-md-6 mb-3">
						<label class="form-label">ID Proof Type</label>
						<select class="form-select" name="id_type" required>
							<option value="" selected disabled>-- Select ID Proof --</option>
							<option value="Aadhaar Card">Aadhaar Card</option>
							<option value="PAN Card">PAN Card</option>
							<option value="Driving License">Driving License</option>
							<option value="Passport">Passport</option>
						</select>
					</div>

					<!-- Upload ID Proof -->
					<div class="col-md-6 mb-3">
						<label class="form-label">Upload ID Proof</label>
						<input type="file" class="form-control" name="image" accept=".jpg,.png,.pdf" required>
					</div>
				</div>

				<!-- Message -->
				<div class="mb-3">
					<label class="form-label">Additional Message</label>
					<textarea class="form-control" name="additional_message" rows="3" placeholder="Any special requests?"></textarea>
				</div>

				<!-- Submit Button -->
				<div class="d-grid">
					<button type="submit" class="btn btn-primary btn-lg">
						Book Tour Now
					</button>
				</div>
			</form>
        </div>
    </div>
  </div>
</div>
<!-- Enquiry Modal -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

        <!-- Modal Body -->
      <div class="p-3 modal-body">
        <div class="bg-transparent card">
            <div class="bg-transparent card-header">
                <h6 class="card-title mb-0">Our expert will get in touch with you shortly</h6>
            </div>
            <div class="pt-0 card-body">
                <form method="post" action="{{ route('inquiry.store') }}">
					@csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input placeholder="Enter Your name" name="name" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email id</label>
                        <input placeholder="Enter Your emil id" name="email" type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input placeholder="Enter Your phone number" name="phone" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" type="text" class="form-control"></textarea>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button type="submit" class="mb-0 btn btn-dark">Send Inquiry</button>
                        <button type="button" class="mb-0 btn btn-link">Call on: {{ $websiteSettings->contact_phone }}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection
