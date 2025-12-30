@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
<div class="page-content-wrapper p-xxl-4">
	<!-- Title -->
	<div class="row">
		<div class="col-12 mb-4 mb-sm-5">
			<div class="d-sm-flex justify-content-between align-items-center">
				<h1 class="h3 mb-2 mb-sm-0">Image Manager</h1>
				<div class="d-grid"><a href="#" data-bs-toggle="modal" data-bs-target="#imageUploadModal" class="btn btn-primary-soft mb-0"><i class="bi bi-plus-lg fa-fw"></i> Add Image</a></div>				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show my-2" role="alert">
					{{ session('success') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif
		</div>
		<div class="col-md-12">
			<p>Image Base url is : {{ url('images/') }}</p>
		</div>
	</div>
	<div class="row">
		@if (count($images)>0)
		@foreach ( $images as $img)
		<div class="col-md-3 mb-4">
			<div class="card border position-relative">
				<img src="{{ asset($img->image) }}" class="card-img-top object-fit-cover" style="height:200px;" alt="Image">
				<p id="copyText" class="d-none">{{ asset( $img->image) }}</p>
				<button title="copy text" class="position-absolute p-1 m-2 btn btn-primary" onclick="navigator.clipboard.writeText(document.getElementById('copyText').innerText)"><i class="bi bi-copy"></i></button>
				<form class="card-body" action="{{ route('admin.image_update',$img->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="old_image" value="{{ $img->image }}">
					<input type="text" class="form-control mb-2" name="name" value="{{ $img->image }}" readonly="">
					<input type="file" class="form-control mb-2" name="image" accept="image/*">
					<div class="d-flex justify-content-between align-items-center gap-2">
					<button name="update_image" type="submit" class="btn btn-primary btn-sm">Update</button>
					<a class="btn btn-danger btn-sm" href="{{ route('admin.image_delete',$img->id) }}" onclick="return customConfirmDelete(event)"><i class="bi bi-trash"></i></a>
					</div>
				</form>
			</div>
		</div>
		@endforeach
		@else
		<p>No images !</p>
		@endif
		
	</div>
<div class="modal fade" id="imageUploadModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Upload Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.imageUpload') }}" method="POST" id="imageUploadForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <!-- Image Preview -->
          <div class="mb-3 text-center">
            <img id="previewImage" src="" class="img-fluid rounded d-none" style="max-height: 200px;" />
          </div>

          <!-- File Upload -->
          <div class="mb-3">
            <label class="form-label">Choose Image</label>
            <input type="file" class="form-control" name="image" id="imageInput" accept="image/*" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>

      </form>

    </div>
  </div>
</div>
</div>
<script>
document.getElementById("imageInput").addEventListener("change", function(event) {
    let reader = new FileReader();
    reader.onload = function(){
        let preview = document.getElementById("previewImage");
        preview.src = reader.result;
        preview.classList.remove("d-none");
    };
    reader.readAsDataURL(event.target.files[0]);
});
</script>
<!-- Page main content END -->
@endsection