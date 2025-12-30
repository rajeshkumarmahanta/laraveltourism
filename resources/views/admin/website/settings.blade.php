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
                    <h4 class="card-title mb-0">Website Settings</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.website.settings-update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="update_id" value="{{ $settings->id }}">
                            <div class="row">
                                <!-- Site Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Site Name</label>
                                    <input type="text" name="site_name" class="form-control" value="{{ $settings->site_name ?? '' }}">
                                </div>

                                <!-- Site Tagline -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Site Tagline</label>
                                    <input type="text" name="site_tagline" class="form-control" value="{{ $settings->site_tagline ?? '' }}">
                                </div>

                                <!-- Logo -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                    <input type="hidden" name="old_logo" value="{{ $settings->logo }}">
                                    @if(!empty($settings->logo))
                                        <img src="{{ asset( $settings->logo) }}" alt="Logo" class="img-thumbnail mt-2" width="100">
                                    @endif
                                </div>

                                <!-- Favicon -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Favicon</label>
                                    <input type="file" name="favicon" class="form-control">
                                    <input type="hidden" name="old_favicon" value="{{ $settings->favicon }}">
                                    @if(!empty($settings->favicon))
                                        <img src="{{ asset($settings->favicon) }}" alt="Favicon" class="img-thumbnail mt-2" width="40">
                                    @endif
                                </div>

                                <!-- Contact Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Email</label>
                                    <input type="email" name="contact_email" class="form-control" value="{{ $settings->contact_email ?? '' }}">
                                </div>

                                <!-- Contact Phone -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Phone</label>
                                    <input type="text" name="contact_phone" class="form-control" value="{{ $settings->contact_phone ?? '' }}">
                                </div>

                                <!-- Contact Address -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Contact Address</label>
                                    <textarea name="contact_address" class="form-control" rows="2">{{ $settings->contact_address ?? '' }}</textarea>
                                </div>

                                <!-- Facebook -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Facebook URL</label>
                                    <input type="text" name="facebook" class="form-control" value="{{ $settings->facebook ?? '' }}">
                                </div>

                                <!-- Instagram -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Instagram URL</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ $settings->instagram ?? '' }}">
                                </div>

                                <!-- Twitter -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Twitter URL</label>
                                    <input type="text" name="twitter" class="form-control" value="{{ $settings->twitter ?? '' }}">
                                </div>

                                <!-- YouTube -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">YouTube URL</label>
                                    <input type="text" name="youtube" class="form-control" value="{{ $settings->youtube ?? '' }}">
                                </div>

                                <!-- Meta Title -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ $settings->meta_title ?? '' }}">
                                </div>

                                <!-- Meta Keywords -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Keywords</label>
                                    <textarea name="meta_keywords" class="form-control" rows="2">{{ $settings->meta_keywords ?? '' }}</textarea>
                                </div>

                                <!-- Meta Description -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3">{{ $settings->meta_description ?? '' }}</textarea>
                                </div>

                                <!-- About Website -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">About Website</label>
                                    <textarea name="about_website" class="form-control" rows="4">{{ $settings->about_website ?? '' }}</textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Settings</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
		<!-- Page main content END -->
@endsection