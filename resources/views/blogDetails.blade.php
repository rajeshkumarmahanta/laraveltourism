@extends('layouts.app')
@section('page_title', $blog->title)
@section('meta_keywords',$blog->meta_keywords)
@section('meta_description',$blog->meta_description)
@section('content')

<!-- =======================
Main Banner START -->
<section class="pt-0">
	<div class="container">
		<!-- Background image -->
		<div class="p-3 p-sm-5 rounded-3"
		style="
			background-image:
			linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
			url({{ asset( $blog->image) }});
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		">	
		<!-- Banner title -->
			<div class="row"> 
				<div class="col-md-8 mx-auto my-5"> 
					<h3 class="text-center text-light">{{ $blog->title }}</h3>
					<ul class="nav nav-divider text-dark mb-0 justify-content-center">
						<li class="nav-item"><a class="text-light" href="{{ route('home') }}">Home</a></li>
						<li class="nav-item text-light">{{ $blog->title }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="pt-4 pt-md-5">
	<div class="container">
		<div class="row g-4 g-md-5">
			<!-- Tabs Content START -->
			<div class="col-xl-12">
				<div class="card bg-transparent p-0">
					<!-- Card header -->
					<div class="card-header bg-transparent border-bottom p-0 pb-3">
						<h3 class="mb-0">{{ $blog->title }}</h3>
					</div>
					<!-- Card body START -->
					<div class="card-body p-0 pt-3">
						{!! $blog->content !!}
					</div>
					<!-- Card body END -->
				</div>
			</div>
			<!-- Tabs Content END -->

		</div> <!-- Row END -->
	</div>
</section>

@endsection
