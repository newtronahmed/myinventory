@extends('layouts.app')
@section('content')
<div class="container">
	<form action="{{route('profile.update')}}" enctype="multipart/form-data" method="post">
		@csrf
		@method('PATCH')
		@if($errors->count()>0)
		@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			{{$error}}
		</div>
		@endforeach
		@endif
	  <div class="form-group">
	    <label for="description">Description</label>
	    <input type="text"  name ='description' value="{{old('email') ?? $profile->description}}" class="form-control" id="description" aria-describedby="description">
	  </div>
	  <div class="form-group">
	    <label for="title">Title</label>
	    <input type="text"  name ='title' value="{{old('email') ?? $profile->title}}" class="form-control" id="title" aria-describedby="title">
	  </div>
	  <div class="form-group">
	    <label for="image">Profile Image</label>
	    <input type="file" name='image'  class="form-control-file" id="image">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection