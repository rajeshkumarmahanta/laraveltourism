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
                                <form action="{{ route('admin.blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <input type="hidden" name="status" value="{{ $blog->status }}">
                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" value="{{ $blog->title }}" class="form-control title">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Author</label>
                                            <input type="text" name="author" value="{{ $blog->author }}" class="form-control">
                                        </div>

                                        <!-- Slug -->
                                        <div class="col-md-6">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug" value="{{ $blog->slug }}" class="form-control slug">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Image</label>
                                            <input type="file" id="image" name="image" class="form-control">
                                            <input type="hidden" value="{{ $blog->image }}" name="old_image">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Tags</label>
                                            <div class="tags-input border rounded p-2" id="tagsInput">
                                                <!-- User types here -->
                                                <input type="text" class="form-control bg-none border-0 p-0" id="tagField" placeholder="Type and press Enter">
                                            </div>

                                            <!-- Hidden field with initial values -->
                                            <input type="hidden" name="tags" id="tagsHidden" value="{{ $blog->tags }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" value="{{ $blog->meta_keywords }}" class="form-control" placeholder="tours,travel">
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label class="form-label">Meta description</label>
                                            <textarea name="meta_description" class="form-control">{{ $blog->meta_description }}</textarea>
                                        </div>
                                        <!-- Short Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">Short Description</label>
                                            <textarea name="short_description" class="form-control" rows="3">{{ $blog->short_description }}</textarea>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label class="form-label">Content</label>
                                            <textarea name="description" class="form-control summernote" rows="3">{{ $blog->content }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Published Date</label>
                                            <input type="date" name="published_at" value="{{ $blog->published_at }}" class="form-control">
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
                                 <div class="mt-2">
                                    @if($blog->image)
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->name }}" width="100%">
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
    const tagField = document.getElementById('tagField');
    const tagsInput = document.getElementById('tagsInput');
    const tagsHidden = document.getElementById('tagsHidden');

    let tags = [];

    // Load Existing Tags from Hidden Input
    window.addEventListener('DOMContentLoaded', function () {
        let existing = tagsHidden.value.trim();

        if (existing !== "") {
            tags = existing.split(',').map(tag => tag.trim()).filter(t => t !== "");
            updateTagsUI();
        }
    });

    // Add Tag when pressing Enter
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

    function removeTag(index) {
        tags.splice(index, 1);
        updateTagsUI();
    }

    // Update UI + hidden field
    function updateTagsUI() {
        tagsInput.innerHTML = '';

        tags.forEach((tag, index) => {
            tagsInput.innerHTML += `
                <span class="tag badge bg-primary me-2 p-2">
                    ${tag}
                    <i onclick="removeTag(${index})" class="bi bi-x-lg ms-1" style="cursor:pointer;"></i>
                </span>
            `;
        });

        // Move input field at end
        tagsInput.appendChild(tagField);

        // Save updated tags
        tagsHidden.value = tags.join(",");
    }
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