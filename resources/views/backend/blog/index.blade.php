@extends('backend.layout')

@section('content')
<div class="container">
	<h1>Editor del blog 
		<a href="{{url('admin/blog/create')}}">
		<button class="addButton float-right"><i class="fa fa-plus-square"></i> Nueva entrada</button></a></h1>
		<hr>
	<div class="container">
		<div class="card mb-3">
			<div class="row no-gutters">
			    <div class="col-md-4">
			      <img src="{{asset('images/semantic/image.png')}}" class="card-img" alt="...">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title">Card title</h5>
			        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
			        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
			      </div>
			    </div>
			  </div>
			</div>
	</div>	
</div>
@endsection