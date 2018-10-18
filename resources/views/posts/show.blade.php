@extends('layouts.app')

@section('content')
	<a href="/posts" class="btn btn-info">Go back</a>
	<h1>{{$post->title}}</h1>
		<div class="well">
			<div>
				@if($post->cover_image != "noimage.jpg")
				<img style="max-width: 500px;" src="/storage/cover_images/{{$post->cover_image}}" alt="Whoopsie">
				@endif
				{!! $post->body !!}
			</div>
		</div>
		<hr>
		<small>Written on {{date('d m Y, H:i:s', strtotime($post->created_at))}}<br>By {{$post->user->name}}</small>
		<hr>
		@if(!Auth::guest())
			@if(Auth::user()->id == $post->user_id)
				<a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a>

				{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
					{{Form::hidden('_method', 'DELETE')}}
					{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
				{!!Form::close()!!}
			@endif
		@endif
@endsection