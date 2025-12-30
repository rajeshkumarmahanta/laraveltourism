@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <div class="row">
        <div class="col-md-12 d-flex align-items-center justify-content-between">
            <div class="col-lg-12">
                <ul class="nav nav-pills-shadow nav-responsive mb-2">
                    <li class="nav-item"> 
                        <a class="nav-link mb-0 active" href="{{ route('admin.menu.index') }}">Menus</a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link mb-0" href="{{ route('admin.menu.create') }}">Add Menu</a> 
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow p-2">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (count($groups)>0)
                        @foreach($groups as $g)
                        <tr>
                            <td><a href="{{ route('admin.menu.edit',$g->id) }}">{{ $g->group_name }}</a></td>
                            <td><a href="{{ route('admin.menu.edit',$g->id) }}">View</a></td>
                            <td>
                                <a href="{{ route('admin.menu.edit',$g->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('admin.menu.delete',$g->id) }}" onclick="return customConfirmDelete(event)" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <p>No Menu group found !</p>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


@endsection
