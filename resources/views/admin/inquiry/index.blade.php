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
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enquiries as $index=>$enq)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $enq->name }}</td>
                                    <td>{{ $enq->email }}</td>
                                    <td>{{ $enq->phone }}</td>
                                    <td>{{ $enq->message }}</td>
                                    <td>
                                        <a href="{{ route('admin.enquiry.delete',$enq->id) }}" onclick="return customConfirmDelete(event)" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>
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