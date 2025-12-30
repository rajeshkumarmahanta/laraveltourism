@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
		<div class="page-content-wrapper p-xxl-4">
			<div class="row">
                <div class="col-lg-12">
					<ul class="nav nav-pills-shadow nav-responsive mb-2">
                        <li class="nav-item"> 
							<a class="nav-link mb-0 active" href="{{ route('admin.tour.index') }}">Tours</a> 
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
                    <div class="card shadow p-2">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tours as $index=>$tour)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $tour->title }}</td>
                                    <td>{{ $tour->category->name }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        data-bs-title="Featured"
                                        class="toggle-featured"
                                        data-id="{{ $tour->id }}">
                                            <i class="bi bi-star-fill {{ $tour->featured ? 'text-warning' : 'text-secondary' }}"></i>
                                        </a>
                                    </td>
                                    <td> 
                                        <a href="javascript:void(0)" 
                                            class="toggleStatusBtn" 
                                            data-id="{{ $tour->id }}"
                                            id="statusBtn{{ $tour->id }}">

                                            <span class="badge fs-6
                                                {{ $tour->status == 'active' ? 'bg-primary' : '' }}
                                                {{ $tour->status == 'inactive' ? 'bg-secondary' : '' }}
                                                {{ $tour->status == 'draft' ? 'bg-info' : '' }}">
                                                {{ $tour->status }}
                                            </span>

                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tour.edit',$tour->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.tour.delete',$tour->id) }}" onclick="return customConfirmDelete(event)" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>
		<!-- Page main content END -->
<script>
document.querySelectorAll('.toggleStatusBtn').forEach(function(button) {

    button.addEventListener('click', function() {
        let id = this.dataset.id;

        fetch("{{ route('admin.tour.toggle-status') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(res => {

            if (res.success) {

                let btn = document.querySelector('#statusBtn' + id + ' span');

                // Remove old classes
                btn.classList.remove('bg-primary', 'bg-secondary', 'bg-info');

                // Add new class based on status
                if (res.status === 'active') {
                    btn.classList.add('bg-primary');
                    btn.textContent = "active";
                } 
                else if (res.status === 'inactive') {
                    btn.classList.add('bg-secondary');
                    btn.textContent = "inactive";
                } 
                else if (res.status === 'draft') {
                    btn.classList.add('bg-info');
                    btn.textContent = "draft";
                }
            }
        });

    });

});
</script>
<script>
document.addEventListener('click', function (e) {
    const target = e.target.closest('.toggle-featured');
    if (!target) return;

    e.preventDefault();

    const tourId = target.dataset.id;
    const icon = target.querySelector('i');

    fetch(`/admin/tour/${tourId}/toggle-featured`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.featured == 1) {
            icon.classList.remove('text-secondary');
            icon.classList.add('text-warning');
        } else {
            icon.classList.remove('text-warning');
            icon.classList.add('text-secondary');
        }
    })
    .catch(error => console.error(error));
});
</script>


@endsection