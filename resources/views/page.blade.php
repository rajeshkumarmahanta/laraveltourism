@extends('layouts.app')
@section('page_title',$page->title)
@section('meta_keywords',$page->meta_keywords)
@section('meta_description',$page->meta_description)
@section('content')
<section class="pt-0">
        <div class="container">
            <!-- Background image -->
            <div class="rounded-3 p-3 p-sm-5" style="background-image: url({{$page->image}}); background-position: center center; background-repeat: no-repeat; background-size: cover;">
                <!-- Banner title -->
                <div class="row my-2 my-xl-5"> 
                    <div class="col-md-8 mx-auto"> 
                        <h1 class="text-center text-white">{{ $page->title }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}" class="text-white text-decoration-underline mx-1">Home</a></li> 
                                <li> / </li>
                                <li class="breadcrumb-item active text-white mx-1" aria-current="page">{{ $page->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-0">
	<div class="container">
	{!! $page->description !!}
	</div>
</section>
@endsection
