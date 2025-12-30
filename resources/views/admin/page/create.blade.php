@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
		<div class="page-content-wrapper p-xxl-4">
			<div class="row">
                <div class="col-lg-12">
					<ul class="nav nav-pills-shadow nav-responsive mb-2">
                        <li class="nav-item"> 
							<a class="nav-link mb-0" href="{{ route('admin.page.pages') }}">Pages</a> 
						</li>
                        <li class="nav-item"> 
							<a class="nav-link mb-0 active" href="{{ route('admin.page.create') }}">Create Page</a> 
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
                                <form action="{{ route('admin.page.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control title">
                                        </div>

                                        <!-- Slug -->
                                        <div class="col-md-6">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug" class="form-control slug">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control">
                                        </div>
                                        <div class="col-md-10">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control" placeholder="tours,travel">
                                        </div>
                                        <div class="col-md-2 col-md-2 d-flex align-items-center justify-content-center flex-column">
                                            <label class="form-label">Status</label>
                                           <div class="status-toggle d-flex">
                                                <input type="hidden" name="status" id="statusInput" value="0">

                                                <i id="statusIcon" class="bi bi-toggle-off fs-3 text-secondary" style="cursor:pointer;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Meta description</label>
                                            <textarea name="meta_description" class="form-control"></textarea>
                                        </div>
                                        <!-- Short Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">Short Description</label>
                                            <textarea name="short_description" class="form-control" rows="3"></textarea>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control summernote" rows="3"></textarea>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<!-- Page main content END -->
<script>
    document.getElementById('statusIcon').addEventListener('click', function () {
        let input = document.getElementById('statusInput');
        let current = input.value;

        if (current == "0") {
            // Switch to Active
            input.value = "1";
            this.classList.remove('bi-toggle-off', 'text-secondary');
            this.classList.add('bi-toggle-on', 'text-primary');
        } else {
            // Switch to Inactive
            input.value = "0";
            this.classList.remove('bi-toggle-on', 'text-primary');
            this.classList.add('bi-toggle-off', 'text-secondary');
        }
    });
</script>

<script>
const fileInput = document.getElementById('image');
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