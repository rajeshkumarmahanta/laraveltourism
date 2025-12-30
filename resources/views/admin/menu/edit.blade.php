@extends('layouts.admin')


@section('content')
<!-- Page main content START -->
<div class="page-content-wrapper p-xxl-4">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills-shadow nav-responsive mb-2">
                <li class="nav-item"> 
                    <a class="nav-link mb-0" href="{{ route('admin.menu.index') }}">Menus</a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link mb-0" href="{{ route('admin.menu.create') }}">Add Menu</a> 
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
                    <div class="col-lg-12 my-3">
                        <h5>
                            Menu Group
                        </h5>
                       <form action="{{ route('admin.menu-group.update', $menu_group->id) }}" method="POST">
                            @csrf
                            <div class="row gap-2">
                                <div class="col-md-6">
                                    <input type="text" name="group_name" value="{{ $menu_group->group_name }}" class="form-control">
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>


                    </div>
                    <div class="col-lg-12">
                        <h5>Menus Under This Group</h5>
                        @foreach ($menus as $menu)
                        <div class="card shadow p-3 my-3 border-4 border-bottom border-light">
                            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Select Group</label>
                                        <select name="group_id" class="form-select">
                                            @foreach ($menu_groups as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ $menu->group_id == $group->id ? 'selected' : '' }}>
                                                    {{ $group->group_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $menu->title }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">URL</label>
                                        <input type="text" class="form-control" name="url" value="{{ $menu->url }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" class="form-control" name="sort_order" value="{{ $menu->sort_order ?? 0 }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $menu->status == 0 ? 'selected' : '' }}>Disabled</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary mt-4">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page main content END -->
@endsection
