@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
		<div class="page-content-wrapper p-xxl-4">
			<div class="row">
                <div class="col-lg-12">
					<ul class="nav nav-pills-shadow nav-responsive mb-2">
                        <li class="nav-item"> 
							<a class="nav-link mb-0 active" href="{{ route('admin.blog.blogs') }}">Blogs</a> 
						</li>
                        <li class="nav-item"> 
							<a class="nav-link mb-0" href="{{ route('admin.blog.create') }}">Create Blog</a> 
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <!-- Card header -->
                                <div class="card-header border-bottom">
                                    <h5 class="card-header-title">Blogs <span class="badge bg-primary bg-opacity-10 text-primary ms-2">{{ count($blogs) }} Blogs</span></h5>
                                </div>

                                <!-- Card body START -->
                                <div class="card-body vstack gap-3">
                                    @if (count($blogs)>0)
                                    @foreach ($blogs as $blog)
                                                            <!-- Listing item START -->
                                    <div class="card border p-2">
                                        <div class="row g-4">
                                            <!-- Card img -->
                                            <div class="col-md-3 col-lg-2">
                                                @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" class="card-img rounded-2" alt="Card image">
                                                @else
                                                <h5>N/A</h5>
                                                @endif
                                            </div>
                
                                            <!-- Card body -->
                                            <div class="col-md-9 col-lg-10">
                                                <div class="card-body position-relative d-flex flex-column p-0 h-100">
                                                    <!-- Buttons -->
                                                    <div class="list-inline-item position-absolute top-0 end-0">
                                                      <a class="dropdown-item changeStatus"
                                                        data-id="{{ $blog->id }}"
                                                        href="javascript:void(0)">
                                                            <i class="bi {{ $blog->status ? 'bi-toggle-on text-primary' : 'bi-toggle-off text-secondary' }} fs-4 statusIcon{{ $blog->id }}"></i>
                                                        </a>
                                                    </div>
                
                                                    <!-- Title -->
                                                    <h5 class="card-title mb-3 me-5"><a href="{{ route('admin.blog.edit',$blog->id) }}">{{ $blog->title }}</a></h5>
                                                    <!-- Price and Button -->
                                                    <div class="d-sm-flex justify-content-sm-between align-items-center mt-3 mt-md-auto">
                                                        <!-- Button -->
                                                        <div class="d-flex align-items-center">
                                                            <p class="fw-bold mb-0 me-1 text-capitalize">{{ $blog->meta_keywords }}</p>
                                                        </div>
                                                        <!-- Price -->
                                                        <div class="hstack gap-2 mt-3 mt-sm-0">
                                                            <a href="{{ route('admin.blog.edit',$blog->id) }}" class="btn btn-sm btn-primary mb-0"><i class="bi bi-pencil-square fa-fw me-1"></i>Edit</a>
                                                            <a href="{{ route('admin.blog.delete',$blog->id) }}" class="btn btn-sm btn-danger mb-0" onclick="return customConfirmDelete(event)"><i class="bi bi-trash3 fa-fw me-1"></i>Delete</a>  
                                                        </div>                  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Listing item END -->
                                    @endforeach
                                    @else
                                        <p>No blogs found.</p>
                                    @endif

                                </div>
                                <!-- Card body END -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<!-- Page main content END -->
<script>
document.querySelectorAll('.changeStatus').forEach(function (element) {

    element.addEventListener('click', function () {

        let pageId = this.getAttribute('data-id');

        fetch("{{ route('admin.blog.toggle-status') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id: pageId
            })
        })
        .then(response => response.json())
        .then(res => {

            if (res.success) {

                let icon = document.querySelector('.statusIcon' + pageId);

                if (res.status == 1) {
                    icon.classList.remove('bi-toggle-off', 'text-secondary');
                    icon.classList.add('bi-toggle-on', 'text-primary');
                } else {
                    icon.classList.remove('bi-toggle-on', 'text-primary');
                    icon.classList.add('bi-toggle-off', 'text-secondary');
                }
            }
        });

    });

});
</script>

@endsection