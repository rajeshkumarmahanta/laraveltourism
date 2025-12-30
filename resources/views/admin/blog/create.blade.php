@extends('layouts.admin')

@section('content')
<style>
    .tags-input {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        cursor: text;
    }
    .tag {
        background: #8e85e6;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
    }
    .tag i {
        cursor: pointer;
    }
    #tagField {
        flex: 1;
    }
</style>

<!-- Page main content START -->
		<div class="page-content-wrapper p-xxl-4">
			<div class="row">
                <div class="col-lg-12">
					<ul class="nav nav-pills-shadow nav-responsive mb-2">
                         <li class="nav-item"> 
							<a class="nav-link mb-0 " href="{{ route('admin.blog.blogs') }}">Blogs</a> 
						</li>
                        <li class="nav-item"> 
							<a class="nav-link mb-0 active" href="{{ route('admin.blog.create') }}">Create Blog</a> 
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
                                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control title">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Author</label>
                                            <input type="text" name="author" class="form-control">
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
                                        <div class="col-md-12">
                                            <label class="form-label">Tags</label>
                                            <div class="tags-input border rounded p-2" id="tagsInput">
                                                <input type="text" class="form-control bg-none border-0 p-0" id="tagField" placeholder="Type and press Enter">
                                            </div>

                                            <!-- Hidden field to store final values -->
                                            <input type="hidden" name="tags" id="tagsHidden">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control" placeholder="tours,travel">
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
                                            <label class="form-label">Content</label>
                                            <textarea name="description" class="form-control summernote" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="form-label">Published Date</label>
                                            <input type="date" name="published_at" class="form-control">
                                        </div>
                                        <div class="col-md-2 col-md-2 d-flex align-items-center justify-content-center flex-column">
                                            <label class="form-label">Status</label>
                                           <div class="status-toggle d-flex">
                                                <input type="hidden" name="status" id="statusInput" value="0">

                                                <i id="statusIcon" class="bi bi-toggle-off fs-3 text-secondary" style="cursor:pointer;"></i>
                                            </div>
                                        </div>
                                        <!-- Submit -->
                                        <div class="col-12 text-end mt-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
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
    const tagField = document.getElementById('tagField');
    const tagsInput = document.getElementById('tagsInput');
    const tagsHidden = document.getElementById('tagsHidden');

    let tags = [];

    // Load Existing Tags From Hidden Input
    window.addEventListener('DOMContentLoaded', function () {
        let existing = tagsHidden.value.trim();

        if (existing !== "") {
            tags = existing.split(',').map(tag => tag.trim());
            updateTagsUI();
        }
    });

    // Add Tag
    tagField.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && this.value.trim() !== "") {
            e.preventDefault();
            addTag(this.value.trim());
            this.value = "";
        }
    });

    function addTag(tag) {
        tags.push(tag);
        updateTagsUI();
    }

    // Remove Tag
    function removeTag(index) {
        tags.splice(index, 1);
        updateTagsUI();
    }

    // Update UI
    function updateTagsUI() {
        tagsInput.innerHTML = '';
        
        tags.forEach((tag, index) => {
            tagsInput.innerHTML += `
                <span class="tag">
                    ${tag} <i onclick="removeTag(${index})" class="bi bi-x-lg"></i>
                </span>
            `;
        });

        tagsInput.appendChild(tagField);

        // Save to hidden input for form submission
        tagsHidden.value = tags.join(",");
    }
</script>


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