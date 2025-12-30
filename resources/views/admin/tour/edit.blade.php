@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
		<div class="page-content-wrapper p-xxl-4">
			<div class="row">
                <div class="col-lg-12">
					<ul class="nav nav-pills-shadow nav-responsive mb-2">

					    <li class="nav-item"> 
							<a class="nav-link mb-0" href="{{ route('admin.tour.index') }}">Tours</a> 
						</li>
						<li class="nav-item"> 
							<a class="nav-link mb-0 " href="{{ route('admin.tour.category.index') }}">Categories</a> 
						</li>
						<li class="nav-item"> 
							<a class="nav-link mb-0" href="{{ route('admin.tour.create') }}">Add tour</a> 
						</li>
						<li class="nav-item"> 
							<a class="nav-link mb-0" href="{{ route('admin.tour.category.create') }}">Add category</a> 
						</li>
					</ul>
				</div>
                <div class="col-lg-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card shadow p-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="{{ route('admin.tour.update',$tour->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-3">
                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" value="{{ $tour->title }}" class="form-control title" placeholder="Tour title">
                                        </div>

                                        <!-- Slug -->
                                        <div class="col-md-6">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug" value="{{ $tour->slug }}" class="form-control slug" placeholder="tour-title">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" value="{{ $tour->meta_keywords }}" class="form-control" placeholder="tours,travel">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Meta description</label>
                                            <textarea name="meta_description" class="form-control">{{ $tour->meta_description }}</textarea>
                                        </div>

                                        <!-- Category -->
                                        <div class="col-md-6">
                                            <label class="form-label">Category</label>
                                            <select name="category_id" class="form-select">
                                                <option value="" disabled selected>--Select Category--</option>
                                                @if ($categories)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" 
                                                        @if ($tour->category_id==$category->id)
                                                        selected
                                                        @endif>{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Duration -->
                                        <div class="col-md-6">
                                            <label class="form-label">Duration</label>
                                            <input type="text" name="duration" class="form-control" value="{{ $tour->duration }}" placeholder="3 Days 2 Nights">
                                        </div>

                                        <!-- Location -->
                                        <div class="col-md-6">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" value="{{ $tour->location }}" class="form-control" placeholder="City / Country">
                                        </div>

                                        <!-- Price -->
                                        <div class="col-md-6">
                                            <label class="form-label">Price</label>
                                            <input type="number" step="0.01" value="{{ $tour->price }}" name="price" class="form-control" placeholder="1000">
                                        </div>

                                        <!-- Discount Price -->
                                        <div class="col-md-6">
                                            <label class="form-label">Discount Price</label>
                                            <input type="number" step="0.01" value="{{ $tour->discount_price }}" name="discount_price" class="form-control" placeholder="900">
                                        </div>

                                        <!-- Featured Image -->
                                        <div class="col-md-6">
                                            <label class="form-label">Featured Image</label>
                                            <input type="file" id="featured_image" name="featured_image" class="form-control">
                                            <input type="hidden" name="old_featured_image" value="{{ $tour->featured_image }}">
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="active" @if ($tour->status=='active')
                                                selected
                                                @endif>Active</option>
                                                <option value="inactive" @if ($tour->status=='inactive')
                                                selected
                                                @endif>Inactive</option>
                                                <option value="draft" @if ($tour->status=='draft')
                                                selected
                                                @endif>Draft</option>
                                            </select>
                                        </div>

                                        <!-- Featured -->
                                        <div class="col-md-6">
                                            <label class="form-label">Featured</label>
                                            <select name="featured" class="form-select">
                                                <option value="0" @if ($tour->featured==0)
                                                selected
                                                @endif>No</option>
                                                <option value="1" @if ($tour->featured==1)
                                                selected
                                                @endif>Yes</option>
                                            </select>
                                        </div>

                                        <!-- Short Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">Short Description</label>
                                            <textarea name="short_description" class="form-control" rows="3">{{ $tour->short_description }}</textarea>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control summernote" rows="3">{{ $tour->description }}</textarea>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12 text-end mt-3">
                                            <button type="submit" class="btn btn-primary">Save Tour</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <div class="col-lg-4">
                                <small id="fileName" class="text-muted">No image selected</small>
                                <div class="progress mt-3 p-2" style="height: 25px;">
                                    <div id="progressBar" class="progress-bar progress-bar-striped " role="progressbar" style="width: 0%">0%</div>
                                </div>
                                <img id="preview" src="" alt="Image Preview" class="img-thumbnail d-none">
                                <div class="mt-3">
                                    @if($tour->featured_image)
                                        <img src="{{ asset($tour->featured_image) }}" alt="{{ $tour->title }}" width="100%">
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<!-- Page main content END -->
<script>
const fileInput = document.getElementById('featured_image');
const preview = document.getElementById('preview');
const fileName = document.getElementById('fileName');
const progressBar = document.getElementById('progressBar');

fileInput.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
        // Show file name
        fileName.textContent = file.name;

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);

        // Simulate upload with progress
        let progress = 0;
        progressBar.classList.remove('bg-success');
        progressBar.classList.add('bg-info');
        const interval = setInterval(() => {
            if (progress >= 100) {
                clearInterval(interval);
                progressBar.classList.remove('bg-info');
                progressBar.classList.add('bg-success');
            } else {
                progress += 5; // increase progress
            }
            progressBar.style.width = progress + '%';
            progressBar.textContent = progress + '%';
        }, 100); // adjust speed if needed

    } else {
        fileName.textContent = "No image selected";
        preview.classList.add('d-none');
        progressBar.style.width = '0%';
        progressBar.textContent = '0%';
        progressBar.classList.remove('bg-info', 'bg-success');
    }
});
</script>
@endsection