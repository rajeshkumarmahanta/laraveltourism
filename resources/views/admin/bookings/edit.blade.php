@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
<div class="page-content-wrapper p-xxl-4">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0"><i class="fas fa-plane-departure me-2"></i>Travel Booking Details</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <!-- Tour ID -->
                    <div class="col-md-6">
                        <label class="form-label">Tour id</label>
                        <input type="text" class="form-control" value="{{ $booking->tour_id }}" name="tour_id">
                    </div>

                    <!-- Name -->
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ $booking->name }}" class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $booking->email }}" class="form-control" required>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ $booking->phone }}" class="form-control" required>
                    </div>

                    <!-- Travel Date -->
                    <div class="col-md-6">
                        <label class="form-label">Travel Date</label>
                        <input type="date" name="travel_date" value="{{ $booking->travel_date }}" class="form-control" required>
                    </div>

                    <!-- Travelers Number -->
                    <div class="col-md-6">
                        <label class="form-label">No. of Travelers</label>
                        <input type="number" name="travenlers_no" value="{{ $booking->travenlers_no }}" class="form-control" required>
                    </div>

                    <!-- Pickup Address -->
                    <div class="col-md-12">
                        <label class="form-label">Pickup Address</label>
                        <textarea type="text" name="pickup_address" class="form-control" required>{{ $booking->pickup_address }}</textarea>
                    </div>

                    <!-- ID Type -->
                    <div class="col-md-4">
                        <label class="form-label">ID Type</label>
                        <select name="id_type" class="form-select" required>
                            <option value="" selected disabled>Select ID Type</option>
                            <option value="Aadhar"
                            @if ($booking->id_type == 'Aadhar') selected
                            
                            @endif>Aadhar</option>
                            <option value="Voter ID"
                            @if ($booking->id_type == 'Voter ID') selected
                            @endif>Voter ID</option>
                            <option value="Passport"
                            @if ($booking->id_type == 'Passport') selected
                            @endif>Passport</option>
                            <option value="Driving License"
                            @if ($booking->id_type == 'Driving License') selected
                            @endif>Driving License</option>
                            <option value="PAN Card"
                            @if ($booking->id_type == 'PAN Card') selected
                            @endif>PAN Card</option>
                        </select>
                    </div>

                    <!-- ID Image -->
                    <div class="col-md-4">
                        <label class="form-label">Upload ID Image</label>
                        <input type="file" name="image" class="form-control">
                        <input type="hidden" value="{{ $booking->id_image }}" name="old_id_image">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ID Proof Image</label>
                        <img src="{{ asset($booking->id_image) }}" alt="ID Document" class="img-fluid rounded border form-control" style="width: 100px;">
                    </div>

                    <!-- Additional Message -->
                    <div class="col-md-12">
                        <label class="form-label">Additional Message</label>
                        <textarea name="additional_message" class="form-control" rows="3">{{ $booking->additional_message }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class=" mt-3">
                        <button type="submit" class="btn btn-primary">Submit Booking</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Page main content END -->

@endsection