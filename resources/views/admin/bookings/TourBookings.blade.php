@extends('layouts.admin')

@section('content')
<!-- Page main content START -->
		<div class="page-content-wrapper p-xxl-4">
			<div class="row">
                <div class="col-lg-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card shadow p-2">
                        <div class="card-header">
                            <h5>Bookings for Tour ({{ $tour->title }})</h5>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $index=>$booking)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->email }}</td>
                                    <td>{{ $booking->phone }}</td>
                                    <td>
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.bookings.delete',$booking->id) }}" onclick="return customConfirmDelete(event)" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>
                                    <a href="{{ route('admin.bookings.view',$booking->id) }}"  class="btn btn-sm btn-primary">view</a>
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