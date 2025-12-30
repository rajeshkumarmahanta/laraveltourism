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
            <div class="card shadow p-3">
                <div class="card-header px-0 boroder-bottom">
                    <h4 class="card-title mb-0">Change Password</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.website.password-update',$password->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Site Name -->
                                <div class="col-md-6 mb-3 ">
                                    <label class="form-label">Current Password</label>
                                    <div class="position-relative password-wrapper">
                                    <input type="password" class="form-control password-field" name="current_password">

                                    <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">New Password</label>
                                    <div class="position-relative password-wrapper">
                                    <input type="password" class="form-control password-field" name="new_password">

                                    <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="position-relative password-wrapper">
                                    <input type="password" class="form-control password-field" name="confirm_password">

                                    <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
		<!-- Page main content END -->
         <script>
    document.querySelectorAll('.toggle-password').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            const wrapper = this.closest('.password-wrapper');
            const input = wrapper.querySelector('.password-field');
            const icon = this.querySelector('i');

            // Toggle input type
            input.type = input.type === "password" ? "text" : "password";

            // Toggle icon classes
            icon.classList.toggle("bi-eye");
            icon.classList.toggle("bi-eye-slash");
        });
    });
</script>

@endsection