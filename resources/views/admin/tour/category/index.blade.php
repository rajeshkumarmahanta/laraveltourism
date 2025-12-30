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
							<a class="nav-link mb-0 active" href="{{ route('admin.tour.category.index') }}">Categories</a> 
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
                    <div class="card shadow p-2">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $index=>$category)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ asset( $category->image) }}" alt="{{ $category->name }}" width="50">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tour.category.edit',$category->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.tour.category.delete',$category->id) }}" onclick="return customConfirmDelete(event)" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>
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
@endsection