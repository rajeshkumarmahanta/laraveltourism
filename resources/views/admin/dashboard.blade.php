@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
		<div class="page-content-wrapper p-xxl-4">
			<!-- Title -->
			<div class="row">
				<div class="col-12 mb-4 mb-sm-5">
					<div class="d-sm-flex justify-content-between align-items-center">
						<h1 class="h3 mb-2 mb-sm-0">Dashboard</h1>
						<div class="d-grid"><a href="#" class="btn btn-primary-soft mb-0"><i class="bi bi-plus-lg fa-fw"></i> New Booking</a></div>				
					</div>
				</div>
			</div>
			<!-- Counter boxes START -->
			<div class="row g-4 mb-5">
				<!-- Counter item -->
				<div class="col-md-6 col-xxl-3">
					<div class="card card-body bg-warning bg-opacity-10 border border-warning border-opacity-25 p-4 h-100">
						<div class="d-flex justify-content-between align-items-center">
							<!-- Digit -->
							<div>
								<h4 class="mb-0">{{ $totalTours }}</h4>
								<span class="h6 fw-light mb-0">Total Tour</span>
							</div>
							<!-- Icon -->
							<div class="icon-lg rounded-circle bg-warning text-white mb-0"><i class="fa-solid fa-car-side fa-fw"></i></div>
						</div>
					</div>
				</div>

				<!-- Counter item -->
				<div class="col-md-6 col-xxl-3">
					<div class="card card-body bg-success bg-opacity-10 border border-success border-opacity-25 p-4 h-100">
						<div class="d-flex justify-content-between align-items-center">
							<!-- Digit -->
							<div>
								<h4 class="mb-0">{{ $totalBookings }}</h4>
								<span class="h6 fw-light mb-0">Total Bookings</span>
							</div>
							<!-- Icon -->
							<div class="icon-lg rounded-circle bg-success text-white mb-0"><i class="fa-solid fa-book fa-fw"></i></div>
						</div>
					</div>
				</div>

				<!-- Counter item -->
				<div class="col-md-6 col-xxl-3">
					<div class="card card-body bg-primary bg-opacity-10 border border-primary border-opacity-25 p-4 h-100">
						<div class="d-flex justify-content-between align-items-center">
							<!-- Digit -->
							<div>
								<h4 class="mb-0">245</h4>
								<span class="h6 fw-light mb-0">Total Rooms</span>
							</div>
							<!-- Icon -->
							<div class="icon-lg rounded-circle bg-primary text-white mb-0"><i class="fa-solid fa-bed fa-fw"></i></div>
						</div>
					</div>
				</div>

				<!-- Counter item -->
				<div class="col-md-6 col-xxl-3">
					<div class="card card-body bg-info bg-opacity-10 border border-info border-opacity-25 p-4 h-100">
						<div class="d-flex justify-content-between align-items-center">
							<!-- Digit -->
							<div>
								<h4 class="mb-0">147</h4>
								<span class="h6 fw-light mb-0">Booked Room</span>
							</div>
							<!-- Icon -->
							<div class="icon-lg rounded-circle bg-info text-white mb-0"><i class="fa-solid fa-building-circle-check fa-fw"></i></div>
						</div>
					</div>
				</div>
			</div>
			<!-- Counter boxes END -->

			<!-- Hotel grid START -->
			<div class="row g-4 mb-5">
				<!-- Title -->
				<div class="col-12">
					<div class="d-flex justify-content-between">
						<h4 class="mb-0">Popular Hotels</h4>
						<a href="#" class="btn btn-primary-soft mb-0">View All</a>
					</div>	
				</div>

				<!-- Hotel item -->
				 @foreach ($topTours as $tour)
					<div class="col-lg-6">
						<div class="card shadow p-3">
							<div class="row g-4">
								<!-- Card img -->
								<div class="col-md-3">
									<img src="{{ asset($tour->featured_image) }}" class="rounded-2" alt="{{ $tour->title }}">
								</div>

								<!-- Card body -->
								<div class="col-md-9">
									<div class="card-body position-relative d-flex flex-column p-0 h-100">

										<!-- Buttons -->
										<div class="list-inline-item dropdown position-absolute top-0 end-0">
											<!-- Share button -->
											<a href="{{ route('admin.bookings.tourBookings', $tour->id) }}" class="btn btn-sm btn-round btn-light" data-bs-toggle="tooltip" data-bs-title="View Bookings">
												<i class="bi bi-journals"></i>
											</a>
											
										</div>

										<!-- Title -->
										<h5 class="card-title mb-0 me-5"><a href="{{ route('admin.tour.edit',$tour->id) }}">{{ $tour->title }}</a></h5>
										<small><i class="bi bi-geo-alt me-2"></i>{{ $tour->location }}</small>

										<!-- Price and Button -->
										<div class="d-sm-flex justify-content-sm-between align-items-center mt-3 mt-md-auto">
											<!-- Price -->
											<div class="d-flex align-items-center">
												@if($tour->discount_price && $tour->discount_price < $tour->price)
													<!-- Discounted Price -->
													<h5 class="fw-bold mb-0 me-1">₹{{ number_format($tour->discount_price, 2) }}</h5>
													<span class="text-muted text-decoration-line-through me-2">₹	{{ number_format($tour->price, 2) }}</span>
													
												@else
													<!-- Normal Price -->
													<h5 class="fw-bold mb-0 me-1">₹{{ number_format($tour->price, 2) }}</h5>
													
												@endif
											</div>

											<!-- Button -->
											<div class="hstack gap-2 mt-3 mt-sm-0">
												<a href="{{ route('admin.tour.edit',$tour->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
												 <a href="{{ route('admin.tour.delete',$tour->id) }}" onclick="return customConfirmDelete(event)" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a> 
											</div>                 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				 @endforeach
			</div>
			<!-- Hotel grid END -->
			
			<!-- Widget START -->
			<div class="row g-4">
				<!-- Booking Chart START -->
				<div class="col-xxl-12">
					<!-- Chart START -->
					<div class="card shadow h-100">
						<!-- Card header -->
						<div class="card-header border-bottom">
							<h5 class="card-header-title">Booking Activity</h5>
						</div>

						<!-- Card body -->
						<div class="card-body">
							<div id="bookingChart" class="mt-2"></div>
						</div>
					</div>
					<!-- Chart END -->
				</div>
			</div>	
			<!-- Widget END -->
	
		</div>
<script>
    var options = {
        chart: {
            type: 'line',
            height: 350,
            toolbar: { show: true }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        series: [{
            name: 'Bookings',
            data: {!! json_encode($bookingChart) !!}   // FIXED & SAFE
        }],
        xaxis: {
            categories: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ]
        },
        yaxis: {
            labels: {
                formatter: val => parseInt(val)
            }
        },
        colors: ['#0d6efd'], // Bootstrap primary
        markers: {
            size: 4
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: function(value) {
                    return "Bookings: " + value;
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.4,
                opacityFrom: 0.7,
                opacityTo: 0.2,
            }
        }
    };

    // var chart = new ApexCharts(document.querySelector("#bookingChart"), options);
    // chart.render();
</script>

@endsection