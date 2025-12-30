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
							<a class="nav-link mb-0 " href="{{ route('admin.tour.create') }}">Add tour</a> 
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
                                <form action="{{ route('admin.tour.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-3">
                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" value="{{ $category->name }}" class="form-control title" placeholder="Category name">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control slug">
                                        </div>
                                        <!-- Featured Image -->
                                        <div class="col-md-6">
                                            <label class="form-label">Image</label>
                                            <input type="file" id="featured_image" name="image" class="form-control">
                                            <input type="hidden" name="old_image" class="form-control" value="{{ $category->image }}">
                                        </div>
                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control summernote" rows="3">{{ $category->description }}</textarea>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12 text-end mt-3">
                                            <button type="submit" class="btn btn-primary">Save Category</button>
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

                                <div class="mt-2">
                                    @if($category->image)
                                        <img src="{{ asset( $category->image) }}" alt="{{ $category->name }}" width="100%">
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