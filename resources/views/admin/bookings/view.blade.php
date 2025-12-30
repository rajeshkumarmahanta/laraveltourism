@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
    <div class="page-content-wrapper p-xxl-4">
        <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                
                <!-- Header -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0"><i class="fas fa-plane-departure me-2"></i>Travel Booking Details</h4>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Name</label>
                                <p class="fw-semibold mb-0">{{ $booking->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Email</label>
                                <p class="fw-semibold mb-0">{{ $booking->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Phone</label>
                                <p class="fw-semibold mb-0">{{ $booking->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Travel Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-suitcase-rolling me-2"></i>Travel Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Travel Date</label>
                                <p class="fw-semibold mb-0">{{ $booking->travel_date }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Number of Travelers</label>
                                <p class="fw-semibold mb-0">{{ $booking->travenlers_no }} Travelers</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Pickup Address</label>
                                <p class="fw-semibold mb-0">{{ $booking->pickup_address }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Tour</label>
                                <p class="fw-semibold mb-0">{{ $tour->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Identification -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Identification</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small">ID Type</label>
                                <p class="fw-semibold mb-0">{{ $booking->id_type }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small">ID Document</label>
                                <div class="mt-2">
                                    <img src="{{ asset( $booking->id_image) }}" 
                                         alt="ID Document" 
                                         class="img-fluid rounded border"
                                         style="width: 80px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Message -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-comment-dots me-2"></i>Additional Message</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $booking->additional_message }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Booking
                    </a>
                    <a href="{{ route('generatePdf', $booking->id) }}" class="btn btn-success">
                        <i class="fas fa-check me-2"></i>Download pdf
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
<!-- Page main content END -->
@endsection